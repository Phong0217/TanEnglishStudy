import AppShell from '@/Layouts/AppShell';
import { Button, Card, FieldError, PageHeader } from '@/Components/ui';
import { Head, useForm } from '@inertiajs/react';
import { FormEvent, useEffect, useState } from 'react';
import { ImagePlus, Save, Trash2 } from 'lucide-react';

type Center = { id: number; name: string; code: string; timezone?: string; logoUrl?: string | null; backgroundUrl?: string | null; backgroundColor?: string | null };
type Props = { center: Center };
type FormData = { name: string; logo: File | null; remove_logo: boolean; background: File | null; background_color: string; remove_background: boolean };

export default function CenterSettings({ center }: Props) {
    const form = useForm<FormData>({ name: center.name, logo: null, remove_logo: false, background: null, background_color: center.backgroundColor ?? '', remove_background: false });
    const [logoPreview, setLogoPreview] = useState<string | null>(center.logoUrl ?? null);
    const [backgroundPreview, setBackgroundPreview] = useState<string | null>(center.backgroundUrl ?? null);

    useEffect(() => {
        if (!form.data.logo) { setLogoPreview(center.logoUrl ?? null); return; }
        const url = URL.createObjectURL(form.data.logo); setLogoPreview(url); return () => URL.revokeObjectURL(url);
    }, [center.logoUrl, form.data.logo]);
    useEffect(() => {
        if (!form.data.background) { setBackgroundPreview(center.backgroundUrl ?? null); return; }
        const url = URL.createObjectURL(form.data.background); setBackgroundPreview(url); return () => URL.revokeObjectURL(url);
    }, [center.backgroundUrl, form.data.background]);

    const submit = (event: FormEvent) => {
        event.preventDefault();
        form.post('/admin/settings/center', { forceFormData: true, preserveScroll: true, onSuccess: () => { form.setData('logo', null); form.setData('background', null); form.setData('remove_logo', false); form.setData('remove_background', false); } });
    };
    const removeLogo = () => { form.setData('logo', null); form.setData('remove_logo', true); setLogoPreview(null); };
    const removeBackground = () => { form.setData('background', null); form.setData('remove_background', true); setBackgroundPreview(null); };

    return <AppShell>
        <Head title="Cài đặt trung tâm" />
        <PageHeader title="Cài đặt trung tâm" description="Cập nhật nhận diện thương hiệu được hiển thị trong English LMS." />
        <form onSubmit={submit} className="mt-6 grid gap-6 lg:grid-cols-[1fr_340px]">
            <Card className="p-6"><h2 className="section-title">Thông tin nhận diện</h2><p className="mt-1 text-sm text-slate-500">Các thay đổi được lưu vào trung tâm và đồng bộ cho giao diện Admin, Teacher và Student.</p>
                <div className="mt-6 space-y-6">
                    <label className="block"><span className="label">Tên trung tâm *</span><input className="field" value={form.data.name} onChange={event => form.setData('name', event.target.value)} maxLength={255} required /><FieldError message={form.errors.name} /></label>
                    <div><span className="label">Logo trung tâm</span><label className="mt-1 flex min-h-28 cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 text-center transition hover:border-indigo-400 hover:bg-indigo-50/40"><ImagePlus className="text-indigo-500" size={27} /><span className="mt-2 text-sm font-semibold text-slate-700">Chọn ảnh logo</span><span className="mt-1 text-xs text-slate-500">JPG, PNG hoặc WebP · tối đa 5 MB</span><input className="sr-only" type="file" accept="image/jpeg,image/png,image/webp" onChange={event => { form.setData('logo', event.target.files?.[0] ?? null); form.setData('remove_logo', false); }} /></label><FieldError message={form.errors.logo} />{logoPreview && <div className="mt-3 flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3"><img src={logoPreview} alt="Logo trung tâm" className="h-16 w-16 rounded-xl object-contain" /><div className="min-w-0 flex-1"><p className="text-sm font-semibold text-slate-800">Logo hiện tại</p><p className="text-xs text-slate-500">Hiển thị trên thanh điều hướng.</p></div><button type="button" className="btn btn-ghost btn-icon text-red-600" onClick={removeLogo} aria-label="Xóa logo"><Trash2 size={17} /></button></div>}</div>
                    <div><span className="label">Background giao diện</span><label className="mt-1 flex min-h-28 cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 text-center transition hover:border-indigo-400 hover:bg-indigo-50/40"><ImagePlus className="text-indigo-500" size={27} /><span className="mt-2 text-sm font-semibold text-slate-700">Chọn ảnh nền</span><span className="mt-1 text-xs text-slate-500">JPG, PNG hoặc WebP · tối đa 8 MB</span><input className="sr-only" type="file" accept="image/jpeg,image/png,image/webp" onChange={event => { form.setData('background', event.target.files?.[0] ?? null); form.setData('remove_background', false); }} /></label><FieldError message={form.errors.background} />{backgroundPreview && <div className="mt-3 flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3"><img src={backgroundPreview} alt="Background trung tâm" className="h-16 w-24 rounded-xl object-cover" /><div className="min-w-0 flex-1"><p className="text-sm font-semibold text-slate-800">Ảnh nền hiện tại</p><p className="text-xs text-slate-500">Hiển thị phía sau nội dung Admin.</p></div><button type="button" className="btn btn-ghost btn-icon text-red-600" onClick={removeBackground} aria-label="Xóa ảnh nền"><Trash2 size={17} /></button></div>}</div>
                    <label className="block"><span className="label">Màu nền dự phòng</span><div className="flex gap-2"><input type="color" className="h-11 w-14 cursor-pointer rounded-lg border border-slate-300 bg-white p-1" value={form.data.background_color || '#f8fafc'} onChange={event => form.setData('background_color', event.target.value)} aria-label="Chọn màu nền" /><input className="field" value={form.data.background_color} onChange={event => form.setData('background_color', event.target.value)} placeholder="#f8fafc" pattern="^#[0-9A-Fa-f]{6}$" /></div><FieldError message={form.errors.background_color} /><p className="mt-1 text-xs text-slate-500">Được dùng khi chưa có ảnh nền hoặc ảnh không tải được.</p></label>
                </div>
                <div className="mt-7 flex justify-end"><Button type="submit" loading={form.processing} leadingIcon={<Save size={17} />}>Lưu thay đổi</Button></div>
            </Card>
            <Card className="h-fit p-6"><h2 className="section-title">Xem trước</h2><div className="mt-5 overflow-hidden rounded-2xl bg-slate-950 bg-cover bg-center p-4 text-white shadow-inner" style={{ backgroundColor: form.data.background_color || '#0f172a', backgroundImage: backgroundPreview ? `linear-gradient(rgba(15,23,42,.55),rgba(15,23,42,.55)), url(${backgroundPreview})` : undefined }}><div className="flex items-center gap-3">{logoPreview ? <img src={logoPreview} alt="" className="h-10 w-10 rounded-xl bg-white p-1 object-contain" /> : <div className="grid h-10 w-10 place-items-center rounded-xl bg-indigo-500 font-semibold">EC</div>}<span className="truncate font-semibold">{form.data.name || 'Tên trung tâm'}</span></div><div className="mt-5 space-y-2"><div className="h-2 rounded-full bg-white/25" /><div className="h-2 w-2/3 rounded-full bg-white/25" /></div></div><dl className="mt-5 space-y-3 text-sm"><div className="flex justify-between gap-4"><dt className="text-slate-500">Mã trung tâm</dt><dd className="font-medium text-slate-800">{center.code}</dd></div><div className="flex justify-between gap-4"><dt className="text-slate-500">Múi giờ</dt><dd className="font-medium text-slate-800">{center.timezone || 'Asia/Bangkok'}</dd></div></dl></Card>
        </form>
    </AppShell>;
}
