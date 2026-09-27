import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, FieldError, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import { FileText, Sparkles, Upload } from 'lucide-react';
import { PageProps } from '@/types';

export type Options = { types: Record<string, string>; difficulties: Record<string, string>; categories: Record<string, string> };
type SourceScope = 'all' | 'vocabulary_grammar' | 'reading' | 'writing';
type Job = { id: number; status: string; generated_count: number; error_message?: string; request_json: { number_of_questions: number } };
type Doc = { id: number; original_name: string; status: string; error_message?: string; parser_metadata_json?: { sections?: string[] } };

const newRequestKey = () => {
    if (typeof globalThis.crypto?.randomUUID === 'function') return globalThis.crypto.randomUUID();
    // The API validates request_key as UUID. Keep the fallback valid on
    // non-secure production origins where randomUUID is unavailable.
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, character => {
        const value = Math.floor(Math.random() * 16);
        const nibble = character === 'x' ? value : (value & 0x3) | 0x8;
        return nibble.toString(16);
    });
};

export function Counts({ label, options, values, onChange, total }: { label: string; options: Record<string, string>; values: Record<string, number>; onChange: (value: Record<string, number>) => void; total: number }) {
    const sum = Object.values(values).reduce((a, b) => a + b, 0);
    return <fieldset className="space-y-3 rounded-xl border border-slate-200 p-4"><legend className="px-1 font-medium">{label} · {sum} / {total}</legend><div className="grid gap-3 sm:grid-cols-2">{Object.entries(options).map(([key, text]) => <label key={key}><span className="label">{text}</span><input className="field" type="number" min={0} max={60} value={values[key] ?? 0} onChange={e => onChange({ ...values, [key]: Number(e.target.value) })} /></label>)}</div>{sum !== total && <p role="alert" className="text-sm text-red-700">The total must equal {total} questions.</p>}</fieldset>;
}

