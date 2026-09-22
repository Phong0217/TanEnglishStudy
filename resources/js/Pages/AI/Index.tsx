import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, FieldError, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import { FileText, Sparkles, Upload } from 'lucide-react';
import { PageProps } from '@/types';

export type Options = { types: Record<string, string>; difficulties: Record<string, string>; categories: Record<string, string> };
type Job = { id: number; status: string; generated_count: number; error_message?: string; request_json: { number_of_questions: number } };
type Doc = { id: number; course_version_id: number; original_name: string; status: string; error_message?: string; parser_metadata_json?: { sections?: string[] } };
type Version = { id: number; label: string; grade_level: number | null; cefr_level: string | null };

export function Counts({ label, options, values, onChange, total }: { label: string; options: Record<string, string>; values: Record<string, number>; onChange: (value: Record<string, number>) => void; total: number }) {
    const sum = Object.values(values).reduce((a, b) => a + b, 0);
    return <fieldset className="space-y-3 rounded-xl border border-slate-200 p-4"><legend className="px-1 font-medium">{label} · {sum} / {total}</legend><div className="grid gap-3 sm:grid-cols-2">{Object.entries(options).map(([key, text]) => <label key={key}><span className="label">{text}</span><input className="field" type="number" min={0} max={60} value={values[key] ?? 0} onChange={e => onChange({ ...values, [key]: Number(e.target.value) })} /></label>)}</div>{sum !== total && <p role="alert" className="text-sm text-red-700">The total must equal {total} questions.</p>}</fieldset>;
}

