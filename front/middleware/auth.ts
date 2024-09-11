import axios from 'axios';
import { useAuthStore } from '~/stores/AuthStore';


export default defineNuxtRouteMiddleware(async (to, from) => {
    const authStore = useAuthStore();
    // pass if user is already logged in
    if (authStore.isLogged) {
        navigateTo(to.path)
        return
    }
    else {
        await authStore.fetchUser()
        if (authStore.isLogged) {
            navigateTo(to.path)
            return
        }
    }  
    return navigateTo('/login')
});