export default function AI({ jobs, documents, options, providerReady }: { jobs: { data: Job[]; links: Array<{ url: string | null; label: string; active: boolean }> }; documents: Doc[]; options: Options; providerReady: boolean }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const [polling, setPolling] = useState(true);
    const form = useForm({
        document_ids: [] as number[], request_key: newRequestKey(),
        number_of_questions: 5, source_mode: 'extract_exact' as 'generated' | 'extract_exact', source_scope: 'all' as SourceScope, type_counts: { multiple_choice: 5 } as Record<string, number>,
        difficulty_counts: { EASY: 5 } as Record<string, number>, category_counts: { reading: 5 } as Record<string, number>, additional_constraints: '',
    });
    const upload = useForm({ documents: [] as File[] });
    const scopedDocs = documents;
    const selectableStatuses = ['READY', 'UPLOADED', 'PROCESSING'];
    const working = scopedDocs.some(d => ['UPLOADED', 'PROCESSING'].includes(d.status)) || jobs.data.some(j => ['QUEUED', 'PROCESSING'].includes(j.status));
    useEffect(() => {
        if (!working || !polling) return;
        let count = 0;
        const timer = setInterval(() => { if (++count > 120) { setPolling(false); clearInterval(timer); return; } router.reload({ only: ['documents', 'jobs'] }); }, 5000);
        return () => clearInterval(timer);
    }, [working, polling]);
    const balanced = form.data.source_mode === 'extract_exact' || [form.data.type_counts, form.data.difficulty_counts, form.data.category_counts].every(c => Object.values(c).reduce((a, b) => a + b, 0) === form.data.number_of_questions);
    const generationBlockers = [
        !providerReady ? 'Configure the OpenAI provider and API key.' : null,
        !form.data.document_ids.length ? 'Chọn ít nhất một tài liệu nguồn.' : null,
        !balanced ? 'Make every blueprint total match Total questions.' : null,
    ].filter((message): message is string => Boolean(message));
    return <AppShell><Head title="Tạo câu hỏi AI từ tài liệu" /><PageHeader title="Tạo câu hỏi AI từ tài liệu" description="Turn English source material into reviewable vocabulary, grammar and reading questions." actions={<Link className="btn btn-outline" href={prefix + '/questions'}>Ngân hàng câu hỏi</Link>} />
        {!providerReady && <div role="status" className="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">AI generation is not configured. You can upload and prepare documents. Ask your administrator to configure the AI provider.</div>}
        {!polling && <Button className="mt-4" variant="outline" onClick={() => { router.reload({ only: ['documents', 'jobs'] }); setPolling(true); }}>Tiếp tục cập nhật trạng thái</Button>}
        <div className="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]"><div className="space-y-6">
            <Card className="p-5"><h2 className="section-title">1. Source documents</h2><p className="mt-1 text-sm text-slate-600">Tài liệu nguồn độc lập với khóa học. Bạn có thể dùng tài liệu này để tạo câu hỏi cho bất kỳ Lesson nào.</p>
            <form className="mt-4 space-y-3" onSubmit={e => { e.preventDefault(); upload.post(prefix + '/ai-documents', { forceFormData: true, preserveScroll: true, onSuccess: () => { upload.reset('documents'); setPolling(true); } }); }}><label className="block"><span className="label">Tải PDF / DOCX (tối đa 10 tệp)</span><input type="file" accept=".pdf,.docx" multiple className="field" onChange={e => upload.setData('documents', Array.from(e.target.files ?? []))} /></label>{upload.progress && <progress className="w-full" max={100} value={upload.progress.percentage} aria-label="Upload progress" />}<Button type="submit" variant="outline" leadingIcon={<Upload size={16} />} loading={upload.processing} disabled={!upload.data.documents.length}>Tải tài liệu lên</Button>{Object.values(upload.errors).map((error, i) => <FieldError key={i} message={error} />)}</form>
            <div className="mt-5 space-y-3">{scopedDocs.map(d => { const selectable = selectableStatuses.includes(d.status); const statusText = d.status === 'READY' ? 'Sẵn sàng' : d.status === 'UPLOADED' ? 'Đang phân tích' : d.status === 'PROCESSING' ? 'Đang xử lý' : d.status === 'NEEDS_REVIEW' ? 'Cần kiểm tra lại' : d.status === 'FAILED' ? 'Phân tích thất bại' : d.status; return <div key={d.id} className="rounded-xl border border-slate-200 p-3"><label className="flex items-start gap-3"><input type="checkbox" className="mt-1" disabled={!selectable} checked={form.data.document_ids.includes(d.id)} onChange={e => form.setData('document_ids', e.target.checked ? [...form.data.document_ids, d.id] : form.data.document_ids.filter(id => id !== d.id))} /><span className="min-w-0 flex-1 break-words"><span className="block">{d.original_name}</span>{selectable && d.status !== 'READY' && <span className="mt-1 block text-xs text-amber-700">Có thể chọn ngay; hệ thống sẽ chờ phân tích xong trước khi tạo câu hỏi.</span>}</span><Badge value={statusText} /></label>{d.parser_metadata_json?.sections && <p className="mt-2 text-sm text-slate-600">Detected: {d.parser_metadata_json.sections.join(', ').replaceAll('_', ' ')}</p>}{d.error_message && <p className="mt-2 text-sm text-red-700">{d.error_message}</p>}<div className="mt-2 flex gap-2"><Link className="btn btn-ghost btn-sm" href={prefix + '/documents/' + d.id}><FileText size={16} />Xem nội dung trích xuất</Link>{['FAILED', 'NEEDS_REVIEW'].includes(d.status) && <Button size="sm" variant="outline" onClick={() => router.post(prefix + '/documents/' + d.id + '/retry')}>Thử phân tích lại</Button>}</div></div>; })}{!scopedDocs.length && <p className="text-sm text-slate-500">Chưa có tài liệu nguồn. Hãy tải một PDF hoặc DOCX để bắt đầu.</p>}</div></Card>
            <Card className="p-5"><h2 className="section-title">Tác vụ tạo gần đây</h2>{jobs.data.map(j => <Link key={j.id} className="mt-3 block rounded-xl border border-slate-200 p-4 hover:bg-slate-50" href={prefix + '/ai-jobs/' + j.id + '/review'}><div className="flex justify-between gap-3"><span>Generation #{j.id}</span><Badge value={j.status} /></div><p className="mt-2 text-sm">{j.generated_count} / {j.request_json.number_of_questions} questions ready for review</p></Link>)}{!jobs.data.length && <EmptyState title="Chưa có tác vụ tạo câu hỏi" description="Select ready documents and configure your question blueprint." />}<Pagination links={jobs.links} /></Card>
        </div><Card className="p-5"><h2 className="section-title">2. Question blueprint</h2><form className="mt-4 space-y-5" onSubmit={e => { e.preventDefault(); form.post(prefix + '/ai-generator'); }}>
            <label className="block"><span className="label">Cách xử lý tài liệu</span><select className="field" value={form.data.source_mode} onChange={e => form.setData('source_mode', e.target.value as 'generated' | 'extract_exact')}><option value="extract_exact">Giữ nguyên câu hỏi trong PDF (trích xuất nguyên văn)</option><option value="generated">Sinh câu hỏi mới dựa trên nội dung PDF</option></select><p className="mt-1 text-xs text-slate-500">Chế độ nguyên văn giữ nội dung, lựa chọn và thứ tự từ PDF; câu Reading cùng đoạn văn sẽ được gom thành một block.</p></label><div className="grid gap-3 sm:grid-cols-2"><label><span className="label">Tổng số câu hỏi</span><input className="field" type="number" min={1} max={60} value={form.data.number_of_questions} onChange={e => form.setData('number_of_questions', Number(e.target.value))} /></label>{form.data.source_mode === 'extract_exact' && <label><span className="label">Phạm vi câu hỏi trong PDF</span><select className="field" value={form.data.source_scope} onChange={e => form.setData('source_scope', e.target.value as SourceScope)}><option value="all">Tất cả (Vocabulary &amp; Grammar, Reading, Writing)</option><option value="vocabulary_grammar">Vocabulary &amp; Grammar</option><option value="reading">Reading</option><option value="writing">Writing</option></select></label>}</div>
            {form.data.source_mode === 'extract_exact' ? <div className="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">Hệ thống sẽ đọc toàn bộ PDF theo thứ tự trang, tự nhận diện Vocabulary &amp; Grammar, Reading và Writing. Các câu cùng passage sẽ được gom chung; không cần chia quota theo loại.</div> : <><Counts label="Loại câu hỏi" options={options.types} values={form.data.type_counts} total={form.data.number_of_questions} onChange={v => form.setData('type_counts', v)} /><Counts label="Độ khó" options={options.difficulties} values={form.data.difficulty_counts} total={form.data.number_of_questions} onChange={v => form.setData('difficulty_counts', v)} /><Counts label="Kiến thức tiếng Anh" options={options.categories} values={form.data.category_counts} total={form.data.number_of_questions} onChange={v => form.setData('category_counts', v)} /></>}
            <label className="block"><span className="label">Yêu cầu bổ sung</span><textarea className="field min-h-24" maxLength={2000} value={form.data.additional_constraints} onChange={e => form.setData('additional_constraints', e.target.value)} /></label>
            {Object.values(form.errors).map((error, i) => <FieldError key={i} message={error} />)}
            <Button type="submit" fullWidth leadingIcon={<Sparkles size={18} />} loading={form.processing} loadingLabel="Queuing generation…" disabled={generationBlockers.length > 0}>Tạo câu hỏi tiếng Anh</Button>
            {generationBlockers.length > 0 && <div role="status" className="rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-900"><p className="font-medium">Hoàn tất các bước sau để tạo câu hỏi:</p><ul className="mt-1 list-disc space-y-1 pl-5">{generationBlockers.map(message => <li key={message}>{message}</li>)}</ul></div>}
            <p className="text-sm text-slate-500">Questions are generated in small batches. Every question remains a draft until reviewed and approved.</p>
        </form></Card></div></AppShell>;
}
