<template>
    <div>
        <button @click="logout">Logout</button>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const logout = async () => {
    try {
        // Send a POST request to the logout endpoint
        await axios.post('/logout')

        // Clear the authentication cookies
        document.cookie = 'XSRF-TOKEN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
        document.cookie = 'laravel_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'

        // Redirect to the login page or any other desired page
        window.location.href = '/login'
    } catch (error) {
        console.error(error)
    }
}
</script>