<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({ contact: Object });
</script>

<template>
    <Link :href="route('chatroom.show', contact.id)" preserve-scroll preserve-state
        :class="{ 'bg-gray-200': $page.props.chat_id === contact.id }">
    <div class="flex items-center gap-4 p-2 hover:bg-gray-200">
        <img class="w-8 h-8 rounded-full"
            src="https://images.unsplash.com/photo-1501196354995-cbb51c65aaea?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=80">
        <strong class="text-sm font-medium">{{ contact.name }}</strong>
    </div>
    </Link>
</template>
