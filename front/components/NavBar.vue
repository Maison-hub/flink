<script setup>
const { user, isAuthenticated, logout } = useAuth()

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const viewProfile = () => {
    // Logique pour afficher le profil de l'utilisateur
};

const handleLogout = () => {
    // Logique pour déconnecter l'utilisateur
    logout();
};


</script>

<template>
    <nav class="flex flex-row items-center justify-center w-full py-6">
        <ul class="p-6 w-full">
            <li>
                <NuxtLink to="/">Home</NuxtLink>
            </li>
            <div class="w-full"></div>
            {{ isAuthenticated }}
            <ul v-if="isAuthenticated">
                <li>
                    <NuxtLink to="/board">Your Dashboard</NuxtLink>
                </li>
                <li @click="toggleDropdown"
                    class="cursor-pointer">
                    <span>{{ user.name }}</span>
                    <ul v-if="isDropdownOpen"
                        class="absolute flex flex-col right-0 mt-2 bg-white border border-gray-200 rounded-md shadow-lg gap-0">
                        <li @click="viewProfile"
                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer w-full">
                            <NuxtLink to="/you">View Profile</NuxtLink>
                        </li>
                        <li @click="logout"
                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer w-full">Logout</li>
                    </ul>
                </li>
            </ul>
            <ul v-else>
                <NuxtLink to="/login">Login</NuxtLink>
            </ul>
        </ul>
    </nav>
</template>
<style>
ul {
    @apply flex flex-row items-center justify-center gap-6 text-nowrap;
}
</style>