<template>
    <div class="tabs tabs-border">
        <input type="radio" name="tab_register" class="tab" aria-label="Inquilino" checked @click="register?.role = 'iser'"/>
        <div class="tab-content p-2">
            <form @submit.prevent class="w-full flex flex-col gap-3">
                <fieldset class="fieldset">
                    <label class="text-lg" for="name">Nome Completo</label>
                    <input type="text" id="name" class="input w-full" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full" placeholder="mail@site.com" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="telefone">Telefone</label>
                    <input type="tel" id="telefone" class="input w-full" v-mask="'(##) #####-####'" placeholder="(xx) xxxxx-xxxx" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="document">CPF</label>
                    <input type="text" id="document" class="input w-full" v-mask="'###.###.###-##'" placeholder="xxx.xxx.xxx-xx"/>
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="senha">Senha</label>
                    <input type="password" id="senha" class="input w-full" placeholder="••••••••" />
                </fieldset>
                <button class="btn btn-primary mt-4 w-1/3" type="submit">
                    Registrar
                </button>
            </form>
        </div>

        <input type="radio" name="tab_register" class="tab" aria-label="Imobiliária" @click="register?.role = 'admin'"/>
        <div class="tab-content p-2">
            <form @submit.prevent class="w-full flex flex-col gap-3">
                <fieldset class="fieldset">
                    <label class="text-lg" for="name">Nome Imobiliária</label>
                    <input type="text" id="name" class="input w-full" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full" placeholder="mail@site.com" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="telefone">Telefone</label>
                    <input type="tel" id="telefone" class="input w-full" v-mask="'(##) #####-####'" placeholder="(xx) xxxxx-xxxx" />
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="document">CNPJ</label>
                    <input type="text" id="document" class="input w-full" v-mask="'##.###.###/####-##'" placeholder="xx.xxx.xxx/xxxx-xx"/>
                </fieldset>

                <fieldset class="fieldset">
                    <label class="text-lg" for="senha">Senha</label>
                    <input type="password" id="senha" class="input w-full" placeholder="••••••••" />
                </fieldset>
                <button class="btn btn-primary mt-4 w-1/3" type="submit">
                    Registrar
                </button>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
const register = defineModel<{
    name: string,
    email: string,
    telefone: string,
    document: string,
    password: string,
    role: string
}>()
</script>