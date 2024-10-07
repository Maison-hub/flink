<script setup>
import useUserLinks from '~/composables/useUserLinks';

definePageMeta({
    middleware: ['auth'],
});

const { links, getLinks } = useUserLinks()



// import { useAuthStore } from '~/stores/AuthStore';

// const authStore = useAuthStore()

// let user = ref(null);

// const form = ref({
//     linkName: null,
//     linkUrl: null,
// })

// const links = ref(null)
// // authStore.userLinks()

// onMounted(async () => {
//     user.value = authStore.user
//     await authStore.userLinks().then(() => {
//         links.value = authStore.links
//     })
//     links.value = authStore.links
//     console.log(links.value)
// })

</script>

<template>

    <div class="container">
        Your dashboard
    </div>

    <div>
        <p>your links</p>

        <div v-if="links">
            <div v-for="link in links.links">
                <p>{{ link.name }}</p>
                <p>{{ link.url }}</p>
            </div>

        </div>

    </div>

</template>