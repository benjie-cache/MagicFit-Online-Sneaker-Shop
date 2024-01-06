<template lang="">
    <div id="app">
      <el-backtop :right="100" :bottom="100"  style="background-color: purple;color:#fff"/>
      <router-view>
       
        
      </router-view>
     

    </div>
</template>
<script setup>
import { ElBacktop } from 'element-plus';

</script>
