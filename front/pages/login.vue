<script setup>
const { login, logout, isAuthenticated } = useSanctumAuth()

//implement handle login function
const form = ref({
    email: null,
    password: null,
    remember: false,
})

const isLogged = isAuthenticated;

const handleLogin = async () => {
    await login(form.value)
}

const handleLogout = async () => {
    await logout()
}

</script>

<template>
    <div v-if="isLogged">
        you are logged in
        <button @click="handleLogout">Logout</button>
    </div>
    <div v-else
        class="w-full flex justify-center flex-col items-center">
        <form @submit.prevent="handleLogin"
            class="max-w-screen-sm flex flex-col gap-3 items-start justify-start w-full">
            <h1 class="text-center w-full">Login</h1>

            <FormInput v-model="form.email"
                label="Email"
                id="email"
                type="email" />
            <FormInput v-model="form.password"
                label="Password"
                id="password"
                type="password" />
            <div>
                <input type="checkbox"
                    id="remember"
                    v-model="form.remember">
                <label for="remember">Remember me</label>
            </div>

            <!-- TOFO implement custom button component -->
            <button type="submit">Login</button>
        </form>
        <NuxtLink to="/testAuth">test auth</NuxtLink>
    </div>
</template>