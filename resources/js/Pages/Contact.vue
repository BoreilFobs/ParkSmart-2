<script setup>
import NavBar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";
</script>
<template>
    <NavBar />
    <section class="bg-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Contact Us</span>
                    <span class="block text-emerald-400 mt-2"
                        >We're here to help</span
                    >
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-300 mx-auto">
                    Reach out for support, partnerships, or general inquiries
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div class="bg-gray-800 rounded-xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">
                        Our Offices
                    </h3>

                    <!-- Yaoundé Office -->
                    <div class="mb-8">
                        <h4
                            class="text-lg font-medium text-emerald-400 flex items-center"
                        >
                            <MapPinIcon class="h-5 w-5 mr-2" />
                            Yaoundé Headquarters
                        </h4>
                        <p class="mt-2 text-gray-300">
                            Boulevard du 20 Mai,<br />
                            Immeuble Talla, 3ème étage<br />
                            Yaoundé, Cameroon
                        </p>
                    </div>

                    <!-- Douala Office -->
                    <div class="mb-8">
                        <h4
                            class="text-lg font-medium text-emerald-400 flex items-center"
                        >
                            <MapPinIcon class="h-5 w-5 mr-2" />
                            Douala Branch
                        </h4>
                        <p class="mt-2 text-gray-300">
                            Rue Joss, Bonanjo<br />
                            Immeuble SOCAR, 2ème étage<br />
                            Douala, Cameroon
                        </p>
                    </div>

                    <!-- Contact Methods -->
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <PhoneIcon
                                class="h-5 w-5 text-emerald-400 mr-3 mt-0.5"
                            />
                            <div>
                                <p class="text-gray-300">Customer Support</p>
                                <a
                                    href="tel:+237677889900"
                                    class="text-white hover:text-emerald-400 transition-colors"
                                    >(+237) 677 88 99 00</a
                                >
                            </div>
                        </div>

                        <div class="flex items-start">
                            <PhoneIcon
                                class="h-5 w-5 text-emerald-400 mr-3 mt-0.5"
                            />
                            <div>
                                <p class="text-gray-300">Business Inquiries</p>
                                <a
                                    href="tel:+237699112233"
                                    class="text-white hover:text-emerald-400 transition-colors"
                                    >(+237) 699 11 22 33</a
                                >
                            </div>
                        </div>

                        <div class="flex items-start">
                            <EnvelopeIcon
                                class="h-5 w-5 text-emerald-400 mr-3 mt-0.5"
                            />
                            <div>
                                <p class="text-gray-300">Email</p>
                                <a
                                    href="mailto:contact@parking.cm"
                                    class="text-white hover:text-emerald-400 transition-colors"
                                    >contact@parking.cm</a
                                >
                            </div>
                        </div>

                        <div class="flex items-start">
                            <ClockIcon
                                class="h-5 w-5 text-emerald-400 mr-3 mt-0.5"
                            />
                            <div>
                                <p class="text-gray-300">Opening Hours</p>
                                <p class="text-white">
                                    Monday-Friday: 7:30 AM - 6:30 PM
                                </p>
                                <p class="text-white">
                                    Saturday: 8:00 AM - 2:00 PM
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-gray-800 rounded-xl p-8">
                    <h3 class="text-xl font-bold text-white mb-6">
                        Send Us a Message
                    </h3>
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-300 mb-1"
                                >Full Name</label
                            >
                            <input
                                type="text"
                                id="name"
                                v-model="form.name"
                                required
                                class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="John Doe"
                            />
                        </div>

                        <div>
                            <label
                                for="phone"
                                class="block text-sm font-medium text-gray-300 mb-1"
                                >Phone Number</label
                            >
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-lg bg-gray-600 text-white text-sm"
                                >
                                    +237
                                </span>
                                <input
                                    type="tel"
                                    id="phone"
                                    v-model="form.phone"
                                    required
                                    pattern="[0-9]{9}"
                                    title="Cameroonian phone number (9 digits after +237)"
                                    class="bg-gray-700 text-white rounded-r-lg px-4 py-2 w-full focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                    placeholder="677889900"
                                />
                            </div>
                            <p class="mt-1 text-xs text-gray-400">
                                Format: 6XX XXX XXX or 2XX XXX XXX
                            </p>
                        </div>

                        <div>
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-300 mb-1"
                                >Email</label
                            >
                            <input
                                type="email"
                                id="email"
                                v-model="form.email"
                                required
                                class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="john@example.com"
                            />
                        </div>

                        <div>
                            <label
                                for="subject"
                                class="block text-sm font-medium text-gray-300 mb-1"
                                >Subject</label
                            >
                            <select
                                id="subject"
                                v-model="form.subject"
                                required
                                class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                            >
                                <option value="" disabled selected>
                                    Select a subject
                                </option>
                                <option value="support">
                                    Technical Support
                                </option>
                                <option value="billing">Billing Inquiry</option>
                                <option value="partnership">
                                    Business Partnership
                                </option>
                                <option value="feedback">
                                    Feedback/Suggestion
                                </option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label
                                for="message"
                                class="block text-sm font-medium text-gray-300 mb-1"
                                >Message</label
                            >
                            <textarea
                                id="message"
                                v-model="form.message"
                                rows="4"
                                required
                                class="bg-gray-700 text-white rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                placeholder="Your message here..."
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors w-full"
                            :disabled="isSubmitting"
                        >
                            <span v-if="!isSubmitting">Send Message</span>
                            <span
                                v-else
                                class="flex items-center justify-center"
                            >
                                <svg
                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-16 bg-gray-800 rounded-xl overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.634073706379!2d11.518734414757916!3d3.866826997256851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bcf7b6e5d6e9b%3A0x1014a37e6a8e8f0!2sBoulevard%20du%2020%20Mai%2C%20Yaound%C3%A9%2C%20Cameroon!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                    width="100%"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    class="filter grayscale-50 contrast-125"
                ></iframe>
            </div>
        </div>
    </section>
    <FooterSection />