export default function AI({ jobs, documents, courseVersions, options, providerReady }: { jobs: { data: Job[]; links: Array<{ url: string | null; label: string; active: boolean }> }; documents: Doc[]; courseVersions: Version[]; options: Options; providerReady: boolean }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const [polling, setPolling] = useState(true);
    const form = useForm({
        course_version_id: String(courseVersions[0]?.id ?? ''), document_ids: [] as number[], request_key: crypto.randomUUID(),
        grade_level: String(courseVersions[0]?.grade_level ?? ''), cefr_level: courseVersions[0]?.cefr_level ?? '',
        number_of_questions: 5, type_counts: { multiple_choice: 5 } as Record<string, number>,
        difficulty_counts: { EASY: 5 } as Record<string, number>, category_counts: { reading: 5 } as Record<string, number>, additional_constraints: '',
    });
    const upload = useForm({ course_version_id: form.data.course_version_id, documents: [] as File[] });
    const scopedDocs = documents.filter(d => String(d.course_version_id) === form.data.course_version_id);
    const working = scopedDocs.some(d => ['UPLOADED', 'PROCESSING'].includes(d.status)) || jobs.data.some(j => ['QUEUED', 'PROCESSING'].includes(j.status));
    useEffect(() => {
        if (!working || !polling) return;
        let count = 0;
        const timer = setInterval(() => { if (++count > 120) { setPolling(false); clearInterval(timer); return; } router.reload({ only: ['documents', 'jobs'] }); }, 5000);
        return () => clearInterval(timer);
    }, [working, polling]);
    const balanced = [form.data.type_counts, form.data.difficulty_counts, form.data.category_counts].every(c => Object.values(c).reduce((a, b) => a + b, 0) === form.data.number_of_questions);
    const generationBlockers = [
        !providerReady ? 'Configure the OpenAI provider and API key.' : null,
        !form.data.document_ids.length ? 'Select at least one document with READY status.' : null,
        !balanced ? 'Make every blueprint total match Total questions.' : null,
    ].filter((message): message is string => Boolean(message));
    return <AppShell><Head title="Tạo câu hỏi AI từ tài liệu" /><PageHeader title="Tạo câu hỏi AI từ tài liệu" description="Turn English source material into reviewable vocabulary, grammar and reading questions." actions={<Link className="btn btn-outline" href={prefix + '/questions'}>Ngân hàng câu hỏi</Link>} />
        {!providerReady && <div role="status" className="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">AI generation is not configured. You can upload and prepare documents. Ask your administrator to configure the AI provider.</div>}
        {!polling && <Button className="mt-4" variant="outline" onClick={() => { router.reload({ only: ['documents', 'jobs'] }); setPolling(true); }}>Tiếp tục cập nhật trạng thái</Button>}
        <div className="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]"><div className="space-y-6">
            <Card className="p-5"><h2 className="section-title">1. Course and source documents</h2><label className="mt-4 block"><span className="label">Course / Semester</span><select className="field" value={form.data.course_version_id} onChange={e => { const v = courseVersions.find(v => String(v.id) === e.target.value); form.setData({ ...form.data, course_version_id: e.target.value, document_ids: [], grade_level: String(v?.grade_level ?? ''), cefr_level: v?.cefr_level ?? '' }); upload.setData('course_version_id', e.target.value); }}><option value="">Chọn phiên bản khóa học</option>{courseVersions.map(v => <option key={v.id} value={v.id}>{v.label}</option>)}</select></label>
            <form className="mt-4 space-y-3" onSubmit={e => { e.preventDefault(); upload.post(prefix + '/ai-documents', { forceFormData: true, preserveScroll: true, onSuccess: () => { upload.reset('documents'); setPolling(true); } }); }}><label className="block"><span className="label">Tải PDF / DOCX (tối đa 10 tệp)</span><input type="file" accept=".pdf,.docx" multiple className="field" onChange={e => upload.setData('documents', Array.from(e.target.files ?? []))} /></label>{upload.progress && <progress className="w-full" max={100} value={upload.progress.percentage} aria-label="Upload progress" />}<Button type="submit" variant="outline" leadingIcon={<Upload size={16} />} loading={upload.processing} disabled={!upload.data.documents.length || !upload.data.course_version_id}>Tải tài liệu lên</Button>{Object.values(upload.errors).map((error, i) => <FieldError key={i} message={error} />)}</form>
            <div className="mt-5 space-y-3">{scopedDocs.map(d => <div key={d.id} className="rounded-xl border border-slate-200 p-3"><label className="flex items-start gap-3"><input type="checkbox" className="mt-1" disabled={d.status !== 'READY'} checked={form.data.document_ids.includes(d.id)} onChange={e => form.setData('document_ids', e.target.checked ? [...form.data.document_ids, d.id] : form.data.document_ids.filter(id => id !== d.id))} /><span className="min-w-0 flex-1 break-words">{d.original_name}</span><Badge value={d.status} /></label>{d.parser_metadata_json?.sections && <p className="mt-2 text-sm text-slate-600">Detected: {d.parser_metadata_json.sections.join(', ').replaceAll('_', ' ')}</p>}{d.error_message && <p className="mt-2 text-sm text-red-700">{d.error_message}</p>}<div className="mt-2 flex gap-2"><Link className="btn btn-ghost btn-sm" href={prefix + '/documents/' + d.id}><FileText size={16} />Xem nội dung trích xuất</Link>{['FAILED', 'NEEDS_REVIEW'].includes(d.status) && <Button size="sm" variant="outline" onClick={() => router.post(prefix + '/documents/' + d.id + '/retry')}>Thử phân tích lại</Button>}</div></div>)}{!scopedDocs.length && <p className="text-sm text-slate-500">Upload a source file for this course to begin.</p>}</div></Card>
            <Card className="p-5"><h2 className="section-title">Tác vụ tạo gần đây</h2>{jobs.data.map(j => <Link key={j.id} className="mt-3 block rounded-xl border border-slate-200 p-4 hover:bg-slate-50" href={prefix + '/ai-jobs/' + j.id + '/review'}><div className="flex justify-between gap-3"><span>Generation #{j.id}</span><Badge value={j.status} /></div><p className="mt-2 text-sm">{j.generated_count} / {j.request_json.number_of_questions} questions ready for review</p></Link>)}{!jobs.data.length && <EmptyState title="Chưa có tác vụ tạo câu hỏi" description="Select ready documents and configure your question blueprint." />}<Pagination links={jobs.links} /></Card>
        </div><Card className="p-5"><h2 className="section-title">2. Question blueprint</h2><form className="mt-4 space-y-5" onSubmit={e => { e.preventDefault(); form.post(prefix + '/ai-generator'); }}>
            <div className="grid gap-3 sm:grid-cols-3"><label><span className="label">Tổng số câu hỏi</span><input className="field" type="number" min={1} max={60} value={form.data.number_of_questions} onChange={e => form.setData('number_of_questions', Number(e.target.value))} /></label><label><span className="label">Khối lớp</span><input className="field" type="number" min={1} max={12} value={form.data.grade_level} onChange={e => form.setData('grade_level', e.target.value)} /></label><label><span className="label">CEFR</span><select className="field" value={form.data.cefr_level} onChange={e => form.setData('cefr_level', e.target.value)}><option value="">Chưa chỉ định</option>{['A1','A2','B1','B2','C1','C2'].map(v => <option key={v}>{v}</option>)}</select></label></div>
            <Counts label="Loại câu hỏi" options={options.types} values={form.data.type_counts} total={form.data.number_of_questions} onChange={v => form.setData('type_counts', v)} />
            <Counts label="Độ khó" options={options.difficulties} values={form.data.difficulty_counts} total={form.data.number_of_questions} onChange={v => form.setData('difficulty_counts', v)} />
            <Counts label="Kiến thức tiếng Anh" options={options.categories} values={form.data.category_counts} total={form.data.number_of_questions} onChange={v => form.setData('category_counts', v)} />
            <label className="block"><span className="label">Yêu cầu bổ sung</span><textarea className="field min-h-24" maxLength={2000} value={form.data.additional_constraints} onChange={e => form.setData('additional_constraints', e.target.value)} /></label>
            {Object.values(form.errors).map((error, i) => <FieldError key={i} message={error} />)}
            <Button type="submit" fullWidth leadingIcon={<Sparkles size={18} />} loading={form.processing} loadingLabel="Queuing generation…" disabled={generationBlockers.length > 0}>Tạo câu hỏi tiếng Anh</Button>
            {generationBlockers.length > 0 && <div role="status" className="rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-900"><p className="font-medium">Hoàn tất các bước sau để tạo câu hỏi:</p><ul className="mt-1 list-disc space-y-1 pl-5">{generationBlockers.map(message => <li key={message}>{message}</li>)}</ul></div>}
            <p className="text-sm text-slate-500">Questions are generated in small batches. Every question remains a draft until reviewed and approved.</p>
        </form></Card></div></AppShell>;
}
