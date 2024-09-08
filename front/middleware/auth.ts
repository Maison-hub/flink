import axios from 'axios';
import { useAuthStore } from '~/stores/AuthStore';


export default defineNuxtRouteMiddleware(async (to, from) => {
    const authStore = useAuthStore();

    await authStore.fetchUser()
    if (!authStore.isLogged) {
        return navigateTo('/login')
    }
    else {
        navigateTo('/testAuth')
    }
});