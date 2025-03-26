<template>
    <section class="py-20 bg-gray-900 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Customer Experiences</span>
                    <span class="block text-emerald-400 mt-2"
                        >Join thousands of satisfied users</span
                    >
                </h2>
            </div>

            <div class="relative px-12">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        <div
                            v-for="(testimonial, index) in testimonials"
                            :key="index"
                            class="swiper-slide"
                        >
                            <TestimonialBox v-bind="testimonial" />
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="swiper-button-prev left-0"></div>
                <div class="swiper-button-next right-0"></div>
            </div>

            <!-- Pagination -->
            <!-- <div class="swiper-pagination mt-8"></div> -->
        </div>
    </section>
</template>

<script>
import { Swiper } from "swiper";
import { Autoplay, Pagination, Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import TestimonialBox from "./TestimonialBox.vue";

export default {
    name: "TestimonialCarousel",
    components: { TestimonialBox },
    data() {
        return {
            testimonials: [
                {
                    name: "Sarah Johnson",
                    role: "Daily Commuter",
                    rating: 5,
                    text: "I've been using this parking system for 6 months and it's transformed my work commute. Never had to circle the block once since I started!",
                },
                {
                    name: "Michael Chen",
                    role: "Fleet Manager",
                    rating: 5,
                    text: "Our company manages 35 vehicles. This system cut our parking-related admin time by 70% with automated billing and reporting.",
                },
                {
                    name: "David Rodriguez",
                    role: "EV Owner",
                    rating: 4,
                    text: "The integrated charging stations are brilliant. My Tesla charges while I work and I get one consolidated bill at the end.",
                },
                {
                    name: "Emma Wilson",
                    role: "Hospital Visitor",
                    rating: 5,
                    text: "When visiting my dad at the hospital, knowing I have a guaranteed spot reduces so much stress. Worth every penny.",
                },
                {
                    name: "James Peterson",
                    role: "Business Traveler",
                    rating: 5,
                    text: "As someone who travels weekly, this app saves me 15-20 minutes each trip. The airport parking integration is flawless.",
                },
            ],
        };
    },
    mounted() {
        new Swiper(".testimonial-swiper", {
            modules: [Autoplay, Pagination, Navigation],
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 },
            },
        });
    },
};
</script>

<style>
.testimonial-swiper {
    padding: 10px;
}

.swiper-button-prev,
.swiper-button-next {
    color: #34d399;
    background: rgba(31, 41, 55, 0.8);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    --swiper-navigation-size: 20px;
}

.swiper-button-prev {
    left: 0;
}
.swiper-button-next {
    right: 0;
}

.swiper-pagination-bullet {
    background: #6b7280;
    opacity: 1;
    width: 10px;
    height: 10px;
}

.swiper-pagination-bullet-active {
    background: #34d399;
    transform: scale(1.3);
}
</style>
