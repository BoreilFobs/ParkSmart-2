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
                                >License Plate*</label
                            >
                            <input
                                v-model="form.plate"
                                type="text"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                                placeholder="ABC123"
                            />
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >Vehicle Type*</label
                            >
                            <select
                                v-model="form.type"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                            >
                                <option value="" disabled selected>
                                    Select type
                                </option>
                                <option value="car">Car</option>
                                <option value="suv">SUV</option>
                                <option value="truck">Truck</option>
                            </select>
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
                                v-model="form.entry"
                                type="datetime-local"
                                :min="minEntryTime"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                            />
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1"
                                >Exit Time*</label
                            >
                            <input
                                v-model="form.exit"
                                type="datetime-local"
                                :min="form.entry || minEntryTime"
                                required
                                class="w-full bg-gray-700 border border-gray-600 rounded p-3 text-white focus:ring-2 focus:ring-emerald-500"
                            />
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
import NavBar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";

export default {
    components: {
        NavBar,
        FooterSection,
    },
    setup() {
        // Form data
        const form = ref({
            plate: "",
            type: "",
            entry: "",
            exit: "",
            spot: "standard",
        });
        // comonents

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
            if (!form.value.entry || !form.value.exit || !form.value.spot)
                return 0;

            const entry = new Date(form.value.entry);
            const exit = new Date(form.value.exit);
            const hours = (exit - entry) / (1000 * 60 * 60);

            const selectedSpot = spots.find((s) => s.type === form.value.spot);
            return hours * selectedSpot.price;
        };

        // Submit reservation
        const submitReservation = () => {
            alert(
                `Reservation confirmed!\nPlate: ${
                    form.value.plate
                }\nTotal: $${calculateTotal().toFixed(2)}`
            );
        };

        return {
            form,
            spots,
            minEntryTime,
            calculateTotal,
            submitReservation,
        };
    },
};
</script>

<style>
/* Custom datetime input styling */
input[type="datetime-local"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.8;
}
</style>
