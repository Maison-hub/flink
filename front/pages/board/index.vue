<script setup>
definePageMeta({
    middleware: 'auth'
})

import { useAuthStore } from '~/stores/AuthStore';

const authStore = useAuthStore()

let user = ref(null);

const form = ref({
    linkName: null,
    linkUrl: null,
})

const links = ref(null)
// authStore.userLinks()

onMounted(async () => {
    user.value = authStore.user
    await authStore.userLinks().then(() => {
        links.value = authStore.links
    })
    links.value = authStore.links
    console.log(links.value)
})

</script>

<template>
    <div class="container">
        <h1 v-if="user">{{ user.name }} dashboard</h1>
        <!-- create link form -->
        <form @submit.prevent="login">
            <label for="linkName">Link title</label>
            <input type="linkName"
                id="linkName"
                v-model="form.linkName"
                required>
            <label for="linkUrl">Link Url</label>
            <input type="linkUrl"
                id="linkUrl"
                v-model="form.linkUrl"
                required>
        </form>
    </div>

    <div>
        <p>your links</p>
        <div class="flex flex-col gap-4 p-8"
            {{
            links
            }}
            v-if="links">
            <div v-for="link in links">
                <a :href="link.url"
                    class=" bg-green-500 rounded-lg flex flex-col gap-2 p-2"
                    target="_blank">
                    <div>
                        <p class=" text-red-800">{{ link.name }}</p>
                        <p>{{ link.subtitle }}</p>
                    </div>
                </a>
            </div>
        </div>

    </div>



</template>