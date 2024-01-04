<!-- CoreSpinner.vue -->
<template>
    <div class="spinner-container">
      <CSpinner
        :size="size"
        :variant="variant"
        :border="border"
        :grow="grow"
      />
    </div>
  </template>
  
  <script>
  import { CSpinner } from '@coreui/vue';
  
  export default {
    components: {
      CSpinner,
    },
    props: {
      size: String,
      variant: String,
      border: Boolean,
      grow: Boolean,
    },
  };
  </script>
  
  <style scoped>
  .spinner-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  </style>
  