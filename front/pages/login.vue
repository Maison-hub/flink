<template>
    <div>
        <h1>Login</h1>
        <div v-if="authStore.user">
            <p>Vous étes déja connecter en tant que {{ authStore.user.name }}</p>
            <button @click="authStore.logout()">logout</button>
        </div>
        <form @submit.prevent="login"
            v-if="!authStore.user">
            <div>
                <label for="email">Email:</label>
                <input type="email"
                    id="email"
                    v-model="form.email"
                    required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password"
                    id="password"
                    v-model="form.password"
                    required>
            </div>
            <button type="submit">Login</button>
        </form>
        <NuxtLink to="/testAuth">test auth</NuxtLink>
    </div>
</template>

<script setup>
import axios from 'axios';
import { useAuthStore } from '~/stores/AuthStore';

const form = ref({
    email: null,
    password: null,
})

const authStore = useAuthStore()

const login = async () => {
    await authStore.authenticateUser(form.value.email, form.value.password)
};

onMounted(() => {
    authStore.fetchUser()
})



// // const email = ref('');
// // const password = ref('');

// axios.defaults.withCredentials = true;
// axios.defaults.withXSRFToken = true;


// let user = ref(null);

// const login = async () => {
//     // get csrf cookies
//     await axios.get('http://localhost:8080/sanctum/csrf-cookie');
//     try {
//         const response = await axios.post('http://localhost:8080/login', {
//             email: email.value,
//             password: password.value,
//         });
//         const userdata = await axios.get('http://localhost:8080/api/user');
//         user.value = userdata.data;
//         // Handle successful login here
//         console.log(response.data);
//     } catch (error) {
//         // Handle login error here
//         console.error(error);
//     }
// };
</script>
