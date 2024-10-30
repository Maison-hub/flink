const { loggedIn } = useUserSession()

export default defineNuxtRouteMiddleware((to, from) => {

    if (loggedIn) {
        return navigateTo('/dashboard')
    }else {
        return navigateTo('/login')
    }
})