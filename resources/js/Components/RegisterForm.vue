<template>
    <div class="tabs tabs-border">
        <input type="radio" name="tab_register" class="tab" aria-label="Inquilino" checked @click="() => {
            register!.role = 'user'
            emptyValue()
        }"/>
        <div class="tab-content p-2">
            <form @submit.prevent="submitRegister" class="w-full flex flex-col gap-3">
                <fieldset class="fieldset">
                    <label class="text-lg" for="name">Nome Completo</label>
                    <input type="text" id="name" class="input w-full" v-model="register.name" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full" placeholder="mail@site.com" v-model="register.email" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="telefone">Telefone</label>
                    <input type="tel" id="telefone" class="input w-full" v-mask="'(##) #####-####'" placeholder="(xx) xxxxx-xxxx" v-model="register.telefone" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="document">CPF</label>
                    <input type="text" id="document" class="input w-full" v-mask="'###.###.###-##'" placeholder="xxx.xxx.xxx-xx" v-model="documentCPF"/>
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="senha">Senha</label>
                    <input type="password" id="senha" class="input w-full" placeholder="••••••••" v-model="register.password"/>
                </fieldset>
                <button class="btn btn-primary mt-4 w-1/3" type="submit">
                    Registrar
                </button>
            </form>
        </div>

        <input type="radio" name="tab_register" class="tab" aria-label="Imobiliária" @click="() => {
            register.role = 'admin'
            emptyValue()
        }"
        />
        <div class="tab-content p-2">
            <form @submit.prevent="submitRegister" class="w-full flex flex-col gap-3">
                <fieldset class="fieldset">
                    <label class="text-lg" for="name">Nome Imobiliária</label>
                    <input type="text" id="name" class="input w-full" v-model="register.name" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full" placeholder="mail@site.com" v-model="register.email" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="telefone">Telefone</label>
                    <input type="tel" id="telefone" class="input w-full" v-mask="'(##) #####-####'" placeholder="(xx) xxxxx-xxxx" v-model="register.telefone" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="document">CNPJ</label>
                    <input type="text" id="document" class="input w-full" v-mask="'##.###.###/####-##'" placeholder="xx.xxx.xxx/xxxx-xx" v-model="documentCNPJ"/>
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="senha">Senha</label>
                    <input type="password" id="senha" class="input w-full" placeholder="••••••••" v-model="register.password" />
                </fieldset>
                <button class="btn btn-primary mt-4 w-1/3" type="submit">
                    Registrar
                </button>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const emits = defineEmits<{
    (e: 'submit'): void
}>()

const documentCPF = ref<string | null>(null)
const documentCNPJ = ref<string | null>(null)

const register = defineModel<{
    name: string,
    email: string,
    telefone: string,
    document: string,
    password: string,
    role: string
}>({
    type: Object,
    required: true
})

const submitRegister = () => {
    register.value.document = register.value.role === 'user' ? documentCPF.value || '' : documentCNPJ.value || ''
    emits('submit')
}

const emptyValue = () => {
    register.value.name = ''
    register.value.email = ''
    register.value.telefone = ''
    register.value.document = ''
    register.value.password = ''
}
</script>