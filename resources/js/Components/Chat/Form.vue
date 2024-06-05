<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    message: '',
});
</script>

<template>
    <div class="flex flex-col h-full bg-slate-200">
        <div class="flex-1">
            <!-- messages -->
        </div>
        <div class="flex-none">
            <form class="flex"
                @submit.prevent="form.post(route('chatroom.store', $page.props.chat_id), { onSuccess: () => form.reset() })">
                <input class="px-2 py-1 mx-2 my-1 bg-white border-none rounded-lg grow min-w-32"
                    v-model="form.message" />
                <div class="flex-none w-10 p-1">
                    <button
                        class="flex items-center justify-center w-full h-full text-xs font-semibold tracking-widest text-white transition duration-150 ease-in-out rounded-full bg-cyan-800 hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
