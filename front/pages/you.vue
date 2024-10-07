<script setup>
definePageMeta({
    middleware: ['auth'],
});

const { user } = useSanctumAuth()
const { updateProfilePicture } = useUserManagement()
let picture = ref(null)


const handleLogin = async () => {
    await login(form.value)
}

const handleLogout = async () => {
    await logout()
}

const hadnleUpdateProfilePicture = async (file) => {
    // Logique pour mettre à jour la photo de profil
    updateProfilePicture(file);
}

</script>

<template>

    {{ user }}

    <p>Ajouter une photo de profile</p>

    <input type="file"
        @change="hadnleUpdateProfilePicture($event.target.files[0])"
        class="bg-red"
        placeholder="insert file here" />



</template>
