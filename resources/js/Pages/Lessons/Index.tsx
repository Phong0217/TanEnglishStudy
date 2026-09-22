import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { BookOpen, Pencil, Plus, Trash2 } from 'lucide-react';
import { PageProps } from '@/types';

type Lesson = { id: number; title: string; status: string; unit?: string | null; course?: string | null; blocksCount: number; createdAt?: string; createdBy?: string; canEdit: boolean };
type Option = { id: number; name: string; code?: string };
type Filters = { teacher_id?: string; classroom_id?: string; date?: string };

export default function Lessons({ lessons, teachers = [], classrooms = [], filters = {} }: { lessons: { data: Lesson[]; links: Array<{ url: string | null; label: string; active: boolean }> }; teachers?: Option[]; classrooms?: Option[]; filters?: Filters }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const isAdmin = auth.role === 'ADMIN';
    const form = useForm({ title: '' });
    const createLesson = (event: React.FormEvent) => { event.preventDefault(); form.post(`${prefix}/lessons`, { preserveScroll: true, onSuccess: () => form.reset() }); };
    const deleteLesson = (id: number) => { if (window.confirm('Xóa vĩnh viễn Lesson này và toàn bộ bài làm, điểm số của học sinh? Hành động này không thể hoàn tác.')) router.delete(`${prefix}/lessons/${id}`); };
    const applyFilters = (event: React.FormEvent<HTMLFormElement>) => { event.preventDefault(); const data = Object.fromEntries(new FormData(event.currentTarget)); router.get(`${prefix}/lessons`, data, { preserveState: true, replace: true }); };
    return <AppShell><Head title="Lesson Builder" /><PageHeader title="Lesson Builder" description={isAdmin ? 'Quản lý toàn bộ bài tập độc lập do trung tâm và giáo viên tạo.' : 'Tạo bài tập độc lập để giao trực tiếp cho học sinh.'} actions={<form onSubmit={createLesson} className="flex flex-wrap items-center gap-2"><input className="field w-56" value={form.data.title} onChange={event => form.setData('title', event.target.value)} placeholder="Tiêu đề bài tập" aria-label="Tiêu đề bài tập" required /><Button type="submit" loading={form.processing} leadingIcon={<Plus size={16} />}>Bài tập mới</Button></form>} />
        {isAdmin && <Card className="mt-6 p-4"><form onSubmit={applyFilters} className="grid gap-3 md:grid-cols-4"><select className="field" name="teacher_id" defaultValue={filters.teacher_id ?? ''}><option value="">Tất cả giáo viên</option>{teachers.map(teacher => <option key={teacher.id} value={teacher.id}>{teacher.name}</option>)}</select><select className="field" name="classroom_id" defaultValue={filters.classroom_id ?? ''}><option value="">Tất cả lớp được phân công</option>{classrooms.map(classroom => <option key={classroom.id} value={classroom.id}>{classroom.name}{classroom.code ? ` · ${classroom.code}` : ''}</option>)}</select><input className="field" type="date" name="date" defaultValue={filters.date ?? ''} aria-label="Lọc theo ngày tạo" /><div className="flex gap-2"><Button type="submit">Lọc</Button><Link href="/admin/lessons" className="btn-secondary">Xóa lọc</Link></div></form></Card>}
        <Card className="mt-6">{lessons.data.length ? <div className="divide-y divide-slate-100">{lessons.data.map(lesson => <div key={lesson.id} className="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between"><div><div className="flex flex-wrap items-center gap-2"><h2 className="font-medium text-slate-900">{lesson.title}</h2><Badge value={lesson.status} /></div><p className="mt-1 text-sm text-slate-500">{lesson.blocksCount} blocks{lesson.unit ? ` · ${lesson.unit}` : ' · Bài tập độc lập'}</p>{isAdmin && <p className="mt-1 text-xs text-slate-400">Tạo bởi: {lesson.createdBy ?? 'Không xác định'} · {lesson.createdAt ? new Date(lesson.createdAt).toLocaleDateString('vi-VN') : '—'}</p>}</div>{lesson.canEdit && <div className="flex flex-wrap gap-2"><Link href={`${prefix}/lessons/${lesson.id}/builder`} className="btn-secondary"><Pencil size={16} />Mở trình xây dựng</Link><button type="button" className="btn btn-danger" onClick={() => deleteLesson(lesson.id)}><Trash2 size={16} />Xóa Lesson</button></div>}</div>)}</div> : <div className="p-5"><EmptyState title="Chưa có bài tập" description="Tạo bài tập đầu tiên để mở trình xây dựng." action={<BookOpen size={18} />} /></div>}<Pagination links={lessons.links} /></Card>
    </AppShell>;
}
