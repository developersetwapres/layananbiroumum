import { Link } from '@inertiajs/react';
import {
    BookOpen,
    Building2,
    CalendarClock,
    CarFront,
    ClipboardList,
    Folder,
    Hammer,
    LayoutGrid,
    LockKeyhole,
    PackageCheck,
} from 'lucide-react';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';
import AppLogo from './app-logo';
import { index as indexRupat } from '@/routes/ruangrapat';
import { index as indexKerusakan } from '@/routes/kerusakangedung';
import { index as indexAtk } from '@/routes/permintaanatk';
import { index as imdexRooms } from '@/routes/rooms';
import { index as daftarAtk } from '@/routes/daftaratk';
import { index as daftarKerusakan } from '@/routes/daftarkerusakan';

const mainNavItems: NavItem[] = [
    {
        title: 'Home',
        href: dashboard(),
        icon: LayoutGrid,
        permission: 'view_admin_dashboard',
    },
    {
        title: 'Pemesanan Ruang Rapat',
        href: indexRupat.url(),
        icon: CalendarClock,
        permission: 'view_bookings',
    },
    {
        title: 'Kerusakan Gedung',
        href: indexKerusakan.url(),
        icon: Hammer,
        permission: 'view_damages',
    },
    {
        title: 'Permintaan ATK',
        href: indexAtk.url(),
        icon: ClipboardList,
        permission: 'view_supplies',
    },
    {
        title: 'Permintaan Kendaraan',
        href: '#', // Ganti nanti dengan route('permintaankendaraan.index') jika aktif
        icon: CarFront,
        permission: 'view_vehicle_requests',
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Manajemen Ruangan',
        href: imdexRooms.url(),
        icon: Building2,
        permission: 'view_rooms',
    },
    {
        title: 'Manajemen ATK',
        href: daftarAtk.url(),
        icon: PackageCheck,
        permission: 'view_atk',
    },
    {
        title: 'Kategori Kerusakan',
        href: daftarKerusakan.url(),
        icon: Hammer,
        permission: 'view_category_damages',
    },
    {
        title: 'Pengaturan Akses',
        href: '/',
        icon: LockKeyhole,
        permission: 'management_access',
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
