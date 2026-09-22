import AppShell from '@/Layouts/AppShell';
import { Badge, Card, FieldError, PageHeader } from '@/Components/ui';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { FormEvent } from 'react';
import { PageProps } from '@/types';

type Option = { id?: string; text?: string; label?: string; value?: string };
type Answer = { id: number; response_json: unknown; auto_score?: string; final_score?: string; feedback?: string; grading_status: string; item?: { item_type: string; content_snapshot_json: { prompt?: string; statement?: string; options?: Option[] }; points: string } };
type Submission = { id: number; student?: { name: string }; delivery?: { assignment_version?: { assignment?: { title: string } } }; answers?: Answer[]; grade?: { id: number; final_score: string; status: string; general_feedback?: string } };
export default function GradeShow({ submission }: { submission: Submission }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const answers = submission.answers ?? [];
    const grade = submission.grade;
    const form = useForm({ scores: Object.fromEntries(answers.map((answer) => [answer.id, answer.final_score ?? answer.auto_score ?? 0])), feedback: grade?.general_feedback ?? '', reason: 'Initial grading review' });
    const submit = (event: FormEvent) => { event.preventDefault(); form.put(`${prefix}/submissions/${submission.id}/grade`); };
    const title = submission.delivery?.assignment_version?.assignment?.title ?? 'Bài học';
    return <AppShell><Head title={`Chấm bài · ${submission.student?.name ?? 'Học sinh'}`} /><PageHeader title={title} description={`Bài nộp của ${submission.student?.name ?? 'học sinh'}.`} actions={grade && <Badge value={grade.status} />} /><form onSubmit={submit} className="mt-6 space-y-4">{answers.map((answer, index) => <Card key={answer.id} className="p-5"><div className="flex justify-between gap-3"><h2 className="font-medium">Câu {index + 1}: {answer.item?.content_snapshot_json.prompt ?? answer.item?.content_snapshot_json.statement ?? answer.item?.item_type?.replaceAll('_', ' ') ?? 'Câu hỏi'}</h2><Badge value={answer.grading_status} /></div><AnswerDisplay answer={answer} /><div className="mt-4 grid gap-4 sm:grid-cols-3"><label><span className="label">Điểm tự động</span><input className="field" value={answer.auto_score ?? '—'} disabled /></label><label><span className="label">Điểm cuối / {answer.item?.points ?? 0}</span><input type="number" min="0" max={answer.item?.points ?? 0} step="0.25" className="field" value={form.data.scores[answer.id]} onChange={(event) => form.setData('scores', { ...form.data.scores, [answer.id]: Number(event.target.value) })} /></label></div>{answer.feedback && <p className="mt-3 rounded-lg bg-amber-50 p-3 text-sm text-amber-800">Nhận xét câu này: {answer.feedback}</p>}</Card>)}{!answers.length && <EmptyMessage text="Bài nộp chưa có câu trả lời." />}<Card className="p-5"><label><span className="label">Nhận xét của giáo viên</span><textarea className="field min-h-28" value={form.data.feedback} onChange={(event) => form.setData('feedback', event.target.value)} /></label><label className="mt-4 block"><span className="label">Lý do cập nhật *</span><input className="field" value={form.data.reason} onChange={(event) => form.setData('reason', event.target.value)} required /><FieldError message={form.errors.reason} /></label><div className="mt-5 flex flex-wrap gap-3"><button className="btn-primary" disabled={form.processing}>Lưu điểm</button>{grade?.status === 'GRADED' && <button type="button" className="btn-secondary" onClick={() => router.post(`${prefix}/grades/${grade.id}/release`)}>Phát hành cho học sinh</button>}</div></Card></form></AppShell>;
}
function AnswerDisplay({ answer }: { answer: Answer }) {
    const response = (answer.response_json && typeof answer.response_json === 'object' ? answer.response_json : {}) as Record<string, unknown>;
    const options = answer.item?.content_snapshot_json.options ?? [];
    const selected = Array.isArray(response.selectedOptionIds) ? response.selectedOptionIds.map(String) : response.selectedOptionId ? [String(response.selectedOptionId)] : [];
    const labels = selected.map((id) => options.find((option) => String(option.id ?? option.value) === id)?.text ?? options.find((option) => String(option.id ?? option.value) === id)?.label ?? id);
    const value = response.text ?? response.value;
    return <div className="mt-4 rounded-xl border border-indigo-100 bg-indigo-50/60 p-4"><p className="text-xs font-semibold uppercase tracking-wide text-indigo-600">Câu trả lời của học sinh</p>{labels.length > 0 ? <div className="mt-2 flex flex-wrap gap-2">{labels.map((label) => <span key={label} className="rounded-lg bg-white px-3 py-2 text-sm font-medium text-slate-800 shadow-sm">{label}</span>)}</div> : typeof value === 'boolean' ? <p className="mt-2 text-base font-medium text-slate-800">{value ? 'Đúng' : 'Sai'}</p> : typeof value === 'string' && value.trim() ? <p className="mt-2 whitespace-pre-wrap text-base text-slate-800">{value}</p> : <p className="mt-2 text-sm italic text-slate-500">Chưa có câu trả lời</p>}</div>;
}
function EmptyMessage({ text }: { text: string }) { return <Card className="p-5 text-sm text-slate-500">{text}</Card>; }
