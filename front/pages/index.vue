<script setup>
// log runtime config backend url variable
const runtimeConfig = useRuntimeConfig()
console.log(runtimeConfig.public.apiBase)


</script>

<template>
    <div class="container">
        <h1 class="text-3xl font-bold underline">
            Hello world!
        </h1>
        <NuxtLink to="/login">Login</NuxtLink>
    </div>
</template>
