<template>
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div
                class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
            >
                <main
                    class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8 xl:mt-20"
                >
                    <div class="sm:text-center lg:text-left">
                        <h1
                            class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl"
                        >
                            <span class="block">Premium Parking</span>
                            <span class="block text-emerald-400"
                                >For Modern Cities</span
                            >
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
                        >
                            Reserve your parking space in seconds with our
                            advanced AI-powered system. Never circle the block
                            again.
                        </p>
                        <div
                            class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
                        >
                            <div class="rounded-md shadow">
                                <a
                                    href="/reserve"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 md:py-4 md:text-lg md:px-10"
                                >
                                    Make a reservation
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img
                class="h-56 w-full object-fit-contain p-4 sm:h-72 md:h-96 lg:w-full lg:h-full opacity-60"
                src="/images/parking-hero.jpg"
                alt="Modern parking garage"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "HeroSection",
};
</script>
