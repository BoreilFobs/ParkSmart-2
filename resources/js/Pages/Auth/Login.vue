<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({ email: "", password: "", remember: false });
const submit = () =>
    form.post(route("login"), { onFinish: () => form.reset("password") });
</script>

<template>
    <Head title="Log in" />
    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-white text-center">Login</h2>
            <p v-if="status" class="text-sm text-green-400 text-center mt-2">
                {{ status }}
            </p>

            <p v-if="$page.props.error" class="text-red-500">
                {{ $page.props.error }}
            </p>
            <form @submit.prevent="submit" class="mt-6 space-y-4">
                <div>
                    <InputLabel for="email" value="Email" class="text-white" />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        class="w-full"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel
                        for="password"
                        value="Password"
                        class="text-white"
                    />
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        class="w-full"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div
                    class="flex justify-between items-center text-sm text-gray-300"
                >
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            v-model="form.remember"
                            class="mr-2"
                        />
                        Remember me
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-emerald-400 hover:underline"
                    >
                        Forgot password?
                    </Link>
                </div>

                <PrimaryButton class="w-full">Log in</PrimaryButton>
            </form>

            <p class="text-center text-gray-300 mt-4">
                Don't have an account?
                <Link
                    :href="route('register')"
                    class="text-emerald-400 hover:underline"
                    >Sign up</Link
                >
            </p>
        </div>
    </div>
</template>
