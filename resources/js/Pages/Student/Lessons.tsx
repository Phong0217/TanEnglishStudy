import AppShell from '@/Layouts/AppShell';
import { Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link } from '@inertiajs/react';
import { ArrowRight, BookOpen, CheckCircle2, Clock3, RotateCcw } from 'lucide-react';

type LessonDelivery = {
    id: number;
    title: string;
    description?: string | null;
    classroom?: string;
    open_at?: string | null;
    due_at?: string | null;
    status?: string | null;
    delivery_status?: string;
    submitted?: boolean;
    allow_review?: boolean;
    action: 'start' | 'continue' | 'review' | 'completed';
    action_label: string;
    attempts_used: number;
    max_attempts: number;
    url: string;
};

type Props = {
    lessons: {
        data: LessonDelivery[];
        links: Array<{ url: string | null; label: string; active: boolean }>;
    };
};

const dateLabel = (value?: string | null) => value ? new Date(value).toLocaleDateString('vi-VN') : 'Chưa đặt hạn';

export default function Lessons({ lessons }: Props) {
    return <AppShell>
        <Head title="Bài học" />
        <PageHeader title="Bài học của tôi" description="Tất cả bài học được giáo viên giao cho các lớp của bạn." />
        <div className="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            {lessons.data.map((lesson) => {
                const completed = lesson.action === 'completed' || lesson.action === 'review';
                const active = lesson.action === 'continue';
                return <Card key={lesson.id} className="student-card">
                    <div className="flex items-start justify-between gap-3">
                        <div className="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-indigo-600"><BookOpen size={21} /></div>
                        <span className={`inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold ${completed ? 'bg-emerald-50 text-emerald-700' : active ? 'bg-amber-50 text-amber-700' : 'bg-indigo-50 text-indigo-700'}`}>
                            {completed ? <CheckCircle2 size={13} /> : active ? <RotateCcw size={13} /> : <Clock3 size={13} />}
                            {completed ? (lesson.action === 'review' ? 'Đã nộp' : 'Đã hoàn thành') : active ? 'Đang làm' : 'Chưa làm'}
                        </span>
                    </div>
                    <h2 className="mt-4 text-lg font-semibold text-slate-900">{lesson.title}</h2>
                    <p className="mt-1 text-sm text-slate-500">{lesson.classroom || 'Lớp học'} · Hạn {dateLabel(lesson.due_at)}</p>
                    <p className="mt-3 flex-1 text-sm text-slate-600">{lesson.description || 'Mở bài học để bắt đầu học.'}</p>
                    <p className="mt-3 text-xs text-slate-400">Lượt làm: {lesson.attempts_used}/{lesson.max_attempts}</p>
                    <div className="student-card-action">
                        {lesson.action === 'completed' ? <span className="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-500">Đã hoàn thành</span> : <Link href={lesson.url} className={`btn btn-lg w-full ${lesson.action === 'review' ? 'btn-secondary' : 'btn-primary'}`}>{lesson.action_label} <ArrowRight size={16} /></Link>}
                    </div>
                </Card>;
            })}
            {!lessons.data.length && <div className="md:col-span-2 xl:col-span-3"><EmptyState title="Chưa có bài học được giao" description="Bài học mới sẽ xuất hiện ở đây khi giáo viên giao cho lớp của bạn." /></div>}
        </div>
        <Pagination links={lessons.links} />
    </AppShell>;
}
