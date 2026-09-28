import { Link, usePage } from '@inertiajs/react';
import { PropsWithChildren, type CSSProperties } from 'react';
import { PageProps } from '@/types';

export default function Guest({ children }: PropsWithChildren) {
    const { center, appName } = usePage<PageProps>().props;
    const centerName = center?.name || appName;
    const backgroundStyle: CSSProperties = {
        backgroundColor: center?.backgroundColor || '#eef2ff',
        backgroundImage: center?.backgroundUrl
            ? 'linear-gradient(rgba(15, 23, 42, .28), rgba(15, 23, 42, .28)), url("' + center.backgroundUrl + '")'
            : 'radial-gradient(circle at 15% 15%, rgba(129, 140, 248, .38), transparent 34%), radial-gradient(circle at 85% 85%, rgba(45, 212, 191, .28), transparent 32%), linear-gradient(135deg, #eef2ff 0%, #f8fafc 52%, #ecfeff 100%)',
        backgroundSize: center?.backgroundUrl ? 'cover' : undefined,
        backgroundPosition: center?.backgroundUrl ? 'center' : undefined,
        backgroundAttachment: center?.backgroundUrl ? 'fixed' : undefined,
    };

    return (
        <main
            className="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-8 sm:px-6"
            style={backgroundStyle}
        >
            <div className="pointer-events-none absolute inset-0 bg-white/10" aria-hidden="true" />
            <div className="relative z-10 w-full max-w-md">
                <Link href="/" className="mb-6 flex flex-col items-center text-center text-white drop-shadow-md">
                    {center?.logoUrl ? (
                        <img
                            src={center.logoUrl}
                            alt={'Logo ' + centerName}
                            className="h-20 w-20 rounded-2xl bg-white/95 p-2 object-contain shadow-xl ring-1 ring-white/70"
                        />
                    ) : (
                        <span className="grid h-20 w-20 place-items-center rounded-2xl bg-indigo-600 text-2xl font-bold text-white shadow-xl ring-1 ring-white/70">
                            {centerName.slice(0, 2).toUpperCase()}
                        </span>
                    )}
                    <span className="mt-3 text-xl font-bold tracking-tight">{centerName}</span>
                    <span className="mt-1 text-sm text-white/85">English learning platform</span>
                </Link>

                <div className="overflow-hidden rounded-2xl border border-white/70 bg-white/95 px-6 py-6 shadow-2xl shadow-slate-900/20 backdrop-blur sm:px-8">
                    {children}
                </div>
            </div>
        </main>
    );
}
