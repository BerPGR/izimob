<template>
    <div>
        <nav class="navbar bg-base-100 shadow-md">
            <div class="container mx-auto flex items-center justify-between">
                <div class="navbar-start">
                    <a class="btn btn-ghost text-xl" href="/">IziMob</a>
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
</template>