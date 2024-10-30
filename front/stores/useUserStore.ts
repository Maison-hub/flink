// stores/useUserStore.ts
import { defineStore } from 'pinia'
import { useRuntimeConfig } from '#imports'
import { useCsrfToken} from "~/composables/useCsrfToken";

export interface User{
    token: string,
    user: {
        id: number,
        name: string,
        email: string,
        "email_verified_at": string,
        "created_at": string,
        "updated_at": string,
        "biography": string | null,
        "profile_picture": string | null,
        [key: string]: any; // Pour les autres champs inconnus
    }
    [key: string]: any; // Pour les autres champs inconnus
}

export interface setSessionResponse{
    statusCode: number,
    user: User
}

export const useUserStore = defineStore('user', () => {
    async function login(email: string, password: string):Promise<void> {
        const config = useRuntimeConfig()
        const apiBase = config.public.apiBase
        await useCsrfToken()
        //first call the laravel app
        const response: User = await $fetch(`${apiBase}/api/login`, {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password,
                device_name: 'web'
            }),
        })
        if(response.message){
            throw new Error(response.message)
        }
        const userData = {
            id: response.user.id,
            name: response.user.name,
            email: response.user.email,
            email_verified_at: response.user.email_verified_at,
            created_at: response.user.created_at,
            updated_at: response.user.updated_at,
            biography: response.user.biography,
            profile_picture: response.user.profile_picture
        }
        const setSession: setSessionResponse = await $fetch(`api/set-session`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userData),
            credentials: 'include',
        })
        if (setSession.statusCode !== 200) {
            throw new Error('Failed to set session')
        }
    }

    async function logout():Promise<void>{
        const config = useRuntimeConfig()
        const apiBase = config.public.apiBase
        await $fetch(`${apiBase}/logout`, {
            method: 'POST',
            credentials: 'include',
        })
    }
    return {
        login,
        logout,
    }
})