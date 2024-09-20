<template>
    <div class="w-full">
        <label :for="id"
            class="pl-4">{{ label }}</label>
        <input :id="id"
            :value="modelValue"
            :type="type"
            @input="updateValue"
            class="border border-black rounded-full py-2 px-4 w-full" />
    </div>
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
    },
    label: {
        type: String,
        required: true
    },
    id: {
        type: String,
        default: 'input',
    },
    type: {
        type: String,
        default: 'text'
    }
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>