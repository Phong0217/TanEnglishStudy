import { ButtonHTMLAttributes, forwardRef, ReactNode } from 'react';
import { LoaderCircle } from 'lucide-react';

export type ButtonProps = ButtonHTMLAttributes<HTMLButtonElement> & {
    variant?: 'primary' | 'secondary' | 'outline' | 'ghost' | 'danger';
    size?: 'sm' | 'md' | 'lg' | 'icon';
    loading?: boolean;
    loadingLabel?: string;
    leadingIcon?: ReactNode;
    trailingIcon?: ReactNode;
    fullWidth?: boolean;
};

const Button = forwardRef<HTMLButtonElement, ButtonProps>(function Button({
    variant = 'secondary', size = 'md', loading = false, loadingLabel = 'Đang xử lý…',
    leadingIcon, trailingIcon, fullWidth = false, disabled, type = 'button',
    children, className = '', title, ...props
}, ref) {
    const hasVariant = /\bbtn-(primary|secondary|outline|ghost|danger)\b/.test(className);
    return <button {...props} ref={ref} type={type} disabled={disabled || loading}
        aria-busy={loading || undefined} title={title ?? (size === 'icon' ? props['aria-label'] : undefined)}
        className={`btn ${hasVariant ? '' : `btn-${variant}`} btn-${size} ${fullWidth ? 'btn-full' : ''} ${className}`}>
        <span className={`btn-content ${loading ? 'invisible' : ''}`} aria-hidden={loading || undefined}>
            {leadingIcon}{children}{trailingIcon}
        </span>
        {loading && <span className="btn-loading" role="status"><LoaderCircle size={18} className="button-spinner" aria-hidden="true"/><span>{loadingLabel}</span></span>}
    </button>;
});

export default Button;
