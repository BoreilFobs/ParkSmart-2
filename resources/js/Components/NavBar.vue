<template>
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold text-emerald-400"
                            >ParkSmart</span
                        >
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a
                            href="/"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900"
                            >Home</a
                        >
                        <a
                            href="/pricing"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white"
                            >Pricing</a
                        >
                        <a
                            href="/contact"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white"
                            >Contact</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar",
};
</script>
