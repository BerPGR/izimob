<template>
    <div class="w-full md:flex min-h-screen">
        <!-- Lado esquerdo -->
        <div
            class="hidden md:flex md:flex-2 bg-linear-to-br to-blue-300 from-indigo-100 flex-col items-center justify-center">
            <img src="../../assets/izimob-logo.png" alt="IziMob Logo" class="w-1/3" />

            <img src="../../assets/d1.svg" alt="Authentication Illustration" class="w-1/4" />
        </div>

        <div class="flex flex-col items-center justify-center md:flex-1 md:shadow-[0_0_30px_rgba(0,0,0,0.25)]">
            <Transition enter-active-class="transition-opacity duration-400 ease-out" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="transition-opacity duration-400 ease-in"
            leave-from-class="opacity-100" leave-to-class="opacity-0" mode="out-in">
            
            <div v-if="!showRegisterText" key="login"
            class="flex flex-col items-center justify-center w-full max-w-[80%] p-6">
            <img src="../../assets/no-text-logo.png" class="w-1/5 mb-6" />
                    <h2 class="text-2xl font-semibold mb-2">
                        Entrar em conta
                    </h2>
                    <form @submit.prevent="submitLogin" class="w-full">
                        <fieldset class="fieldset">
                            <label class="text-lg" for="email">E-Mail</label>
                            <input v-model="loginForm.email" type="email" id="email" class="input w-full"
                                placeholder="mail@site.com" />
                        </fieldset>

                        <fieldset class="fieldset mt-4">
                            <label class="text-lg" for="senha">Senha</label>
                            <input v-model="loginForm.password" type="password" id="senha" class="input w-full"
                                placeholder="••••••••" />
                        </fieldset>

                        <div class="flex flex-row-reverse items-center justify-between">
                            <Link class="btn btn-link">
                                Esqueceu sua senha?
                            </Link>

                            <button class="btn btn-primary mt-4 w-1/3" type="submit">
                                Entrar
                            </button>
                        </div>
                    </form>
                    <div class="divider my-8">OU</div>
                    <button class="btn btn-secondary btn-outline w-full" @click="showRegisterText = true">
                        Registre-se
                    </button>
                </div>

                <div v-else key="register-text"
                    class="flex flex-col items-center justify-center w-full max-w-[80%] p-6">
                    <h2 class="text-2xl font-semibold mb-2">
                        Criação de conta
                    </h2>
                    <RegisterForm v-model="registerForm"/>
                    <div class="divider my-8">OU</div>
                    <button class="btn btn-secondary btn-outline w-full" @click="showRegisterText = false">
                        Voltar para o login
                    </button>
                </div>
            </Transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import NoHeaderLayout from '../Layouts/NoHeaderLayout.vue'
import RegisterForm from '../Components/RegisterForm.vue'

defineOptions({ layout: NoHeaderLayout })

const showRegisterText = ref(false)

const loginForm = useForm({
    email: '',
    password: '',
})

const submitLogin = () => {
    loginForm.post('/login', {
        onError: () => {
            loginForm.reset('password')
        },
    })
}

const registerForm = useForm({
    name: '',
    email: '',
    telefone: '',
    document: '',
    password: '',
    role: 'user'
})
</script>
