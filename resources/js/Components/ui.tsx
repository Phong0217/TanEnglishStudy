import { Link } from '@inertiajs/react';
import { ReactNode } from 'react';
import { Inbox } from 'lucide-react';
import Button from './Button';

export function PageHeader({ title, description, actions }: { title: string; description?: string; actions?: ReactNode }) {
    return <div className="page-header"><div className="page-header-copy"><h1 className="page-title">{title}</h1>{description && <p className="page-description">{description}</p>}</div>{actions && <div className="page-actions">{actions}</div>}</div>;
}
export function Card({ children, className = '', id }: { children: ReactNode; className?: string; id?: string }) { return <section id={id} className={`surface ${className}`}>{children}</section>; }
const statusLabels: Record<string, string> = { ACTIVE: 'Đang hoạt động', INACTIVE: 'Không hoạt động', SUSPENDED: 'Tạm khóa', ARCHIVED: 'Đã lưu trữ', DRAFT: 'Bản nháp', PUBLISHED: 'Đã xuất bản', SCHEDULED: 'Đã lên lịch', OPEN: 'Đang mở', CLOSED: 'Đã đóng', COMPLETED: 'Đã hoàn thành', READY: 'Sẵn sàng', PROCESSING: 'Đang xử lý', PENDING: 'Đang chờ', IN_REVIEW: 'Đang duyệt', GRADED: 'Đã chấm', RELEASED: 'Đã phát hành', FAILED: 'Thất bại', REJECTED: 'Đã từ chối', LATE: 'Nộp muộn', NOT_STARTED: 'Chưa bắt đầu', IN_PROGRESS: 'Đang thực hiện', SUBMITTED: 'Đã nộp', NEEDS_REVIEW: 'Chờ chấm', RETURNED: 'Đã trả lại' };
export function Badge({ value }: { value: string }) { const tone = /ACTIVE|OPEN|PUBLISHED|RELEASED|READY|COMPLETED|GRADED/.test(value) ? 'badge-success' : /FAILED|SUSPENDED|LATE|REJECTED/.test(value) ? 'badge-danger' : /PENDING|PROCESSING|IN_REVIEW|SCHEDULED|NEEDS_REVIEW/.test(value) ? 'badge-warning' : 'badge-neutral'; return <span className={`status-badge ${tone}`}>{statusLabels[value] ?? value.replaceAll('_', ' ')}</span>; }
export function EmptyState({ title, description, action, icon }: { title: string; description: string; action?: ReactNode; icon?: ReactNode }) { return <div className="empty-state"><div className="empty-icon" aria-hidden="true">{icon ?? <Inbox size={22} />}</div><h3 className="font-semibold text-slate-900">{title}</h3><p>{description}</p>{action}</div>; }
export function FieldError({ message }: { message?: string }) { return message ? <p className="mt-1 text-sm text-red-600" role="alert">{message}</p> : null; }
export function Pagination({ links }: { links?: Array<{ url: string | null; label: string; active: boolean }> }) { if (!links || links.length <= 3) return null; return <nav aria-label="Phân trang" className="flex flex-wrap gap-1 border-t border-slate-200 px-5 py-4">{links.map((link, index) => link.url ? <Link key={index} href={link.url} preserveScroll className={`btn btn-sm ${link.active ? 'btn-primary' : 'btn-ghost'}`} dangerouslySetInnerHTML={{ __html: link.label }} /> : <span key={index} className="btn btn-sm opacity-40" dangerouslySetInnerHTML={{ __html: link.label }} />)}</nav>; }
export { Button };
