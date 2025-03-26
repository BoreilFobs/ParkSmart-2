<script setup>
import Navbar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";
</script>

<template>
    <Navbar />
    <section class="bg-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Transparent Hourly Rates</span>
                    <span class="block text-emerald-400 mt-2"
                        >Pay only for what you use</span
                    >
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-300 mx-auto">
                    No subscriptions, no commitments - just fair parking prices
                </p>
            </div>

            <!-- Rate Cards -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Standard Parking -->
                <div
                    class="bg-gray-800 rounded-xl p-8 transition-all duration-300 hover:transform hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-500/10"
                >
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">
                            Standard Parking
                        </h3>
                        <span
                            class="bg-gray-700 text-emerald-400 text-xs font-bold px-3 py-1 rounded-full"
                            >MOST COMMON</span
                        >
                    </div>
                    <p class="mt-2 text-gray-300">Open-air parking spots</p>

                    <div class="mt-6">
                        <span class="text-4xl font-bold text-white"
                            >1500FCFA</span
                        >
                        <span class="text-gray-400">/hour</span>
                    </div>

                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            First 15 minutes free
                        </li>
                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            Available 24/7
                        </li>
                    </ul>
                </div>

                <!-- Covered Parking -->
                <div
                    class="bg-gray-800 rounded-xl p-8 transition-all duration-300 hover:transform hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-500/10 border-2 border-emerald-500"
                >
                    <h3 class="text-xl font-bold text-white">
                        Covered Parking
                    </h3>
                    <p class="mt-2 text-gray-300">Protection from weather</p>

                    <div class="mt-6">
                        <span class="text-4xl font-bold text-white"
                            >3000FCFA</span
                        >
                        <span class="text-gray-400">/hour</span>
                    </div>

                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            First 15 minutes free
                        </li>
                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            Security monitored
                        </li>
                    </ul>
                </div>

                <!-- Premium Parking -->
                <div
                    class="bg-gray-800 rounded-xl p-8 transition-all duration-300 hover:transform hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-500/10"
                >
                    <h3 class="text-xl font-bold text-white">
                        Premium Parking
                    </h3>
                    <p class="mt-2 text-gray-300">Closest to entrances</p>

                    <div class="mt-6">
                        <span class="text-4xl font-bold text-white"
                            >7000FCFA</span
                        >
                        <span class="text-gray-400">/hour</span>
                    </div>

                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            First 30 minutes free
                        </li>

                        <li class="flex items-center text-gray-300">
                            <CheckIcon class="h-5 w-5 text-emerald-400 mr-2" />
                            Guaranteed availability
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Rate Calculator -->
            <div class="mt-20 bg-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-white mb-6">
                    Parking Cost Calculator
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                    >Parking Type</label
                                >
                                <select
                                    v-model="calculator.type"
                                    class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
                                >
                                    <option value="standard">
                                        Standard (1500FCFA/hr)
                                    </option>
                                    <option value="covered">
                                        Covered (3000FCFA/hr)
                                    </option>
                                    <option value="premium">
                                        Premium (7000FCFA/hr)
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                    >Entry Date & Time</label
                                >
                                <input
                                    type="datetime-local"
                                    v-model="calculator.entry"
                                    class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-300 mb-2"
                                    >Exit Date & Time</label
                                >
                                <input
                                    type="datetime-local"
                                    v-model="calculator.exit"
                                    class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full"
                                />
                            </div>
                            <button
                                @click="calculateCost"
                                class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors"
                            >
                                Calculate Cost
                            </button>
                        </div>
                    </div>
                    <div
                        class="bg-gray-700 rounded-lg p-6 flex flex-col justify-center"
                    >
                        <div v-if="calculator.result" class="text-center">
                            <h4 class="text-lg font-medium text-gray-300">
                                Estimated Parking Cost
                            </h4>
                            <div
                                class="text-4xl font-bold text-emerald-400 my-4"
                            >
                                ${{ calculator.result.toFixed(2) }}
                            </div>
                            <p class="text-gray-400">
                                {{ calculator.hours }} hours
                                {{ calculator.minutes }} minutes
                            </p>
                            <p class="text-gray-400 mt-2">
                                Daily cap: ${{ getDailyCap() }}
                            </p>
                        </div>
                        <div v-else class="text-center text-gray-400">
                            <ClockIcon
                                class="h-12 w-12 mx-auto text-gray-500"
                            />
                            <p class="mt-4">
                                Enter your parking details to calculate cost
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parking Rules -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-white mb-6">
                    Parking Rules & Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-white mb-4">
                            Payment Methods
                        </h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start">
                                <CreditCardIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >All major credit/debit cards accepted</span
                                >
                            </li>
                            <li class="flex items-start">
                                <DeviceMobileIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >Mobile payments via Google Pay/Apple
                                    Pay</span
                                >
                            </li>
                            <li class="flex items-start">
                                <CashIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >Cash accepted at attended facilities</span
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-white mb-4">
                            Important Notes
                        </h4>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start">
                                <ExclamationIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >Overtime parking will be charged at 1.5x
                                    standard rate</span
                                >
                            </li>
                            <li class="flex items-start">
                                <ExclamationIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >Lost tickets incur a 3000FCFA replacement
                                    fee</span
                                >
                            </li>
                            <li class="flex items-start">
                                <ExclamationIcon
                                    class="h-5 w-5 text-emerald-400 mr-2 mt-0.5"
                                />
                                <span
                                    >No in/out privileges - exit is final</span
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<FooterSection />

<script>
import {
    CheckIcon,
    ClockIcon,
    CreditCardIcon,
    DeviceMobileIcon,
    CashIcon,
    ExclamationIcon,
} from "@heroicons/vue/solid";

export default {
    name: "PricingPage",
    components: {
        CheckIcon,
        ClockIcon,
        CreditCardIcon,
        DeviceMobileIcon,
        CashIcon,
        ExclamationIcon,
    },
    data() {
        return {
            calculator: {
                type: "standard",
                entry: "",
                exit: "",
                result: null,
                hours: 0,
                minutes: 0,
            },
            rates: {
                standard: 1500,
                covered: 3000,
                premium: 7000,
            },
            // dailyCaps: {
            //     standard: 25,
            //     covered: 35,
            //     premium: 45,
            // },
            freeMinutes: {
                standard: 15,
                covered: 15,
                premium: 30,
            },
        };
    },
    methods: {
        calculateCost() {
            if (!this.calculator.entry || !this.calculator.exit) return;

            const entry = new Date(this.calculator.entry);
            const exit = new Date(this.calculator.exit);

            // Calculate total minutes
            let diff = (exit - entry) / (1000 * 60);

            // Apply free minutes
            diff -= this.freeMinutes[this.calculator.type];
            if (diff < 0) diff = 0;

            this.calculator.hours = Math.floor(diff / 60);
            this.calculator.minutes = Math.round(diff % 60);

            // Calculate cost
            const hourlyRate = this.rates[this.calculator.type];
            let cost =
                (this.calculator.hours + this.calculator.minutes / 60) *
                hourlyRate;

            // Apply daily cap
            const dailyCap = this.dailyCaps[this.calculator.type];
            if (cost > dailyCap) {
                cost = dailyCap;
            }

            this.calculator.result = cost;
        },
        // getDailyCap() {
        //     return this.dailyCaps[this.calculator.type];
        // },
    },
};
</script>

<style scoped>
/* Custom styles */
input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.8;
}
</style>
