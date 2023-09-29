<script setup>
// import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
// import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useLayout } from '@/Composables/layout';
import { ref, computed } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log In" />
    <div class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="flex flex-column align-items-center justify-content-center">
            <img :src="logoUrl" alt="EmployeeHub logo" class="mb-5 w-6rem flex-shrink-0" />
            <div
                style="border-radius: 56px; padding: 0.3rem; background: linear-gradient(180deg, var(--primary-color) 10%, rgba(33, 150, 243, 0) 30%)">
                <div class="w-full surface-card py-8 px-5 sm:px-8" style="border-radius: 53px">
                    <div class="text-center mb-5">

                        <div class="text-900 text-3xl font-medium mb-3">Welcome, Isabel!</div>
                        <span class="text-600 font-medium">Sign in to continue</span>
                    </div>

                    <div>
                        <form @submit.prevent="submit">
                            <label for="email1" class="block text-900 text-xl font-medium mb-2">Email</label>
                            <InputText id="email1" type="email" placeholder="Email address" class="w-full md:w-30rem mb-5"
                                style="padding: 1rem" v-model="form.email" />

                            <label for="password1" class="block text-900 font-medium text-xl mb-2">Password</label>
                            <Password inputId="password1" type="password" v-model="form.password" placeholder="Password"
                                :toggle-mask="true" :feedback="false" class="w-full mb-3" inputClass="w-full"
                                inputAutoComplete="current-password" :inputStyle="{ padding: '1rem' }">
                            </Password>

                            <div class="flex align-items-center justify-content-between mb-5 gap-5">
                                <div class="flex align-items-center">
                                    <Checkbox v-model="form.remember" binary class="mr-2" inputId="rememberme1"></Checkbox>
                                    <label for="rememberme1">Remember me</label>
                                </div>
                                <a class="font-medium no-underline ml-2 text-right cursor-pointer"
                                    style="color: var(--primary-color)">Forgot password?</a>
                            </div>
                            <Button type="submit" :disabled="form.processing" label="Sign In"
                                class="w-full p-3 text-xl"></Button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.pi-eye {
    transform: scale(1.6);
    margin-right: 1rem;
}

.pi-eye-slash {
    transform: scale(1.6);
    margin-right: 1rem;
}
</style>

