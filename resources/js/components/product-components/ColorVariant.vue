<script setup>
import { ref } from 'vue';
const props = defineProps(['productColors']);

const activeColor = ref(props.productColors[0].color_code);

const handleColorClick = (colorCode) => {
  console.log('color clicked:', colorCode);
  activeColor.value = colorCode;
};

const isActiveColor = (colorCode) => {
  return activeColor.value === colorCode;
};
const fadeColor = (color, factor) => {
  const hex = color.slice(1);
  const rgb = parseInt(hex, 16);
  const r = (rgb >> 16) & 0xff;
  const g = (rgb >> 8) & 0xff;
  const b = rgb & 0xff;

  const fadedR = Math.round(r + (255 - r) * factor);
  const fadedG = Math.round(g + (255 - g) * factor);
  const fadedB = Math.round(b + (255 - b) * factor);

  return `rgb(${fadedR},${fadedG},${fadedB})`;
};
</script>
<template>
    <div class="color-variant-wrapper">
        <ul class="color-variant">
            <li   v-for="color in productColors"
                 :key="color.id"
            
                 :class="[color.name.toLowerCase(), isActiveColor(color.color_code) ? 'active' : '']"
                 @click="() => handleColorClick(color.color_code)"
               
            >
            <span><span class="color" :style="{ backgroundColor: color.color_code }"></span></span>
            </li>
          
        </ul>
    </div>
</template>
<style scoped>
.color-variant li span .color {
  border-color: transparent;
}

.color-variant li.active span {
  border-color: grey; 
}
</style>