</template>
<script>
import {
    MapPinIcon,
    PhoneIcon,
    EnvelopeIcon,
    ClockIcon,
} from "@heroicons/vue/24/solid";

export default {
    name: "ContactPage",
    components: { MapPinIcon, PhoneIcon, EnvelopeIcon, ClockIcon },
    data() {
        return {
            form: {
                name: "",
                phone: "",
                email: "",
                subject: "",
                message: "",
            },
            isSubmitting: false,
        };
    },
    methods: {
        formatCameroonianPhone(phone) {
            // Format as (+237) 6XX XXX XXX
            if (!phone) return "";
            const cleaned = phone.replace(/\D/g, "");
            const match = cleaned.match(/^(\d{3})(\d{3})(\d{3})$/);
            return match ? `(+237) ${match[1]} ${match[2]} ${match[3]}` : phone;
        },
        async submitForm() {
            this.isSubmitting = true;

            try {
                // Format phone number before submission
                const formattedPhone = this.formatCameroonianPhone(
                    this.form.phone
                );

                // Here you would typically send to your backend
                const response = await fetch("/api/contact", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        ...this.form,
                        phone: formattedPhone,
                    }),
                });

                if (response.ok) {
                    alert("Thank you! Your message has been sent.");
                    this.resetForm();
                } else {
                    throw new Error("Failed to send message");
                }
            } catch (error) {
                alert(
                    "There was an error sending your message. Please try again."
                );
                console.error(error);
            } finally {
                this.isSubmitting = false;
            }
        },
        resetForm() {
            this.form = {
                name: "",
                phone: "",
                email: "",
                subject: "",
                message: "",
            };
        },
    },
};
</script>

<style scoped>
/* Custom styles for contact page */
iframe {
    filter: grayscale(50%) contrast(125%);
}

/* Improve select dropdown appearance */
select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1em;
}
</style>
