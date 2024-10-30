<script setup>
import { useUserStore } from "@/stores/useUserStore";
import {navigateTo} from "#app";

const { loggedIn ,fetch, clear } = useUserSession()
const router = useRouter();
const route = useRoute();
const runtimeConfig = useRuntimeConfig()
const apiBase = runtimeConfig.public.apiBase
const userStore = useUserStore()



//implement handle login function
const form = ref({
    email: null,
    password: null,
    remember: false,
})

const handleLogin = async () => {
  try {
    await userStore.login(form.value.email, form.value.password)
    await fetch()
    console.log('Login successful')
    const redirectTo = String(route.query.to || '/dashboard');
    navigateTo(redirectTo)
  } catch (error) {
    console.error('Login error:', error)
  }
}

const handleLogout = async () => {
    //await auth.logout()
  await userStore.logout()
  await clear()
}
onMounted(() => {
  if (loggedIn) {
    navigateTo('/dashboard')
  }
    console.log('login page mounted')
})

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

            <!-- TODO implement custom button component -->
            <button type="submit">Login</button>
        </form>
        <NuxtLink to="/testAuth">test auth</NuxtLink>
    </div>
</template>