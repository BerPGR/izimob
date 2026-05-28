<template>
    <div class="min-h-screen bg-base-200 md:grid md:grid-cols-[1.05fr_0.95fr]">
        <section
            class="hidden md:flex bg-linear-to-br from-indigo-100 to-blue-300 flex-col items-center justify-center px-10">
            <img src="../../assets/izimob-logo.png" alt="IziMob Logo" class="w-full max-w-xs" />
            <img src="../../assets/d1.svg" alt="Ilustração de cadastro" class="mt-10 w-full max-w-sm" />
        </section>

        <section class="flex min-h-screen items-center justify-center px-5 py-10">
            <div class="w-full max-w-xl">
                <div class="mb-8 flex justify-center md:hidden">
                    <img src="../../assets/no-text-logo.png" alt="IziMob" class="h-16" />
                </div>

                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body gap-6 p-6 sm:p-8">
                        <div>
                            <p class="text-sm font-semibold uppercase text-primary">Convite recebido</p>
                            <h1 class="mt-2 text-2xl font-semibold text-base-content">
                                Complete seu cadastro
                            </h1>
                            <p class="mt-2 text-base-content/70">
                                Preencha seus dados para acessar a imobiliária.
                            </p>
                        </div>

                        <form @submit.prevent="submit" class="grid gap-4">
                            <fieldset class="fieldset">
                                <label class="text-base font-medium" for="name">Nome completo</label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="input input-bordered w-full"
                                    :class="{ 'input-error': form.errors.name }"
                                    autocomplete="name"
                                />
                                <p v-if="form.errors.name" class="text-sm text-error">{{ form.errors.name }}</p>
                            </fieldset>

                            <fieldset class="fieldset">
                                <label class="text-base font-medium" for="email">E-mail</label>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="input input-bordered w-full disabled:border-base-300 disabled:bg-base-200 disabled:text-base-content"
                                    disabled
                                />
                                <p v-if="form.errors.email" class="text-sm text-error">{{ form.errors.email }}</p>
                            </fieldset>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <fieldset class="fieldset">
                                    <label class="text-base font-medium" for="telefone">Telefone</label>
                                    <input
                                        id="telefone"
                                        v-model="form.telefone"
                                        v-mask="'(##) #####-####'"
                                        type="tel"
                                        class="input input-bordered w-full"
                                        :class="{ 'input-error': form.errors.telefone }"
                                        placeholder="(00) 00000-0000"
                                        autocomplete="tel"
                                    />
                                    <p v-if="form.errors.telefone" class="text-sm text-error">
                                        {{ form.errors.telefone }}
                                    </p>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <label class="text-base font-medium" for="document">Documento</label>
                                    <input
                                        id="document"
                                        v-model="form.document"
                                        v-mask="'###.###.###-##'"
                                        type="text"
                                        class="input input-bordered w-full"
                                        :class="{ 'input-error': form.errors.document }"
                                        placeholder="000.000.000-00"
                                    />
                                    <p v-if="form.errors.document" class="text-sm text-error">
                                        {{ form.errors.document }}
                                    </p>
                                </fieldset>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <fieldset class="fieldset">
                                    <label class="text-base font-medium" for="password">Senha</label>
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        class="input input-bordered w-full"
                                        :class="{ 'input-error': form.errors.password }"
                                        placeholder="••••••••"
                                        autocomplete="new-password"
                                    />
                                    <p v-if="form.errors.password" class="text-sm text-error">
                                        {{ form.errors.password }}
                                    </p>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <label class="text-base font-medium" for="password_confirmation">
                                        Confirmar senha
                                    </label>
                                    <input
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        type="password"
                                        class="input input-bordered w-full"
                                        :class="{ 'input-error': form.errors.password_confirmation }"
                                        placeholder="••••••••"
                                        autocomplete="new-password"
                                    />
                                    <p v-if="form.errors.password_confirmation" class="text-sm text-error">
                                        {{ form.errors.password_confirmation }}
                                    </p>
                                </fieldset>
                            </div>

                            <input v-model="form.invitation_token" type="hidden" />
                            <input v-model="form.role" type="hidden" />

                            <button class="btn btn-primary mt-2 w-full" type="submit" :disabled="form.processing">
                                <span v-if="form.processing" class="loading loading-spinner loading-sm"></span>
                                <span v-else>Cadastrar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import NoHeaderLayout from '../Layouts/NoHeaderLayout.vue'

defineOptions({ layout: NoHeaderLayout })

const props = defineProps<{
    invitation_token?: string
    email?: string
    role?: 'tenant' | 'user'
}>()

const page = usePage()

const token = computed(() => {
    const params = new URLSearchParams(page.url.split('?')[1] ?? '')

    return props.invitation_token ?? params.get('token') ?? ''
})

const form = useForm({
    name: '',
    email: props.email ?? '',
    telefone: '',
    document: '',
    password: '',
    password_confirmation: '',
    role: props.role ?? 'user',
    invitation_token: token.value,
})

const submit = () => {
    form.invitation_token = token.value
    form.post(route('invite.store', form.invitation_token), {
        preserveScroll: true,
    })
}
</script>
