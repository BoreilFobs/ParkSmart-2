<template>
    <NavBar />
    <div class="min-h-screen bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-white">
                    Parking Reservation
                </h1>
                <p class="text-gray-400 mt-2">Book your spot in seconds</p>
            </div>

            <!-- Reservation Form -->
            <div class="bg-gray-800 rounded-lg shadow p-6">
                <!-- Vehicle Info -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">
                        Vehicle Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >Owners' name*</label
                            >
                            <input
                                v-model="form.user_name"
                                type="text"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                                placeholder="John Doe"
                            />
                            <p
                                v-if="errors.user_name"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ errors.user_name }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >License Plate*</label
                            >
                            <input
                                v-model="form.plate"
                                type="text"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                                placeholder="ABC123"
                            />
                            <p
                                v-if="errors.plate"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ errors.plate }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Time Selection -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">
                        Parking Time
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >Entry Time*</label
                            >
                            <input
                                v-model="form.start_time"
                                type="datetime-local"
                                :min="minEntryTime"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                            />
                            <p
                                v-if="errors.start_time"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ errors.start_time }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >Exit Time*</label
                            >
                            <input
                                v-model="form.end_time"
                                type="datetime-local"
                                :min="form.end_time || minEntryTime"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                            />
                            <p
                                v-if="errors.end_time"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ errors.end_time }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Spot Selection -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">
                        Parking Spot
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <button
                            v-for="spot in spots"
                            :key="spot.type"
                            @click="form.spot = spot.type"
                            :class="[
                                'p-3 border rounded-lg text-left',
                                form.spot === spot.type
                                    ? 'border-emerald-500 bg-emerald-500/10'
                                    : 'border-gray-600 hover:border-gray-500',
                            ]"
                        >
                            <div class="font-medium text-white">
                                {{ spot.type }}
                            </div>
                            <div class="text-sm text-gray-400">
                                {{ spot.price }}FCFA/hr
                            </div>
                        </button>
                    </div>
                    <p v-if="errors.spot" class="text-red-500 text-sm mt-1">
                        {{ errors.spot }}
                    </p>
                </div>

                <!-- Summary & Submit -->
                <div class="mt-8 pt-6 border-t border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-300">Estimated Total:</span>
                        <span class="text-emerald-400 font-bold text-xl">
                            {{ calculateTotal().toFixed(2) }}FCFA
                        </span>
                    </div>
                    <button
                        @click="submitReservation"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-lg font-medium transition-colors"
                    >
                        Reserve Parking Spot
                    </button>
                </div>
            </div>
        </div>
    </div>
    <FooterSection />
</template>
<script>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import NavBar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";
import axios from "axios";
axios.defaults.headers.common[
    "eyJpdiI6IlZ5NW9PbFBTR3dyQVNMaFd6by9JcXc9PSIsInZhbHVlIjoiS3BWZ3Jzck9VMm4wL3VTOUI5RXltS3hDOHdnNlM4S2JTZW9kOWhFVEUxcGJvREN0c3dtTGlWcE5wV20yVkJkakdQc2hqcDQ3Z1diUG9FM1VESWY4ZXJMRXhSaklCUUNsRzFFQ1EzWjdaa05sNWRmTWVEaWswSWMwZ3gvUUlDRTYiLCJtYWMiOiJhNmMxNGE1OTU3ZjliMDI2MmUyYTBiOGJjYjY3OTdlNjZhNGM2OTBkYjViZjhmNTdhMmRjNjNlYTQ0YTMxY2ZjIiwidGFnIjoiIn0%3D"
] = document.querySelector('meta[name="csrf-token"]')?.content;
axios.defaults.withCredentials = true;
export default {
    components: {
        NavBar,
        FooterSection,
    },
    setup() {
        // Form data
        const form = ref({
            plate: "",
            user_name: "",
            start_time: "",
            end_time: "",
            spot: "standard",
        });

        // Errors object
        const errors = ref({});

        // Spot options
        const spots = [
            { type: "standard", price: 1500 },
            { type: "covered", price: 3000 },
            { type: "premium", price: 7000 },
        ];

        // Minimum entry time (now)
        const minEntryTime = computed(() => {
            const now = new Date();
            now.setMinutes(now.getMinutes() + 15); // Allow booking 15 mins in advance
            return now.toISOString().slice(0, 16);
        });

        // Calculate total cost
        const calculateTotal = () => {
            if (
                !form.value.start_time ||
                !form.value.end_time ||
                !form.value.spot
            )
                return 0;

            const entry = new Date(form._rawValue.start_time);
            const exit = new Date(form._rawValue.end_time);
            const hours = (exit - entry) / (1000 * 60 * 60);

            const selectedSpot = spots.find(
                (s) => s.type === form._rawValue.spot
            );
            return hours * selectedSpot.price;
        };

        // Submit reservation
        const submitReservation = async () => {
            // Validate form
            errors.value = {};
            if (!form.value.user_name)
                errors.value.user_name = "Name is required.";
            if (!form.value.plate)
                errors.value.plate = "License plate is required.";
            if (!form.value.start_time)
                errors.value.start_time = "Entry time is required.";
            if (!form.value.end_time)
                errors.value.end_time = "Exit time is required.";
            if (!form.value.spot)
                errors.value.spot = "Parking spot is required.";
            console.log(calculateTotal());

            if (Object.keys(errors.value).length === 0) {
                const response = axios.post("/reserve/create", {
                    user_name: form._rawValue.user_name,
                    plate: form._rawValue.plate,
                    start_time: form._rawValue.start_time,
                    end_time: form._rawValue.end_time,
                    spot: form._rawValue.spot,
                    total: calculateTotal(),
                });
                alert("Reservation confirmed! ");
                router.visit("/");
            }
        };

        return {
            form,
            spots,
            minEntryTime,
            calculateTotal,
            submitReservation,
            errors,
        };
    },
};
</script>
