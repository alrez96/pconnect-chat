<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Contact from '@/Components/Chat/Contact.vue';
import Form from '@/Components/Chat/Form.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { onMounted } from 'vue'

const props = defineProps({
    contacts: {
        type: Object,
    },
    chat_id: {
        type: Number,
    },
});

onMounted(() => {
    Echo.private(`messages.${usePage().props.auth.user.id}`)
        .listen('MessageCreated', (e) => {
            if (usePage().props.chat_id && e.message.from_id == usePage().props.chat_id) {
                router.reload({ only: ['messages'] });
            }
        });

    Echo.private(`user.events`)
        .listen('UserRegistered', (e) => {
            router.reload({ only: ['contacts'] });
        });
});
</script>

<template>

    <Head title="Chatroom" />

    <AuthenticatedLayout>
        <div class="flex flex-col items-center justify-center min-h-screen">
            <div class="w-full p-4 overflow-hidden bg-white shadow-md md:max-w-2xl">
                <div class="flex border-2 border-gray-200 h-96">
                    <div class="flex flex-col w-2/6 border-r-2 border-gray-200">
                        <div class="flex-1 overflow-y-auto border-b-2 border-gray-200">
                            <div class="flex flex-col divide-y">
                                <Contact v-for="contact in contacts" :key="contact.id" :contact="contact" />
                            </div>
                        </div>
                        <div class="flex-none h-8">
                            <Link :href="route('logout')" method="post" as="button"
                                class="flex items-center justify-center w-full p-2 text-xs font-semibold tracking-widest text-white transition duration-150 ease-in-out bg-red-800 hover:bg-red-700 focus:bg-red-700 active:bg-red-900">
                            Logout
                            </Link>
                        </div>
                    </div>
                    <div class="w-4/6">
                        <Form v-if="chat_id" />

                        <div v-else class="flex items-center justify-center w-full h-full p-2 text-xs">
                            <div class="px-2 py-1 bg-gray-100 rounded-lg">
                                Select a chat to start messaging
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
