<script setup>
import { defineAsyncComponent } from 'vue';
const Featured=defineAsyncComponent(()=>import('@/components/home-components/Featured.vue'));
const CategoryArea=defineAsyncComponent(()=>import('@/components/home-components/CategoryArea.vue'));


</script>
<template lang="">
  
  <main class="main-wrapper">
       <CategoryArea/>
         <Featured/>
     
    </main>
</template>

