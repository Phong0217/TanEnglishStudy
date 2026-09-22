import { useForm } from '@inertiajs/react';
import { FormEvent } from 'react';
import { Upload } from 'lucide-react';
import { Button, Card } from '@/Components/ui';

type Props = { endpoint: string; templateUrl: string; description?: string };

export default function StudentImportCard({ endpoint, templateUrl, description }: Props) {
    const form = useForm<{ file: File | null }>({ file: null });
    const submit = (event: FormEvent) => {
        event.preventDefault();
        form.post(endpoint, { forceFormData: true, preserveScroll: true, onSuccess: () => form.reset() });
    };

    return <Card className="border-indigo-100 bg-indigo-50/60 p-5"><div className="flex items-start gap-3"><div className="rounded-xl bg-white p-3 text-indigo-600"><Upload size={20} /></div><div className="min-w-0 flex-1"><h2 className="font-semibold text-slate-900">Import học sinh hàng loạt</h2><p className="mt-1 text-sm text-slate-600">{description ?? 'File CSV/XLSX cần có các cột: class_name, student_name, email, password.'}</p><form onSubmit={submit} className="mt-4 flex flex-wrap items-center gap-3"><a href={templateUrl} className="btn btn-outline">Tải file mẫu</a><input type="file" accept=".csv,.xlsx,.txt" className="field max-w-sm bg-white" onChange={event => form.setData('file', event.target.files?.[0] ?? null)} required /><Button type="submit" loading={form.processing} leadingIcon={<Upload size={16} />}>Import danh sách</Button></form>{form.errors.file && <p className="mt-2 text-sm text-red-600">{form.errors.file}</p>}</div></div></Card>;
}
