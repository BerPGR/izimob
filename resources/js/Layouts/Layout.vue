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
                <ul class="menu w-full grow">
                    <li>
                        <Link as="button" :href="route(home)" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Homepage">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor" class="my-1.5 inline-block size-4"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                            <span class="is-drawer-close:hidden">Homepage</span>
                        </Link>
                    </li>
                    <li v-if="page.props.auth.user.role === 'admin'">
                        <Link as="button" :href="route('invite')" class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Convidar Usuários">
                            <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    class="w-6 h-6 text-gray-700"
                                    xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                            d="M17 10H20M23 10H20M20 10V7M20 10V13"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            />
                                    <path
                                            d="M1 20V19C1 15.134 4.13401 12 8 12V12C11.866 12 15 15.134 15 19V20"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            />
                                    <path
                                            d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            />
                            </svg>
                            <span class="is-drawer-close:hidden">Convidar usuários</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3"
import { computed } from 'vue'

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
