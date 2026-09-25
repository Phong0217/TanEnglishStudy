import AppShell from '@/Layouts/AppShell';
import { Button, Card, FieldError, PageHeader } from '@/Components/ui';
import { Head, useForm } from '@inertiajs/react';
import { FormEvent, useEffect, useState } from 'react';
import { ImagePlus, Save, Trash2 } from 'lucide-react';

type Center = {
    id: number;
    name: string;
    code: string;
    timezone?: string;
    logoUrl?: string | null;
};

type Props = { center: Center };

type FormData = {
    name: string;
    logo: File | null;
    remove_logo: boolean;
};

export default function CenterSettings({ center }: Props) {
    const form = useForm<FormData>({ name: center.name, logo: null, remove_logo: false });
    const [preview, setPreview] = useState<string | null>(center.logoUrl ?? null);

    useEffect(() => {
        if (!form.data.logo) {
            setPreview(center.logoUrl ?? null);
            return;
        }
        const url = URL.createObjectURL(form.data.logo);
        setPreview(url);
        return () => URL.revokeObjectURL(url);
    }, [center.logoUrl, form.data.logo]);

    const submit = (event: FormEvent) => {
        event.preventDefault();
        form.post('/admin/settings/center', {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                form.setData('logo', null);
                form.setData('remove_logo', false);
            },
        });
    };

    const removeLogo = () => {
        form.setData('logo', null);
        form.setData('remove_logo', true);
        setPreview(null);
    };

    return <AppShell>
        <Head title="Cài đặt trung tâm" />
        <PageHeader title="Cài đặt trung tâm" description="Cập nhật tên và logo được hiển thị trong toàn bộ English LMS." />
        <form onSubmit={submit} className="mt-6 grid gap-6 lg:grid-cols-[1fr_340px]">
            <Card className="p-6">
                <h2 className="section-title">Thông tin nhận diện</h2>
                <p className="mt-1 text-sm text-slate-500">Thay đổi sẽ được đồng bộ cho Admin, Teacher và Student trong cùng trung tâm.</p>
                <div className="mt-6 space-y-5">
                    <label className="block">
                        <span className="label">Tên trung tâm *</span>
                        <input className="field" value={form.data.name} onChange={(event) => form.setData('name', event.target.value)} maxLength={255} required />
                        <FieldError message={form.errors.name} />
                    </label>
                    <div>
                        <span className="label">Logo trung tâm</span>
                        <label className="mt-1 flex min-h-32 cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 text-center transition hover:border-indigo-400 hover:bg-indigo-50/40">
                            <ImagePlus className="text-indigo-500" size={28} />
                            <span className="mt-2 text-sm font-semibold text-slate-700">Chọn ảnh logo</span>
                            <span className="mt-1 text-xs text-slate-500">JPG, PNG hoặc WebP · tối đa 5 MB</span>
                            <input className="sr-only" type="file" accept="image/jpeg,image/png,image/webp" onChange={(event) => { form.setData('logo', event.target.files?.[0] ?? null); form.setData('remove_logo', false); }} />
                        </label>
                        <FieldError message={form.errors.logo} />
                        {preview && <div className="mt-3 flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3"><img src={preview} alt="Logo trung tâm" className="h-16 w-16 rounded-xl object-contain" /><div className="min-w-0 flex-1"><p className="text-sm font-semibold text-slate-800">Logo hiện tại</p><p className="text-xs text-slate-500">Logo sẽ hiển thị trong thanh điều hướng.</p></div><button type="button" className="btn btn-ghost btn-icon text-red-600" onClick={removeLogo} aria-label="Xóa logo"><Trash2 size={17} /></button></div>}
                    </div>
                </div>
                <div className="mt-7 flex justify-end"><Button type="submit" loading={form.processing} leadingIcon={<Save size={17} />}>Lưu thay đổi</Button></div>
            </Card>
            <Card className="h-fit p-6">
                <h2 className="section-title">Xem trước</h2>
                <div className="mt-5 rounded-2xl bg-slate-950 p-4 text-white shadow-inner"><div className="flex items-center gap-3">{preview ? <img src={preview} alt="" className="h-10 w-10 rounded-xl bg-white p-1 object-contain" /> : <div className="grid h-10 w-10 place-items-center rounded-xl bg-indigo-500 font-semibold">EC</div>}<span className="truncate font-semibold">{form.data.name || 'Tên trung tâm'}</span></div><div className="mt-5 space-y-2"><div className="h-2 rounded-full bg-slate-800" /><div className="h-2 w-2/3 rounded-full bg-slate-800" /></div></div>
                <dl className="mt-5 space-y-3 text-sm"><div className="flex justify-between gap-4"><dt className="text-slate-500">Mã trung tâm</dt><dd className="font-medium text-slate-800">{center.code}</dd></div><div className="flex justify-between gap-4"><dt className="text-slate-500">Múi giờ</dt><dd className="font-medium text-slate-800">{center.timezone || 'Asia/Bangkok'}</dd></div></dl>
            </Card>
        </form>
    </AppShell>;
}
