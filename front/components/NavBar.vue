<script setup>
import { useUserStore } from "@/stores/useUserStore";

const { loggedIn, user, session, fetch, clear } = useUserSession()
const isDropdownOpen = ref(false);
const userStore = useUserStore()

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const handleLogout = () => {
  // Logique pour déconnecter l'utilisateur
  userStore.logout()
};


</script>

<template>
  <nav class="flex flex-row items-center justify-between w-full py-6 px-6 border-b border-b-black/10">
    <div>
      <NuxtLink to="/">Home</NuxtLink>
    </div>

    <div v-if="loggedIn" class="relative">
      <div>
        <span @click="toggleDropdown" class="cursor-pointer hover:bg-black/10 transition-all p-3 rounded-md">
          {{ user?.name }}
        </span>
        <div :class="{ hidden: !isDropdownOpen }" class="flex flex-col absolute right-0 top-full mt-4 p-1 border border-black/10 rounded-md">
          <button @click="handleLogout" class="px-4 py-1 hover:bg-black/10 transition-all rounded-md">
            Logout
          </button>
          <button class="px-4 py-1 hover:bg-black/10 transition-all rounded-md text-nowrap">
            My Profile
          </button>
        </div>
      </div>

    </div>
    <div v-else>
      <NuxtLink to="/login">Home</NuxtLink>
    </div>

  </nav>
</template>
<style>
ul {
    @apply flex flex-row items-center justify-center gap-6 text-nowrap;
}
</style>