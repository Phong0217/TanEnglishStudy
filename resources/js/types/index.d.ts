export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    avatar_path?: string;
    status: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
        role: 'ADMIN' | 'TEACHER' | 'STUDENT';
        permissions: string[];
    };
    appName: string;
    flash: { success?: string; error?: string };
    notifications: { unreadCount: number; items: Array<{ id: string; data: { title: string; message: string; url?: string }; readAt?: string }> };
};
