<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen bg-gray-900 flex">
        <!-- Left Side - Branding/Visual -->
        <div
            class="hidden lg:block w-1/2 bg-gradient-to-br from-gray-800 to-emerald-900/30"
        >
            <div class="h-full flex flex-col justify-center p-12">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold text-white mb-4">LuxPark</h1>
                    <p class="text-xl text-gray-300">
                        Premium parking management system for modern cities.
                        Reserve your spot in seconds with our intuitive
                        platform.
                    </p>

                    <!-- Feature Highlights -->
                    <div class="mt-12 space-y-6">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 bg-emerald-500/10 p-2 rounded-lg"
                            >
                                <svg
                                    class="h-6 w-6 text-emerald-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-white">
                                    Real-time availability
                                </h3>
                                <p class="text-gray-400">
                                    See which spots are open before you arrive
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 bg-emerald-500/10 p-2 rounded-lg"
                            >
                                <svg
                                    class="h-6 w-6 text-emerald-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-white">
                                    Quick reservations
                                </h3>
                                <p class="text-gray-400">
                                    Book your spot in under 30 seconds
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Status Message -->
                <div
                    v-if="status"
                    class="mb-6 p-4 bg-emerald-500/10 text-emerald-400 rounded-lg text-center"
                >
                    {{ status }}
                </div>

                <!-- Card Container -->
                <div class="bg-gray-800 rounded-xl shadow-xl p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-white">
                            Welcome back
                        </h2>
                        <p class="mt-2 text-gray-400">
                            Sign in to access your account
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <InputLabel
                                for="email"
                                value="Email"
                                class="block text-sm font-medium text-gray-300 mb-2"
                            />

                            <TextInput
                                id="email"
                                type="email"
                                class="block w-full bg-gray-700 text-white border-gray-600 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg px-4 py-3"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email"
                            />

                            <InputError
                                class="mt-2 text-red-400"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password Field -->
                        <div>
                            <InputLabel
                                for="password"
                                value="Password"
                                class="block text-sm font-medium text-gray-300 mb-2"
                            />

                            <TextInput
                                id="password"
                                type="password"
                                class="block w-full bg-gray-700 text-white border-gray-600 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg px-4 py-3"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />

                            <InputError
                                class="mt-2 text-red-400"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                    class="rounded bg-gray-700 border-gray-600 text-emerald-500 focus:ring-emerald-500"
                                />
                                <span class="ms-2 text-sm text-gray-300"
                                    >Remember me</span
                                >
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-emerald-400 hover:text-emerald-300 transition-colors"
                            >
                                Forgot password?
                            </Link>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <PrimaryButton
                                class="w-full justify-center bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500 py-3 px-4 text-lg"
                                :class="{ 'opacity-50': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="!form.processing">Sign in</span>
                                <span
                                    v-else
                                    class="flex items-center justify-center"
                                >
                                    <svg
                                        class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
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
                                    Signing in...
                                </span>
                            </PrimaryButton>
                        </div>
                    </form>

                    <!-- Registration Link -->
                    <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                        <p class="text-gray-400">
                            Don't have an account?
                            <Link
                                :href="route('register')"
                                class="text-emerald-400 hover:text-emerald-300 font-medium transition-colors"
                            >
                                Sign up
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* Smooth transitions for form elements */
input[type="email"],
input[type="password"],
input[type="checkbox"] {
    transition: all 0.2s ease;
}

/* Custom focus styles */
input:focus {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
}

/* Better checkbox styling */
input[type="checkbox"] {
    width: 1.2em;
    height: 1.2em;
}

/* Responsive adjustments */
@media (max-width: 1023px) {
    .login-visual {
        display: none;
    }
}
</style>
