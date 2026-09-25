import AppShell from '@/Layouts/AppShell';
import { Badge, Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link } from '@inertiajs/react';
import { ArrowLeft, Mail, UserRound, Users } from 'lucide-react';

type Classroom = { id: number; name: string; code: string; status: string };
type Student = { id: number; name: string; email?: string | null; status: string; student_code?: string | null; enrolled_at?: string | null };
type PageLink = { url: string | null; label: string; active: boolean };

type Props = {
    classroom: Classroom;
    course?: { id: number; title: string } | null;
    courseVersion?: { id: number; title: string } | null;
    primaryTeacher?: { id: number; name: string } | null;
    students: { data: Student[]; links: PageLink[] };
    backUrl: string;
};

const formatDate = (value?: string | null) => value ? new Intl.DateTimeFormat('vi-VN', { dateStyle: 'medium' }).format(new Date(value)) : '—';

export default function ClassroomShow({ classroom, course, courseVersion, primaryTeacher, students, backUrl }: Props) {
    return <AppShell>
        <Head title={`Học sinh · ${classroom.name}`} />
        <PageHeader title={classroom.name} description={`Danh sách học sinh đang theo học lớp ${classroom.name}.`} actions={<Link href={backUrl} className="btn-secondary"><ArrowLeft size={16} />Quay lại danh sách lớp</Link>} />

        <div className="mt-6 grid gap-4 md:grid-cols-3">
            <Card className="p-5"><p className="text-sm text-slate-500">Mã lớp</p><p className="mt-1 text-xl font-bold text-slate-900">{classroom.code}</p><div className="mt-3"><Badge value={classroom.status} /></div></Card>
            <Card className="p-5"><p className="text-sm text-slate-500">Chương trình</p><p className="mt-1 font-semibold text-slate-900">{course?.title ?? 'Lớp học độc lập'}</p>{courseVersion && <p className="mt-1 text-sm text-slate-500">{courseVersion.title}</p>}</Card>
            <Card className="p-5"><p className="text-sm text-slate-500">Giáo viên phụ trách</p><p className="mt-1 font-semibold text-slate-900">{primaryTeacher?.name ?? 'Chưa phân công'}</p></Card>
        </div>

        <Card className="mt-6 overflow-hidden">
            <div className="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                <div className="flex items-center gap-3"><div className="grid h-10 w-10 place-items-center rounded-xl bg-indigo-50 text-indigo-600"><Users size={20} /></div><div><h2 className="font-semibold text-slate-900">Học sinh trong lớp</h2><p className="text-sm text-slate-500">Danh sách ghi danh đang hoạt động</p></div></div>
                <span className="rounded-full bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700">{students.data.length} hiển thị</span>
            </div>
            {students.data.length ? <div className="divide-y divide-slate-100">
                {students.data.map((student, index) => <div key={student.id} className="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div className="flex min-w-0 items-center gap-3"><div className="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-slate-100 font-semibold text-slate-600">{student.name.slice(0, 1).toUpperCase()}</div><div className="min-w-0"><p className="font-medium text-slate-900">{index + 1}. {student.name}</p><div className="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-sm text-slate-500"><span className="inline-flex items-center gap-1"><Mail size={14} />{student.email || 'Chưa cập nhật email'}</span>{student.student_code && <span className="inline-flex items-center gap-1"><UserRound size={14} />Mã: {student.student_code}</span>}</div></div></div>
                    <div className="flex items-center gap-3 pl-13 sm:pl-0"><span className="text-xs text-slate-500">Ghi danh {formatDate(student.enrolled_at)}</span><Badge value={student.status} /></div>
                </div>)}
            </div> : <div className="p-6"><EmptyState title="Chưa có học sinh trong lớp" description="Học sinh sẽ xuất hiện sau khi được ghi danh hoặc import vào lớp này." /></div>}
            <Pagination links={students.links} />
        </Card>
    </AppShell>;
}
