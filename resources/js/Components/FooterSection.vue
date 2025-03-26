<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <footer
        class="bg-gray-100 opacity-70 position-absolute bottom-0 dark:bg-gray-800 py-4"
    >
        <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            <p>&copy; 2025 ParkSmart. All rights reserved.</p>

            <div class="mt-2 space-x-4">
                <a href="/pricing" class="hover:underline">Terms of Service</a>
                <a href="route('contact')" class="hover:underline"
                    >Contact Us</a
                >

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
</template>
<script>
export default {
    name: "FooterSection",
    props: {
        laravelVersion: {
            type: String,
            required: true,
        },
        phpVersion: {
            type: String,
            required: true,
        },
    },
};
</script>
