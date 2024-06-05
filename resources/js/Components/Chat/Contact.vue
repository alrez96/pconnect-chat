<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({ contact: Object });
</script>

<template>
    <Link :href="route('chatroom.show', contact.id)" preserve-scroll preserve-state
        :class="{ 'bg-gray-200': $page.props.chat_id === contact.id }">
    <div class="flex items-center gap-4 p-2 hover:bg-gray-200">
        <img class="w-8 h-8 rounded-full" src="/images/profile-picture.webp">
        <strong class="text-sm font-medium">{{ contact.name }}</strong>
    </div>
    </Link>
</template>
