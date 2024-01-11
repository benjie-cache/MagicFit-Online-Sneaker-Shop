<template lang="">
   <Header></Header>
   

   <router-view>
      
   </router-view>

 
</template>
<script setup>

import Header from '@/components/Header.vue';


import {  onMounted } from 'vue';
import { useEntitiesStore } from '@/store/entityStore.js';


const entitiesStore = useEntitiesStore();
const fetchEntities = async () => {
  try {
    const response = await axios.get('api/entities');
    console.log(response.data)
    return response.data;
  } catch (error) {
    console.error('Error fetching entities:', error);
    throw error;
  }
};


onMounted(async () => {
  try {
    const entities = await fetchEntities();

    entitiesStore.setBrands(entities.brands);
    entitiesStore.setCategories(entities.categories);
    entitiesStore.setColors(entities.colors);
    entitiesStore.setSizes(entities.sizes);
  } catch (error) {
    console.error('Error setting entities in the store:', error);
  }
});


</script>
