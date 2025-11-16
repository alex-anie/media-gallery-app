import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type MediaFile = {
    path: File | null | string;
}

export type MediaData = {
    id: number;
    path: File | null;
    name: string,
    extension: string,
    mime_type: string, 
    file_size: unsignedBigInteger | null, 
    width: integer | null, 
    height: integer | null,
    duration: float | null,
    bitrate: integer | null
}

export type  DbImages = {
    id: number;
    path: string;
    created_at: string;
    update_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
