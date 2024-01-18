<script setup>
const props = defineProps({
    title: String,
    explanation: String,
    backText: String,
});
</script>
<template>
    <div class="d-flex justify-content-center">
        <div class="content">
            <span class="title-highlighter highlighter-secondary">
                <i class="fa-solid fa-circle-exclamation"></i>{{ title }}</span
            >

            <p>
                {{ explanation }}
            </p>
            <router-link to="/shop"
                ><a class="axil-btn btn-bg-secondary right-icon">
                    {{ backText }}
                    <i class="fa fa-arrow-left"></i
                ></a>
            </router-link>
        </div>
    </div>
</template>
