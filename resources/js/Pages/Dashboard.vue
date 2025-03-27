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
                            <div class="text-xl font-semibold">248</div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">Occupancy</div>
                            <div class="text-xl font-semibold">75%</div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">
                                Today's Revenue
                            </div>
                            <div class="text-xl font-semibold">$3,245</div>
                        </div>
                        <div class="p-3 border border-gray-100 rounded-lg">
                            <div class="text-sm text-gray-500">
                                Active Reservations
                            </div>
                            <div class="text-xl font-semibold">94</div>
                        </div>
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
                                        Vehicle
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
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="res in activeReservations"
                                    :key="res.id"
                                >
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm">
                                            {{ res.plate }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ res.type }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ res.zone }}
                                        <span class="text-gray-500"
                                            >#{{ res.spot }}</span
                                        >
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ res.entry }} - {{ res.exit }}
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        <button
                                            class="text-blue-600 hover:text-blue-800 mr-2"
                                        >
                                            Extend
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            Cancel
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Only show zone availability (critical for operations) -->
                <section
                    id="zones"
                    class="bg-white rounded-lg border border-gray-200"
                >
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-base font-medium">Zone Availability</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Zone
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Available
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Rate
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500"
                                    >
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="zone in parkingZones" :key="zone.id">
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium"
                                    >
                                        {{ zone.name }}
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        {{ zone.available }}/{{
                                            zone.totalSpots
                                        }}
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm"
                                    >
                                        ${{ zone.rate }}/hr
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full"
                                            :class="
                                                zone.status === 'Active'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-yellow-100 text-yellow-800'
                                            "
                                        >
                                            {{ zone.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                <!-- Add Zone Section -->
                <section
                    id="add-zone"
                    class="bg-white rounded-lg border border-gray-200"
                >
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-base font-medium">
                            Add New Parking Zone
                        </h2>
                    </div>
                    <div class="p-4">
                        <form @submit.prevent="addZone" class="space-y-4">
                            <div>
                                <label
                                    for="zone-name"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Zone Name</label
                                >
                                <input
                                    type="text"
                                    id="zone-name"
                                    v-model="newZone.name"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="e.g. North Zone"
                                />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        for="total-spots"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        >Total Spots</label
                                    >
                                    <input
                                        type="number"
                                        id="total-spots"
                                        v-model="newZone.totalSpots"
                                        required
                                        min="1"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        placeholder="e.g. 50"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="hourly-rate"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        >Hourly Rate ($)</label
                                    >
                                    <input
                                        type="number"
                                        id="hourly-rate"
                                        v-model="newZone.rate"
                                        required
                                        min="0.5"
                                        step="0.5"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        placeholder="e.g. 3.5"
                                    />
                                </div>
                            </div>

                            <div>
                                <label
                                    for="zone-location"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Location Description</label
                                >
                                <input
                                    type="text"
                                    id="zone-location"
                                    v-model="newZone.location"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="e.g. Main building parking lot"
                                />
                            </div>

                            <div class="flex justify-end space-x-3 pt-2">
                                <button
                                    type="button"
                                    @click="cancelAddZone"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    Add Zone
                                </button>
                            </div>
                        </form>
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

export default {
    components: {
        ChartBarIcon,
        ClockIcon,
        LocationMarkerIcon,
        CalendarIcon,
        LogoutIcon,
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
            parkingZones: [
                {
                    id: 1,
                    name: "North Zone",
                    totalSpots: 80,
                    available: 12,
                    rate: 3.5,
                    status: "Active",
                },
                {
                    id: 2,
                    name: "South Zone",
                    totalSpots: 60,
                    available: 8,
                    rate: 3.0,
                    status: "Active",
                },
                {
                    id: 3,
                    name: "East Zone",
                    totalSpots: 50,
                    available: 5,
                    rate: 4.0,
                    status: "Active",
                },
                {
                    id: 4,
                    name: "West Zone",
                    totalSpots: 58,
                    available: 15,
                    rate: 5.0,
                    status: "Maintenance",
                },
            ],
            activeReservations: [
                {
                    id: "1024",
                    plate: "ABC123",
                    type: "Sedan",
                    zone: "North",
                    spot: "24",
                    entry: "10:30",
                    exit: "13:30",
                },
                {
                    id: "1023",
                    plate: "XYZ789",
                    type: "SUV",
                    zone: "South",
                    spot: "12",
                    entry: "09:15",
                    exit: "12:30",
                },
                {
                    id: "1022",
                    plate: "DEF456",
                    type: "Truck",
                    zone: "East",
                    spot: "05",
                    entry: "08:00",
                    exit: "18:00",
                },
            ],
        };
    },
    computed: {
        activeSectionName() {
            return (
                this.navItems.find((item) => item.id === this.activeSection)
                    ?.name || "Dashboard"
            );
        },
    },
    methods: {
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
    },
};
</script>

<style>
/* Remove all custom styling for maximum simplicity */
</style>
