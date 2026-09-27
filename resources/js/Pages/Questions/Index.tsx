import AppShell from '@/Layouts/AppShell';
import { Badge, Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { FormEvent, useEffect, useMemo, useState } from 'react';
import { Check, Plus, Trash2 } from 'lucide-react';
import { PageProps } from '@/types';

type Question = {
    id: number;
    type: string;
    skill: string;
    difficulty: string;
    status: string;
    usage_count: number;
    ai_generation_job_id?: number;
    versions: Array<{ id: number; content_json: { prompt?: string }; explanation?: string }>;
    creator?: { name: string };
};

type Props = { questions: { data: Question[]; links: Array<{ url: string | null; label: string; active: boolean }> } };

export default function Questions({ questions }: Props) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const [selected, setSelected] = useState<number[]>([]);
    const ids = useMemo(() => questions.data.map((question) => question.id), [questions.data]);
    const allSelected = ids.length > 0 && ids.every((id) => selected.includes(id));
    const form = useForm({ type: 'multiple_choice', skill: 'READING', difficulty: 'MEDIUM', content: { prompt: '', options: [{ id: 'a', text: '' }, { id: 'b', text: '' }, { id: 'c', text: '' }] }, answer_key: { correctOptionId: 'a' }, settings: {}, explanation: '', rubric: null as null, grading_mode: 'AUTO' });

    useEffect(() => setSelected((current) => current.filter((id) => ids.includes(id))), [ids]);

    const toggle = (id: number) => setSelected((current) => current.includes(id) ? current.filter((item) => item !== id) : [...current, id]);
    const toggleAll = () => setSelected(allSelected ? [] : ids);
    const remove = (id: number) => {
        if (!window.confirm('Xóa câu hỏi này khỏi ngân hàng? Dữ liệu đã dùng trong bài học vẫn được giữ an toàn.')) return;
        router.delete(`${prefix}/questions/${id}`, { preserveScroll: true });
    };
    const removeSelected = () => {
        if (!selected.length || !window.confirm(`Xóa ${selected.length} câu hỏi đã chọn khỏi ngân hàng?`)) return;
        router.delete(`${prefix}/questions`, { data: { question_ids: selected }, preserveScroll: true, onSuccess: () => setSelected([]) });
    };
    const submit = (event: FormEvent) => { event.preventDefault(); form.post(`${prefix}/questions`, { onSuccess: () => form.reset() }); };

    return <AppShell>
        <Head title="Ngân hàng câu hỏi" />
        <PageHeader title="Ngân hàng câu hỏi" description="Quản lý, duyệt và xóa các câu hỏi trong phạm vi trung tâm của bạn." actions={<Link href={`${prefix}/ai-generator`} className="btn btn-primary">Tạo câu hỏi AI từ tài liệu</Link>} />
        <Card className="mt-6">
            {questions.data.length ? <>
                <div className="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-5 py-4">
                    <label className="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <input type="checkbox" checked={allSelected} onChange={toggleAll} aria-label="Chọn tất cả câu hỏi trên trang" />
                        Chọn tất cả trên trang
                    </label>
                    <div className="flex items-center gap-3">
                        {selected.length > 0 && <span className="text-sm text-slate-500">Đã chọn {selected.length}</span>}
                        <button type="button" className="btn btn-danger btn-sm" disabled={!selected.length} onClick={removeSelected}><Trash2 size={16} /> Xóa đã chọn</button>
                    </div>
                </div>
                <div className="divide-y divide-slate-100">{questions.data.map((q) => <div key={q.id} className="p-5">
                    <div className="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div className="flex min-w-0 items-start gap-3">
                            <input type="checkbox" checked={selected.includes(q.id)} onChange={() => toggle(q.id)} aria-label={`Chọn câu hỏi ${q.id}`} className="mt-1.5" />
                            <div className="min-w-0"><p className="font-medium text-slate-900">{q.versions[0]?.content_json.prompt || q.type.replaceAll('_', ' ')}</p><p className="mt-1 text-sm text-slate-500">{q.type.replaceAll('_', ' ')} · {q.skill} · {q.difficulty} · {q.usage_count} uses{q.creator?.name ? ` · ${q.creator.name}` : ''}</p></div>
                        </div>
                        <div className="flex flex-wrap items-center gap-2"><Badge value={q.status} />{q.ai_generation_job_id && <Link className="btn btn-outline btn-sm" href={`${prefix}/ai-jobs/${q.ai_generation_job_id}/review`}>Review / View source</Link>}{q.status === 'IN_REVIEW' && <><button className="btn-secondary px-3" onClick={() => router.patch(`${prefix}/questions/${q.id}/review`, { status: 'APPROVED' })}><Check size={15} />Approve</button><button className="btn-secondary px-3 text-red-600" onClick={() => router.patch(`${prefix}/questions/${q.id}/review`, { status: 'REJECTED', reason: 'Content requires revision.' })}>Reject</button></>}<button type="button" className="btn btn-ghost btn-sm text-red-600 hover:bg-red-50" onClick={() => remove(q.id)}><Trash2 size={15} /> Xóa</button></div>
                    </div>
                </div>)}</div>
            </> : <div className="p-5"><EmptyState title="No questions found" description="Create a question manually or generate grounded drafts from documents." /></div>}
            <Pagination links={questions.links} />
        </Card>
        <Card id="create-question" className="mt-6 p-5"><h2 className="section-title">Create multiple-choice question</h2><p className="muted mt-1">This editor enforces three non-empty options and one correct answer.</p><form onSubmit={submit} className="mt-5 space-y-4"><label><span className="label">Prompt *</span><input className="field" value={form.data.content.prompt} onChange={e => form.setData('content', { ...form.data.content, prompt: e.target.value })} required /></label><div className="grid gap-3 md:grid-cols-3">{form.data.content.options.map((option, index) => <label key={option.id}><span className="label">Option {option.id.toUpperCase()} *</span><input className="field" value={option.text} onChange={e => form.setData('content', { ...form.data.content, options: form.data.content.options.map((o, i) => i === index ? { ...o, text: e.target.value } : o) })} required /></label>)}</div><div className="grid gap-4 sm:grid-cols-3"><label><span className="label">Correct option</span><select className="field" value={form.data.answer_key.correctOptionId} onChange={e => form.setData('answer_key', { correctOptionId: e.target.value })}>{form.data.content.options.map(o => <option key={o.id} value={o.id}>{o.id.toUpperCase()}</option>)}</select></label><label><span className="label">Skill</span><select className="field" value={form.data.skill} onChange={e => form.setData('skill', e.target.value)}>{['READING', 'LISTENING', 'VOCABULARY', 'GRAMMAR', 'WRITING', 'SPEAKING', 'MIXED'].map(v => <option key={v}>{v}</option>)}</select></label><label><span className="label">Độ khó</span><select className="field" value={form.data.difficulty} onChange={e => form.setData('difficulty', e.target.value)}>{['EASY', 'MEDIUM', 'HARD'].map(v => <option key={v}>{v}</option>)}</select></label></div><button className="btn-primary" disabled={form.processing}><Plus size={16} />Save draft question</button></form></Card>
    </AppShell>;
}
