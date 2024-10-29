<script setup>
const { loggedIn, user, session, fetch, clear } = useUserSession()
import { useCsrfToken} from "~/composables/useCsrfToken";

const runtimeConfig = useRuntimeConfig()
const apiBase = runtimeConfig.public.apiBase

//implement handle login function
const form = ref({
    email: null,
    password: null,
    remember: false,
})

const handleLogin = async () => {
    // await login(form.value)
  console.log('apiBase', apiBase);
  await useCsrfToken() // Fetch CSRF token before making the login request

  const user = await $fetch(`${apiBase}/api/login`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        email: form.value.email,
        password: form.value.password,
        device_name: 'web',
    }),
    credentials: 'include',
  })

  await $fetch(`api/set-session`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(user),
    credentials: 'include',
  })
  console.log('test laravel api >>>>>', login);
  fetch()
}

const handleLogout = async () => {
    //await auth.logout()
}

</script>

<template>
<!--    <div>-->
<!--        you are logged in-->
<!--        <button @click="handleLogout">Logout</button>-->
<!--    </div>-->
    <div
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