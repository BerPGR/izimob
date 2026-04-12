<template>
  <div class="w-full min-h-[calc(100vh-6rem)] container mx-auto">
    <h1 class="text-3xl">Requisições de acesso</h1>
    <div
      v-for="(user, i) in pendingUsers"
      :key="i"
      class="card shadow-md card-md"
    >
      <div class="card-body">
        <h1 class="card-title">
          {{ user.role.charAt(0).toUpperCase() + user.role.slice(1) }}
        </h1>
        <div class="divider"></div>
        <div class="card-actions justify-end">
          <button class="btn btn-success" @click="handleAccept(user.id)">
            Aceitar
          </button>
          <button
            class="btn btn-error text-white"
            @click="handleReject(user.id)"
          >
            Recusar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";

interface Agency {
  id: number;
  name: string;
}

interface User {
  id: number;
  name: string;
  email: string;
  agency?: Agency | null;
  telephone: string;
  document: string;
  role: string;
}

defineProps<{
  pendingUsers: User[];
}>();

const handleAccept = (id: number) => {
  router.post(
    route("users.accept", { user: id }),
    {},
    {
      onSuccess: () => {
        console.log("Usuário aceito");
      },
      preserveScroll: true,
    }
  );
};

const handleReject = (id: number) => {
  router.post(
    route("users.reject", { user: id }),
    {},
    {
      onSuccess: () => {
        console.log("Usuário recusado");
      },
      preserveScroll: true,
    }
  );
};
</script>
