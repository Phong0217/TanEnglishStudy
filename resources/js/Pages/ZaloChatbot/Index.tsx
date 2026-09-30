import AppShell from '@/Layouts/AppShell';
import { Badge, Button, Card, EmptyState, FieldError, PageHeader, Pagination } from '@/Components/ui';
import { Head, router, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { Bot, Link2, MessageCircle, Plus, Power, Video } from 'lucide-react';

type Classroom = { id: number; name: string; code: string; status: string };
type Lesson = { id: number; title: string; status: string };
type Connection = { id: number; group_id: string; group_name?: string | null; status: string; submissions_count: number; classroom?: Classroom | null; active_lesson?: Lesson | null; last_event_at?: string | null };
type Submission = { id: number; sequence_number: number; status: string; score?: string | number | null; received_at?: string | null; connection?: { group_name?: string | null; classroom?: Classroom | null } | null; lesson?: Lesson | null };
type Props = { connections: Connection[]; classrooms: Classroom[]; lessons: Lesson[]; submissions: { data: Submission[]; links: Array<{ url: string | null; label: string; active: boolean }> }; isAdmin: boolean };

const dateTime = (value?: string | null) => value ? new Intl.DateTimeFormat('vi-VN', { dateStyle: 'short', timeStyle: 'short' }).format(new Date(value)) : '—';

export default function ZaloChatbot({ connections, classrooms, lessons, submissions }: Props) {
    const form = useForm({ classroom_id: '', group_id: '', group_name: '', active_lesson_id: '' });
    const submit = (event: FormEvent) => { event.preventDefault(); form.post('/'+(location.pathname.startsWith('/admin') ? 'admin' : 'teacher')+'/zalo-chatbot/groups', { preserveScroll: true, onSuccess: () => form.reset() }); };
    const disconnect = (id: number) => { if (window.confirm('Ngắt kết nối nhóm Zalo này?')) router.delete('/'+(location.pathname.startsWith('/admin') ? 'admin' : 'teacher')+'/zalo-chatbot/groups/'+id, { preserveScroll: true }); };
    return <AppShell>
        <Head title="Chatbot Zalo" />
        <PageHeader title="Chatbot Zalo" description="Kết nối nhóm Zalo với lớp học và theo dõi các lượt nộp Speaking theo thời gian." />
        <div className="mt-6 grid gap-5 xl:grid-cols-[380px_1fr]">
            <Card className="h-fit p-5"><div className="flex items-center gap-3"><div className="grid h-11 w-11 place-items-center rounded-2xl bg-blue-50 text-blue-600"><MessageCircle size={22} /></div><div><h2 className="section-title">Kết nối nhóm</h2><p className="text-xs text-slate-500">Không map theo tên học sinh</p></div></div>
                <form onSubmit={submit} className="mt-5 space-y-4">
                    <label className="block"><span className="label">Lớp học *</span><select className="field" value={form.data.classroom_id} onChange={e => form.setData('classroom_id', e.target.value)} required><option value="">Chọn lớp</option>{classrooms.map(c => <option key={c.id} value={c.id}>{c.name} · {c.code}</option>)}</select><FieldError message={form.errors.classroom_id} /></label>
                    <label className="block"><span className="label">Zalo Group ID *</span><input className="field" value={form.data.group_id} onChange={e => form.setData('group_id', e.target.value)} placeholder="ID do Zalo webhook gửi về" required /><FieldError message={form.errors.group_id} /></label>
                    <label className="block"><span className="label">Tên nhóm</span><input className="field" value={form.data.group_name} onChange={e => form.setData('group_name', e.target.value)} placeholder="Ví dụ: Lớp 8A - English" /></label>
                    <label className="block"><span className="label">Speaking Lesson đang nhận bài</span><select className="field" value={form.data.active_lesson_id} onChange={e => form.setData('active_lesson_id', e.target.value)}><option value="">Chưa chọn</option>{lessons.map(l => <option key={l.id} value={l.id}>{l.title} · {l.status}</option>)}</select><p className="mt-1 text-xs text-slate-500">Video mới sẽ gắn vào Lesson này, chưa gắn vào cá nhân học sinh.</p></label>
                    <Button type="submit" loading={form.processing} leadingIcon={<Link2 size={16} />}><Plus size={15} />Kết nối group</Button>
                </form>
            </Card>
            <div className="space-y-5"><Card className="p-5"><div className="flex items-center gap-2"><Bot className="text-indigo-600" size={19} /><h2 className="section-title">Các group đã kết nối</h2></div>{connections.length ? <div className="mt-4 grid gap-3 md:grid-cols-2">{connections.map(connection => <div key={connection.id} className="rounded-2xl border border-slate-200 p-4"><div className="flex items-start justify-between gap-3"><div><p className="font-semibold text-slate-900">{connection.group_name || connection.group_id}</p><p className="mt-1 text-sm text-slate-500">{connection.classroom?.name} · {connection.classroom?.code}</p></div><Badge value={connection.status} /></div><p className="mt-3 text-sm text-slate-600">Lesson: <b>{connection.active_lesson?.title || 'Chưa chọn'}</b></p><div className="mt-3 flex items-center justify-between text-xs text-slate-500"><span>{connection.submissions_count} lượt nộp</span><span>{dateTime(connection.last_event_at)}</span></div><button type="button" onClick={() => disconnect(connection.id)} className="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-red-600 hover:text-red-700"><Power size={15} />Ngắt kết nối</button></div>)}</div> : <div className="mt-4"><EmptyState title="Chưa có group Zalo" description="Kết nối group sau khi webhook của Zalo cung cấp Group ID." /></div>}</Card>
                <Card className="overflow-hidden"><div className="flex items-center gap-2 border-b border-slate-100 px-5 py-4"><Video className="text-rose-600" size={19} /><div><h2 className="section-title">Lượt nộp Speaking</h2><p className="text-xs text-slate-500">Ẩn danh, sắp xếp theo thời gian nhận</p></div></div>{submissions.data.length ? <div className="overflow-x-auto"><table className="w-full text-left text-sm"><thead className="bg-slate-50 text-xs uppercase text-slate-500"><tr><th className="px-5 py-3">STT</th><th className="px-5 py-3">Thời gian</th><th className="px-5 py-3">Lớp / Group</th><th className="px-5 py-3">Lesson</th><th className="px-5 py-3">Trạng thái</th><th className="px-5 py-3">Điểm</th></tr></thead><tbody className="divide-y divide-slate-100">{submissions.data.map(item => <tr key={item.id}><td className="px-5 py-4 font-semibold">#{item.sequence_number}</td><td className="px-5 py-4 whitespace-nowrap">{dateTime(item.received_at)}</td><td className="px-5 py-4">{item.connection?.classroom?.name || '—'}<span className="block text-xs text-slate-500">{item.connection?.group_name || 'Group'}</span></td><td className="px-5 py-4">{item.lesson?.title || '—'}</td><td className="px-5 py-4"><Badge value={item.status} /></td><td className="px-5 py-4 font-semibold text-indigo-600">{item.score ?? 'Chưa chấm'}</td></tr>)}</tbody></table></div> : <div className="p-6"><EmptyState title="Chưa có lượt nộp" description="Video hợp lệ từ group đã kết nối sẽ xuất hiện theo thứ tự thời gian." /></div>}<Pagination links={submissions.links} /></Card></div>
        </div>
    </AppShell>;
}
