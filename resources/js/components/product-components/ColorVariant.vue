<script setup>
import { ref,defineEmits  } from 'vue';
const emit = defineEmits(['colorChanged'])
const props = defineProps(['productColors']);

const activeColor = ref(props.productColors[0].color_code);

const handleColorClick = (colorCode,colorId) => {
  

  activeColor.value = colorCode;
   
  emit('colorChanged',colorCode,colorId);
};

const isActiveColor = (colorCode) =>{
  return activeColor.value === colorCode;
};

</script>
<template>
   
        <ul class="color-variant">
            <li   v-for="color in productColors"
                 :key="color.id"
            
                 :class="[color.name, isActiveColor(color.color_code) ? 'active' : '']"
                 @click="() => handleColorClick(color.color_code,color.id)"
               
            >
            <span><span class="color" :style="{ backgroundColor: color.color_code }"></span></span>
            </li>
          
        </ul>
 
</template>
<style scoped>
.color-variant li span .color {
  border-color: transparent;
}

.color-variant li.active span {
  border-color: grey; 
}
</style>

