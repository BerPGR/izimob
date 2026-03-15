<template>
  <div class="max-w-4xl mx-auto p-6">
    <div class="card bg-base-100 shadow-xl border border-base-200">
      <div class="card-body">
        <h2 class="card-title text-2xl font-bold mb-2">Convidar Novos Usuários</h2>
        <p class="text-base-content/70 mb-6">
          Adicione os e-mails e defina as permissões para a sua equipe.
        </p>

        <form @submit.prevent="submit">
          <div
            v-for="(invite, index) in form.invitations"
            :key="index"
            class="flex flex-col md:flex-row gap-4 mb-4 items-start"
          >
            <div class="form-control w-full">
              <label class="label">
                <span class="label-text font-medium">E-mail</span>
              </label>
              <input
                type="email"
                v-model="invite.email"
                placeholder="exemplo@empresa.com"
                class="input input-bordered w-full"
                :class="{ 'input-error': form.errors[`invitations.${index}.email`] }"
                required
              />
              <div v-if="form.errors[`invitations.${index}.email`]" class="text-error text-sm mt-1">
                {{ form.errors[`invitations.${index}.email`] }}
              </div>
            </div>

            <div class="form-control w-full md:w-1/3">
              <label class="label">
                <span class="label-text font-medium">Nível de Acesso</span>
              </label>
              <select
                v-model="invite.role"
                class="select select-bordered w-full"
              >
                <option v-for="role in availableRoles" :key="role.value" :value="role.value">
                  {{ role.label }}
                </option>
              </select>
            </div>

            <div class="form-control mt-auto">
              <button
                type="button"
                @click="removeInvite(index)"
                class="btn btn-error btn-square btn-outline"
                :disabled="form.invitations.length === 1"
                aria-label="Remover usuário"
                title="Remover usuário"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>

          <div class="mt-2">
            <button
              type="button"
              @click="addInvite"
              class="btn btn-secondary btn-sm btn-outline"
            >
              + Adicionar outro usuário
            </button>
          </div>

          <div class="divider my-6"></div>

          <div class="card-actions justify-end">
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="form.processing"
            >
              <span v-if="form.processing" class="loading loading-spinner"></span>
              Enviar Convites
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

interface Invitation {
  email: string
  role: string
}

const availableRoles = [
  { value: 'admin', label: 'Administrador' },
  { value: 'user', label: 'Funcionário' },
  { value: 'tenant', label: 'Inquilino' },
]

const form = useForm({
  invitations: [
    { email: '', role: 'user' } as Invitation
  ]
})

const addInvite = () => {
  form.invitations.push({ email: '', role: 'user' })
}

const removeInvite = (index: number) => {
  if (form.invitations.length > 1) {
    form.invitations.splice(index, 1)
  }
}

const submit = () => {
  form.post(route('invites.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>
