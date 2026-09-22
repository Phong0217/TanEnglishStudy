import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, PageHeader, Pagination } from '@/Components/ui';
import { Head, Link, router, useForm, usePage } from '@inertiajs/react';
import { BookOpen, Pencil, Plus, Trash2 } from 'lucide-react';
import { PageProps } from '@/types';

type Lesson = { id: number; title: string; status: string; unit: string; course: string; blocksCount: number; canEdit: boolean };
type Unit = { id: number; title: string; course: string };

export default function Lessons({ lessons, units = [] }: { lessons: { data: Lesson[]; links: Array<{ url: string | null; label: string; active: boolean }> }; units?: Unit[] }) {
    const { auth } = usePage<PageProps>().props;
    const prefix = auth.role === 'ADMIN' ? '/admin' : '/teacher';
    const form = useForm({ unit_id: units[0]?.id ?? '', title: '' });
    const createLesson = (event: React.FormEvent) => { event.preventDefault(); form.post(`${prefix}/lessons`, { preserveScroll: true, onSuccess: () => form.reset('title') }); };
    const deleteLesson = (id: number) => { if (window.confirm('Xóa vĩnh viễn Lesson này và toàn bộ bài làm, điểm số của học sinh? Hành động này không thể hoàn tác.')) router.delete(`${prefix}/lessons/${id}`); };

    return <AppShell><Head title="Lesson Builder" /><PageHeader title="Lesson Builder" description="Create structured lessons, interactive blocks, and publish-ready learning experiences." actions={units.length > 0 && <form onSubmit={createLesson} className="flex flex-wrap items-center gap-2"><select className="field min-w-44" value={form.data.unit_id} onChange={(e) => form.setData('unit_id', Number(e.target.value))} aria-label="Bài học phần"><option value="">Chọn bài học phần</option>{units.map((unit) => <option key={unit.id} value={unit.id}>{unit.course} · {unit.title}</option>)}</select><input className="field w-44" value={form.data.title} onChange={(e) => form.setData('title', e.target.value)} placeholder="Tiêu đề bài học" aria-label="Tiêu đề bài học" required /><Button type="submit" loading={form.processing} leadingIcon={<Plus size={16} />}>Bài học mới</Button></form>} /><Card className="mt-6">{lessons.data.length ? <div className="divide-y divide-slate-100">{lessons.data.map((lesson) => <div key={lesson.id} className="flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between"><div><div className="flex items-center gap-2"><h2 className="font-medium text-slate-900">{lesson.title}</h2><Badge value={lesson.status} /></div><p className="mt-1 text-sm text-slate-500">{lesson.course} · {lesson.unit} · {lesson.blocksCount} blocks</p></div>{lesson.canEdit && <div className="flex flex-wrap gap-2"><Link href={`${prefix}/lessons/${lesson.id}/builder`} className="btn-secondary"><Pencil size={16} />Mở trình xây dựng</Link><button type="button" className="btn btn-danger" onClick={() => deleteLesson(lesson.id)}><Trash2 size={16} />Xóa Lesson</button></div>}</div>)}</div> : <div className="p-5"><EmptyState title="Chưa có bài học" description={units.length ? 'Tạo bài học đầu tiên để mở trình xây dựng.' : 'Bài học sẽ xuất hiện sau khi tạo phiên bản khóa học và bài học phần.'} action={units.length > 0 && <BookOpen size={18} />} /></div>}<Pagination links={lessons.links} /></Card></AppShell>;
}
