<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Card } from '@/components/ui/card';
import { CardHeader } from '@/components/ui/card';
import { CardTitle } from '@/components/ui/card';
import { CardContent } from '@/components/ui/card';
import { CardDescription } from '@/components/ui/card';
import UserInfo from '@/components/UserInfo.vue';
import type { SharedData, User } from '@/types';

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        
        <div class="grid gap-6 rounded-xl p-4">
            <!-- Welcome card -->
            <Card>
                <CardHeader>
                    <CardTitle class="text-2xl">Welcome, {{ user.name }}!</CardTitle>
                    <CardDescription>This is your personal dashboard.</CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2">Your Profile</h3>
                            <div class="flex items-center gap-4 p-4 bg-background rounded-lg border">
                                <UserInfo :user="user" :show-email="true" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Quick Stats</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-primary/10 rounded-lg">
                                    <p class="text-sm font-medium text-muted-foreground">Member Since</p>
                                    <p class="text-2xl font-bold">{{ new Date(user.created_at).toLocaleDateString() }}</p>
                                </div>
                                <div class="p-4 bg-primary/10 rounded-lg">
                                    <p class="text-sm font-medium text-muted-foreground">Email Status</p>
                                    <p class="text-2xl font-bold">{{ user.email_verified_at ? 'Verified' : 'Unverified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>
            
            <!-- Recent activity or additional information -->
            <Card>
                <CardHeader>
                    <CardTitle>What's Next</CardTitle>
                </CardHeader>
                <CardContent>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2">
                            <div class="size-2 rounded-full bg-primary"></div>
                            <span>Complete your profile information</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="size-2 rounded-full bg-primary"></div>
                            <span>Explore the application features</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="size-2 rounded-full bg-primary"></div>
                            <span>Customize your settings</span>
                        </li>
                    </ul>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
