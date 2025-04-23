<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage<SharedData>();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
            <template v-for="item in items" :key="item.title">
                <!-- Parent menu item with children -->
                <template v-if="item.children">
                    <SidebarMenuItem>
                        <SidebarMenuButton 
                            :tooltip="item.title"
                            :is-active="item.children.some(child => child.href === page.url)"
                        >
                            <component :is="item.icon" />
                            <span>{{ item.title }}</span>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                    <!-- Child menu items -->
                    <SidebarMenuItem v-for="child in item.children" :key="child.title" class="pl-4">
                        <SidebarMenuButton 
                            as-child
                            :is-active="child.href === page.url"
                            :tooltip="child.title"
                        >
                            <Link :href="child.href">
                                <component :is="child.icon" />
                                <span>{{ child.title }}</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </template>
                <!-- Single menu item without children -->
                <template v-else>
                    <SidebarMenuItem>
                        <SidebarMenuButton 
                            as-child
                            :is-active="item.href === page.url"
                            :tooltip="item.title"
                        >
                            <Link :href="item.href">
                                <component :is="item.icon" />
                                <span>{{ item.title }}</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </template>
            </template>
        </SidebarMenu>
    </SidebarGroup>
</template>
