<script setup>
import Navbar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";
import { ref } from "vue";
import { CheckIcon } from "@heroicons/vue/24/solid";

const calculator = ref({ type: "standard", entry: "", exit: "", result: null });
const rates = { standard: 1500, covered: 3000, premium: 7000 };
const freeMinutes = { standard: 15, covered: 15, premium: 30 };

const calculateCost = () => {
    if (!calculator.value.entry || !calculator.value.exit) return;

    const entry = new Date(calculator.value.entry);
    const exit = new Date(calculator.value.exit);
    let diff =
        (exit - entry) / (1000 * 60) - freeMinutes[calculator.value.type];
    if (diff < 0) diff = 0;

    calculator.value.result = (
        (diff / 60) *
        rates[calculator.value.type]
    ).toFixed(2);
};
</script>

<template>
    <Navbar />
    <section class="bg-gray-900 py-20 text-white text-center">
        <h2 class="text-3xl font-bold">Transparent Hourly Rates</h2>
        <p class="mt-2 text-emerald-400">Pay only for what you use</p>

        <div class="grid gap-8 md:grid-cols-3 mt-8">
            <div
                v-for="(rate, type) in rates"
                :key="type"
                class="bg-gray-800 p-6 rounded-lg shadow-lg"
            >
                <h3 class="text-xl font-bold capitalize">{{ type }} Parking</h3>
                <p class="mt-2 text-gray-400">
                    {{
                        type === "premium"
                            ? "Closest to entrances"
                            : type === "covered"
                            ? "Protection from weather"
                            : "Open-air spots"
                    }}
                </p>
                <p class="mt-4 text-3xl font-bold">
                    {{ rate }}FCFA <span class="text-gray-400">/hour</span>
                </p>
                <p class="mt-2 flex items-center justify-center text-gray-300">
                    <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />First
                    {{ freeMinutes[type] }} minutes free
                </p>
            </div>
        </div>

        <div class="mt-12 bg-gray-800 p-6 rounded-lg max-w-md mx-auto">
            <h3 class="text-2xl font-bold mb-4">Parking Cost Calculator</h3>
            <select
                v-model="calculator.type"
                class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
            >
                <option v-for="(rate, type) in rates" :key="type" :value="type">
                    {{ type.charAt(0).toUpperCase() + type.slice(1) }} ({{
                        rate
                    }}FCFA/hr)
                </option>
            </select>
            <input
                type="datetime-local"
                v-model="calculator.entry"
                class="mt-4 bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
            />
            <input
                type="datetime-local"
                v-model="calculator.exit"
                class="mt-4 bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
            />
            <button
                @click="calculateCost"
                class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg w-full"
            >
                Calculate
            </button>
            <p
                v-if="calculator.result"
                class="mt-4 text-xl font-bold text-emerald-400"
            >
                Estimated Cost: {{ calculator.result }}FCFA
            </p>
            <p v-else class="mt-4 text-gray-400">
                Enter details to calculate cost
            </p>
        </div>
    </section>
    <FooterSection />
</template>

<style scoped>
input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.8;
}
</style>
