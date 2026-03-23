<template>
    <div class="drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-content">
            <nav class="navbar bg-base-100 shadow-md">
                <div class="container mx-auto flex items-center justify-between">
                    <div class="navbar-start">
                        <label for="drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                            <!-- Sidebar toggle icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4"><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path><path d="M9 4v16"></path><path d="M14 10l2 2l-2 2"></path></svg>
                        </label>
                        <a class="btn btn-ghost text-xl" href="/">IziMob</a>
                    </div>
                    <div class="navbar-end">
                        <Link :href="route('logout')" method="POST" class="btn btn-error btn-soft">
                        <i class="pi pi-sign-out"/>
                            Logout
                        </Link>
                    </div>
                </div>
            </nav>
            <main class="py-6">
                <slot />
            </main>
        </div>
        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
                <ul class="menu w-full grow gap-3">
                    <li>
                        <Link as="button" :href="route(home)" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Homepage">
                            <i class="pi pi-home text-lg"/>
                            <span class="is-drawer-close:hidden">Homepage</span>
                        </Link>
                    </li>
                    <li v-if="page.props.auth.user.role === 'admin'">
                        <Link as="button" :href="route('invite')" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Convidar Usuários">
                            <i class="pi pi-user-plus text-lg"/>
                            <span class="is-drawer-close:hidden">Convidar usuários</span>
                        </Link>
                    </li>
                    <li v-if="page.props.auth.user.role === 'admin'">
                        <Link as="button" :href="route('pendingUsers')" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Solicitações">
                            <div class="indicator">
                                <span v-if="hasNotifications" class="indicator-item badge badge-primary badge-xs rounded-full"></span> 
                                
                                <i class="pi pi-clock text-lg"/>
                            </div>
                            <span class="is-drawer-close:hidden">Solicitações</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3"
import { computed, ref } from 'vue'

const hasNotifications = ref(true)

interface PageProps {
    auth: {
        user: {
            name: string,
            email: string,
            role: string
        }
    },
errors: Record<string, string>
}

const page = usePage<PageProps>()

const home = computed(() => {
    if (page.props.auth.user.role === 'admin' || page.props.auth.user.role === 'user') return 'admin.dashboard'
    return 'client.home'
})
</script>
