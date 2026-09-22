import AppShell from '@/Layouts/AppShell';
import { Badge, Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, router, usePage } from '@inertiajs/react';
import { Trash2 } from 'lucide-react';
import { PageProps } from '@/types';

type Version = { id: number; version_number: number; total_points: string; is_locked: boolean; items_count: number; deliveries_count: number };
type Assignment = { id: number; title: string; status: string; versions: Version[] };
type Classroom = { id: number; name: string; code: string };

export default function Assignments({ assignments }: { assignments: { data: Assignment[]; links: Array<{ url: string | null; label: string; active: boolean }> }; questions?: unknown[]; classrooms?: Classroom[] }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const remove = (assignment: Assignment) => {
        if (window.confirm(`Xóa assignment “${assignment.title}”? Dữ liệu bài nộp và điểm sẽ được giữ lại.`)) {
            router.delete(`${prefix}/assignments/${assignment.id}`);
        }
    };

    return <AppShell><Head title="Bài tập" /><PageHeader title="Bài tập" description="Các bài tập hiện có trong hệ thống." /><Card className="mt-6">{assignments.data.length ? <div className="divide-y divide-slate-100">{assignments.data.map((assignment) => { const version = assignment.versions[0]; return <div key={assignment.id} className="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between"><div><div className="flex items-center gap-2"><h2 className="font-medium">{assignment.title}</h2><Badge value={assignment.status} /></div><p className="mt-1 text-sm text-slate-500">Version {version?.version_number ?? 1} · {version?.items_count ?? 0} items · {version?.total_points ?? 0} points · {version?.deliveries_count ?? 0} deliveries</p></div><button type="button" className="btn-danger self-start sm:self-auto" onClick={() => remove(assignment)} aria-label={`Xóa assignment ${assignment.title}`}><Trash2 size={16} />Xóa Assignment</button></div>; })}</div> : <div className="p-5"><EmptyState title="Chưa có bài tập" description="Bài tập được tạo từ Lesson Builder sẽ xuất hiện ở đây." /></div>}<Pagination links={assignments.links} /></Card></AppShell>;
}
