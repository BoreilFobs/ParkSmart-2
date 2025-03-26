<script setup>
import { ref } from "vue";
import {
    MapPinIcon,
    PhoneIcon,
    EnvelopeIcon,
    ClockIcon,
} from "@heroicons/vue/24/outline";
import NavBar from "@/Components/NavBar.vue";
import FooterSection from "@/Components/FooterSection.vue";

const form = ref({ name: "", phone: "", email: "", subject: "", message: "" });
const isSubmitting = ref(false);

const submitForm = async () => {
    isSubmitting.value = true;
    try {
        await fetch("/api/contact", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(form.value),
        });
        alert("Thank you! Your message has been sent.");
        form.value = {
            name: "",
            phone: "",
            email: "",
            subject: "",
            message: "",
        };
    } catch (error) {
        alert("There was an error sending your message. Please try again.");
    } finally {
        isSubmitting.value = false;
    }
};
</script>

<template>
    <NavBar />
    <section class="bg-gray-900 py-20 px-6">
        <div class="max-w-7xl mx-auto text-center text-white">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Contact Us</h2>
            <p class="mt-2 text-emerald-400">We're here to help</p>
            <p class="mt-4 text-gray-300">
                Reach out for support, partnerships, or general inquiries.
            </p>
        </div>

        <div class="max-w-4xl mx-auto mt-12 grid gap-8 lg:grid-cols-2">
            <div class="bg-gray-800 rounded-xl p-6 space-y-4 text-white">
                <h3 class="text-xl font-bold">Our Offices</h3>
                <div class="space-y-4">
                    <div>
                        <h4
                            class="text-lg font-medium text-emerald-400 flex items-center"
                        >
                            <MapPinIcon class="h-5 w-5 mr-2" /> Yaoundé
                            Headquarters
                        </h4>
                        <p class="text-gray-300">
                            Boulevard du 20 Mai, Yaoundé, Cameroon
                        </p>
                    </div>
                    <div>
                        <h4
                            class="text-lg font-medium text-emerald-400 flex items-center"
                        >
                            <MapPinIcon class="h-5 w-5 mr-2" /> Douala Branch
                        </h4>
                        <p class="text-gray-300">
                            Rue Joss, Bonanjo, Douala, Cameroon
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="flex items-center">
                        <PhoneIcon class="h-5 w-5 text-emerald-400 mr-2" />
                        (+237) 677 88 99 00
                    </p>
                    <p class="flex items-center">
                        <EnvelopeIcon class="h-5 w-5 text-emerald-400 mr-2" />
                        contact@parking.cm
                    </p>
                    <p class="flex items-center">
                        <ClockIcon class="h-5 w-5 text-emerald-400 mr-2" />
                        Mon-Fri: 7:30 AM - 6:30 PM
                    </p>
                </div>
            </div>

            <div class="bg-gray-800 rounded-xl p-6 text-white">
                <h3 class="text-xl font-bold mb-4">Send Us a Message</h3>
                <form @submit.prevent="submitForm" class="space-y-4">
                    <input
                        type="text"
                        v-model="form.name"
                        required
                        placeholder="Full Name"
                        class="input"
                    />
                    <input
                        type="tel"
                        v-model="form.phone"
                        required
                        placeholder="Phone Number"
                        class="input"
                    />
                    <input
                        type="email"
                        v-model="form.email"
                        required
                        placeholder="Email"
                        class="input"
                    />
                    <select v-model="form.subject" required class="input">
                        <option value="" disabled>Select a subject</option>
                        <option value="support">Technical Support</option>
                        <option value="billing">Billing Inquiry</option>
                        <option value="partnership">
                            Business Partnership
                        </option>
                        <option value="feedback">Feedback/Suggestion</option>
                    </select>
                    <textarea
                        v-model="form.message"
                        required
                        rows="4"
                        placeholder="Your message"
                        class="input"
                    ></textarea>
                    <button type="submit" class="btn" :disabled="isSubmitting">
                        {{ isSubmitting ? "Sending..." : "Send Message" }}
                    </button>
                </form>
            </div>
        </div>
    </section>
    <FooterSection />
</template>

<style scoped>
.input {
    width: 100%;
    padding: 10px;
    background: #2d3748;
    color: white;
    border-radius: 8px;
    border: none;
    outline: none;
    transition: 0.3s;
}
.input:focus {
    border: 2px solid #34d399;
}
.btn {
    width: 100%;
    padding: 12px;
    background: #34d399;
    color: white;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.3s;
}
.btn:hover {
    background: #10b981;
}
</style>
