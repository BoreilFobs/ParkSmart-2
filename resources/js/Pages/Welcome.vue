<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HeroSection from "@/Components/HeroSection.vue";
import NavBar from "@/Components/NavBar.vue";
import FeaturesSection from "@/Components/FeaturesSection.vue";
import Testimonies from "@/Components/Testimonies.vue";
import FooterSection from "@/Components/FooterSection.vue";
import { defineProps } from "vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome" />
    <div id="app" class="min-vh-100 position-relative">
        <NavBar />
        <HeroSection />
        <FeaturesSection />
        <Testimonies />
        <footer
            class="bg-gray-100 opacity-50 position-absolute bottom-0 dark:bg-gray-800 py-4"
        >
            <div
                class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400"
            >
                <p>&copy; 2025 ParkSmart. All rights reserved.</p>
                <p>
                    Laravel Version: {{ laravelVersion }} | PHP Version:
                    {{ phpVersion }}
                </p>
                <div class="mt-2 space-x-4">
                    <!-- <Link :href="route('privacy')" class="hover:underline"
                        >Privacy Policy</Link
                    >
                    <Link :href="route('terms')" class="hover:underline"
                        >Terms of Service</Link
                    >
                    <Link :href="route('contact')" class="hover:underline"
                        >Contact Us</Link
                    > -->

                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </Link>
                    </template>
                </div>
            </div>
        </footer>
        <!-- <footer-section></footer-section> -->
    </div>
</template>
