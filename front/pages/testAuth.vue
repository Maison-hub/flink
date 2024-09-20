<script setup lang="ts">
definePageMeta({
    middleware: ['sanctum:auth'],
});
</script>

<template>
    <h1>Ici il faut etre LogIn</h1>
</template>