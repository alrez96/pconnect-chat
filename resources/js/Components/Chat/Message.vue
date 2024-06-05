<script setup>
import dayjs from 'dayjs';

defineProps({ message: Object });
</script>

<template>
    <div v-if="$page.props.auth.user.id == message.from_id" class="flex flex-row-reverse">
        <div class="flex p-1 rounded-md bg-lime-50 gap-x-1.5 shadow-sm">
            <div class="text-sm">
                {{ message.message }}
            </div>
            <div class="flex items-end text-xs text-green-300">
                {{ dayjs(message.created_at).format('HH:mm') }}
            </div>
        </div>
    </div>
    <div v-else class="flex">
        <div class="flex p-1 rounded-md bg-cyan-50 gap-x-1.5 shadow-sm">
            <div class="text-sm">
                {{ message.message }}
            </div>
            <div class="flex items-end text-xs text-blue-300">
                {{ dayjs(message.created_at).format('HH:mm') }}
            </div>
        </div>
    </div>
</template>
