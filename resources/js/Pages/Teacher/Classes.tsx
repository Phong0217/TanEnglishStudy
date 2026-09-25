import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, PageHeader } from '@/Components/ui';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { Upload } from 'lucide-react';

type Classroom = { id: number; name: string; code: string; status: string; student_count: number; deliveries_count: number; course_version?: { title: string; course: { title: string } } | null; primary_teacher?: { name: string } };

export default function Classes({ classes }: { classes: Classroom[] }) {
    const form = useForm<{ file: File | null }>({ file: null });
    const submit = (e: FormEvent) => { e.preventDefault(); form.post('/teacher/classrooms/import-students', { forceFormData: true, onSuccess: () => form.reset() }); };
    return <AppShell><Head title="Lớp của tôi" /><PageHeader title="Lớp học của tôi" description="Các lớp đang được phân công và danh sách học sinh." />
        <Card className="mt-6 border-indigo-100 bg-indigo-50/60 p-5"><div className="flex items-start gap-3"><div className="rounded-xl bg-white p-3 text-indigo-600"><Upload size={20} /></div><div><h2 className="font-semibold text-slate-900">Import học sinh vào lớp</h2><p className="mt-1 text-sm text-slate-600">Chỉ import được vào lớp bạn đang phụ trách. File CSV/XLSX cần có: <b>class_name, student_name, email, password</b>.</p><form onSubmit={submit} className="mt-4 flex flex-wrap items-center gap-3"><a href="/teacher/classrooms/import-students/template" className="btn btn-outline">Tải file mẫu</a><input type="file" accept=".csv,.xlsx" className="field max-w-sm bg-white" onChange={e => form.setData('file', e.target.files?.[0] ?? null)} required /><Button type="submit" loading={form.processing} leadingIcon={<Upload size={16} />}>Import danh sách</Button></form>{form.errors.file && <p className="mt-2 text-sm text-red-600">{form.errors.file}</p>}</div></div></Card>
        <div className="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">{classes.map(c => <Link key={c.id} href={`/teacher/classes/${c.id}`} className="block rounded-2xl transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500"><Card className="h-full p-5"><div className="flex justify-between gap-3"><h2 className="text-lg font-semibold">{c.name}</h2><Badge value={c.status} /></div><p className="mt-2 text-sm text-slate-500">{c.course_version ? `${c.course_version.course.title} · ${c.course_version.title}` : 'Lớp học độc lập'}</p><div className="mt-5 grid grid-cols-2 gap-3"><div className="rounded-xl bg-slate-50 p-3"><p className="text-2xl font-semibold">{c.student_count}</p><p className="text-xs text-slate-500">Học sinh</p></div><div className="rounded-xl bg-slate-50 p-3"><p className="text-2xl font-semibold">{c.deliveries_count}</p><p className="text-xs text-slate-500">Bài học đã giao</p></div></div><p className="mt-4 text-sm font-semibold text-indigo-600">Xem danh sách học sinh →</p></Card></Link>)}{!classes.length && <div className="md:col-span-2"><EmptyState title="Chưa được phân công lớp" description="Quản trị viên sẽ phân công lớp giảng dạy cho bạn." /></div>}</div>
    </AppShell>;
}
