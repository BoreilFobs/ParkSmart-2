<template>
    <div
        class="bg-gray-800 rounded-xl p-8 h-full transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/10 hover:-translate-y-1"
    >
        <div class="flex items-center mb-6">
            <div class="ml-4">
                <h4 class="text-lg font-medium text-white">{{ name }}</h4>
                <p class="text-emerald-400 text-sm">{{ role }}</p>
            </div>
        </div>
        <p class="text-gray-300 italic mb-4">{{ text }}</p>
        <div class="flex">
            <StarIcon
                v-for="i in 5"
                :key="i"
                class="h-5 w-5"
                :class="i <= rating ? 'text-emerald-400' : 'text-gray-600'"
            />
        </div>
    </div>
</template>

<script>
import { StarIcon } from "@heroicons/vue/24/solid";

export default {
    name: "TestimonialBox",
    components: { StarIcon },
    props: {
        name: {
            type: String,
            required: true,
        },
        role: {
            type: String,
            required: true,
        },
        rating: {
            type: [Number, String],
            required: true,
            validator: (value) => value >= 0 && value <= 5,
        },
        text: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
/* Component-specific styles */
</style>
