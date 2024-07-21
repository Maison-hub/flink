<script setup lang="ts">
import { ref } from 'vue'

const apiResponse = ref('Waiting for click')

const testApi = async () => {
    const response = await fetch('http://127.0.0.1:8080/api/test/')
    const data = await response.json()
    console.log(data)
    apiResponse.value = data.message
}

</script>

<template>
    <div>
        <h1>TestApi</h1>
        <button @click="testApi">Test Api</button>
        <div>{{ apiResponse }}</div>
    </div>

</template>

<style scoped></style>