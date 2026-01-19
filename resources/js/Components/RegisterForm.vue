<template>
    <div class="tabs tabs-border">
        <input type="radio" name="tab_register" class="tab" aria-label="Inquilino" checked/>
        <div class="tab-content p-2">
            <form @submit.prevent class="w-full">
                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full"
                        placeholder="mail@site.com" />
                </fieldset>
    
                <fieldset class="fieldset mt-4">
                    <label class="text-lg" for="senha">Senha</label>
                    <input  type="password" id="senha" class="input w-full"
                        placeholder="••••••••" />
                </fieldset>
    
                <div class="flex flex-row-reverse items-center justify-between">
                    <Link class="btn btn-link">
                    Esqueceu sua senha?
                    </Link>
    
                    <button class="btn btn-primary mt-4 w-1/3" type="submit">
                        Registrar
                    </button>
                </div>
            </form>
        </div>

        <input type="radio" name="tab_register" class="tab" aria-label="Imobiliária" />
        <div class="tab-content p-2">
            <form @submit.prevent class="w-full">
                <fieldset class="fieldset">
                    <label class="text-lg" for="email">E-Mail</label>
                    <input type="email" id="email" class="input w-full"
                        placeholder="mail@site.com" />
                </fieldset>
    
                <fieldset class="fieldset mt-4">
                    <label class="text-lg" for="senha">Senha</label>
                    <input type="password" id="senha" class="input w-full"
                        placeholder="••••••••" />
                </fieldset>
    
                <div class="flex flex-row-reverse items-center justify-between">
                    <Link class="btn btn-link">
                    Esqueceu sua senha?
                    </Link>
    
                    <button class="btn btn-primary mt-4 w-1/3" type="submit">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>