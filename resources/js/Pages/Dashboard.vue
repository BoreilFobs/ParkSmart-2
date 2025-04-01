<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Simplified Sidebar -->
        <div
            class="fixed inset-y-0 left-0 w-56 bg-white border-r border-gray-200 flex flex-col"
        >
            <div
                class="flex items-center justify-center h-16 px-4 border-b border-gray-200"
            >
                <span class="text-lg font-semibold">ParkAdmin</span>
            </div>

            <nav class="flex-1 px-2 py-4 space-y-1">
                <a
                    v-for="item in navItems"
                    :key="item.name"
                    href="#"
                    @click="scrollTo(item.id)"
                    class="flex items-center px-3 py-2 text-sm rounded-md"
                    :class="
                        activeSection === item.id
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-600 hover:bg-gray-100'
                    "
                >
                    <component :is="item.icon" class="h-4 w-4 mr-3" />
                    {{ item.name }}
                </a>
            </nav>

            <div class="p-3 border-t border-gray-200">
                <button
                    @click="logout"
                    class="w-full flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md"
                >
                    <LogoutIcon class="h-4 w-4 mr-3" />
                    Logout
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-56">
            <!-- Minimal Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="flex justify-between items-center h-16 px-6">
                    <h1 class="text-base font-medium">
                        {{ activeSectionName }}
                    </h1>
                    <div class="flex items-center space-x-2">
                        <img
                            class="h-8 w-8 rounded-full"
                            src="https://i.pravatar.cc/150?img=3"
                            alt="User"
                        />
                    </div>
                </div>
            </header>

            <!-- Essential Content Only -->
            <main class="p-4 space-y-4">
                <!-- Only show the most critical metrics -->
                <section
                    id="overview"
                    class="bg-white rounded-lg border border-gray-200"
                >
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4">
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">
                                Total Spaces
                            </div>
                            <div class="text-xl font-semibold">
                                {{ slots.number }}
                            </div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">Occupancy</div>
                            <div class="text-xl font-semibold">
                                {{ occupancy }}%
                            </div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">
                                Today's Revenue
                            </div>
                            <div class="text-xl font-semibold">
                                {{ totalRevenue }}FCFA
                            </div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">
                                Active Reservations
                            </div>
                            <div class="text-xl font-semibold">
                                {{ reservations.length }}
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    id="update-total-spaces"
                    class="bg-white rounded-lg border w-25 border-gray-200"
                >
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-base font-medium">
                            Update Total Spaces
                        </h2>
                    </div>
                    <div class="p-4">
                        <form @submit.prevent="updateTotalSpaces">
                            <div class="mb-4">
                                <label
                                    for="totalSpaces"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Total Spaces
                                </label>
                                <input
                                    v-model.number="newTotalSpaces"
                                    type="number"
                                    id="totalSpaces"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Enter new total spaces"
                                    required
                                />
                            </div>
                            <div class="flex space-x-2">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                >
                                    Update
                                </button>
                                <button
                                    type="button"
                                    @click="cancelUpdateTotalSpaces"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- Only show current reservations (most important actionable data) -->
                <section
                    id="reservations"
                    class="bg-white rounded-lg border border-gray-200"
                >
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-base font-medium">
                            Current Reservations
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        reserver name
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Car plate
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Zone/Spot
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Time
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        total
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="res in reversedReservations"
                                    :key="res.id"
                                >
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-xs text-gray-500">
                                            {{ res.user_name }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm">
                                            {{ res.plate }}
                                        </div>
                                        <!-- <div class="text-xs text-gray-500">
                                            {{ res.user_name }}
                                        </div> -->
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ res.spot }}
                                        <span class="text-gray-500"
                                            >#{{ res.spot }}</span
                                        >
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ res.start_time }} -
                                        {{ res.end_time }}
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ res.total }}FCFA
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        <button
                                            @click="deleteReservation(res.id)"
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import {
    ChartBarIcon,
    ClockIcon,
    MapPinIcon as LocationMarkerIcon,
    CalendarIcon,
    ArrowLeftOnRectangleIcon as LogoutIcon,
} from "@heroicons/vue/24/outline";
import axios from "axios";
console.log("Dashboard component loaded");
export default {
    components: {
        ChartBarIcon,
        ClockIcon,
        LocationMarkerIcon,
        CalendarIcon,
        LogoutIcon,
    },

    props: {
        reservations: {
            type: Array,
            required: true,
        },
        slots: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            newZone: {
                name: "",
                totalSpots: "",
                rate: "",
                location: "",
                status: "Active",
            },
            activeSection: "overview",
            navItems: [
                { name: "Overview", id: "overview", icon: "ChartBarIcon" },
                {
                    name: "Reservations",
                    id: "reservations",
                    icon: "CalendarIcon",
                },
                { name: "Zones", id: "zones", icon: "LocationMarkerIcon" },
            ],
            newTotalSpaces: null,
        };
    },
    computed: {
        activeSectionName() {
            return (
                this.navItems.find((item) => item.id === this.activeSection)
                    ?.name || "Dashboard"
            );
        },
        totalRevenue() {
            return this.reservations.reduce((sum, res) => sum + res.total, 0);
        },
        reversedReservations() {
            return [...this.reservations].reverse();
        },
        occupancy() {
            return (this.reservations.length / this.slots.number) * 100;
        },
    },
    methods: {
        async deleteReservation(id) {
            if (confirm("Are you sure you want to delete this reservation?")) {
                try {
                    const response = await axios.delete(`/reservations/${id}`);
                    console.log("Delete successful:", response.data);

                    // Remove the deleted reservation from the local array
                    // this.reservations = this.reservations.filter(
                    //     (res) => res.id !== id
                    // );

                    alert("Reservation deleted successfully!");
                } catch (error) {
                    console.error(
                        "Error deleting reservation:",
                        error.response?.data || error.message
                    );
                    alert("Failed to delete the reservation.");
                }
            }
        },
        addZone() {
            this.parkingZones.push({
                id: Math.max(...this.parkingZones.map((z) => z.id)) + 1,
                name: this.newZone.name,
                totalSpots: parseInt(this.newZone.totalSpots),
                available: parseInt(this.newZone.totalSpots),
                rate: parseFloat(this.newZone.rate),
                location: this.newZone.location,
                status: this.newZone.status,
            });

            // Reset form
            this.newZone = {
                name: "",
                totalSpots: "",
                rate: "",
                location: "",
                status: "Active",
            };

            // Optional: Scroll to zones list
            this.scrollTo("zones");
        },
        cancelAddZone() {
            this.newZone = {
                name: "",
                totalSpots: "",
                rate: "",
                location: "",
                status: "Active",
            };
        },

        scrollTo(id) {
            this.activeSection = id;
            const element = document.getElementById(id);
            if (element) element.scrollIntoView({ behavior: "smooth" });
        },
        logout() {
            console.log("Logging out...");
        },
        async updateTotalSpaces() {
            try {
                const response = await axios.post("/edit-slot", {
                    number: this.newTotalSpaces,
                });
                console.log("Update successful:", response.data);
                alert("Number of spaces updated");
                // Optionally update the UI or show a success message
            } catch (error) {
                console.error("Error updating total spaces:", error);
                // Optionally show an error message
            }
        },
        cancelUpdateTotalSpaces() {
            this.newTotalSpaces = null;
        },
    },
};
</script>
