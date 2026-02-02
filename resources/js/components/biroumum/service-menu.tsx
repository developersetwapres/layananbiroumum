'use client';

import { Card, CardContent } from '@/components/ui/card';
import { create as createDemage } from '@/routes/kerusakangedung';
import { create as createSupplie } from '@/routes/permintaanatk';
import { create as createBooking } from '@/routes/ruangrapat';
import { Link } from '@inertiajs/react';
import type { LucideIcon } from 'lucide-react';
import { Car, PenTool, Users, Wrench } from 'lucide-react';

interface ServiceItem {
    icon: LucideIcon;
    label: string;
    href: string;
}

export function ServiceMenu() {
    const layananItems: ServiceItem[] = [
        {
            icon: Users,
            label: 'Pemesanan Ruang Rapat',
            href: createBooking.url(),
        },
        {
            icon: Wrench,
            label: 'Kerusakan Gedung',
            href: createDemage.url(),
        },
        {
            icon: PenTool,
            label: 'Permintaan ATK',
            href: createSupplie.url(),
        },
        {
            icon: Car,
            label: 'Permintaan Kendaraan',
            href: '#', // Ganti nanti dengan route('permintaankendaraan.index') jika aktif
        },
    ];

    return (
        <div>
            <h2 className="mb-4 text-lg font-semibold text-gray-800">
                Layanan Biro Umum
            </h2>
            <div className="grid grid-cols-2 gap-4">
                {layananItems.map((item, index) => (
                    <Link key={index} href={item.href}>
                        <Card className="cursor-pointer transition-shadow hover:shadow-md">
                            <CardContent className="p-4 text-center">
                                <div className="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                                    <item.icon className="h-6 w-6 text-blue-600" />
                                </div>
                                <p className="text-sm leading-tight font-medium text-gray-700">
                                    {item.label}
                                </p>
                            </CardContent>
                        </Card>
                    </Link>
                ))}
            </div>
        </div>
    );
}
