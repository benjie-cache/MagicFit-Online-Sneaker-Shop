<script setup>
import { ref, onMounted, watch } from "vue";
import { useProductStore } from "@/store/productStore.js";
import { useEntitiesStore } from "@/store/entityStore.js";
import {useAuthStore } from '@/store/authStore.js';
const authStore=useAuthStore()
import {
    ElCheckbox,
  
} from "element-plus";

const productStore = useProductStore();
const entitiesStore = useEntitiesStore();




</script>

<template>
    <div class="col-lg-2">
        <div class="axil-shop-sidebar">
    <el-row style="margin-top:25px">
      <el-col :span="15">
        <h5 class="text-primary mt-2">Brands</h5>
        <el-checkbox-group v-model="productStore.filters.brands"  @change="productStore.applyFilters">
          <el-checkbox
            v-for="brand in entitiesStore.brands"
            :key="brand.id"
            :label="brand.id"
          >{{ brand.name }}</el-checkbox>
        </el-checkbox-group>
      </el-col>
    </el-row>

    <!-- Categories -->
    <el-row style="margin-top:5px">
      <el-col :span="17">
        <h5 class="text-primary mt-2">Categories</h5>
        <el-checkbox-group v-model="productStore.filters.categories" @change="productStore.applyFilters">
          <el-checkbox
            v-for="category in entitiesStore.categories"
            :key="category.id"
            :label="category.id"
          >{{ category.name }}</el-checkbox>
        </el-checkbox-group>
      </el-col>
    </el-row>
              

        </div>
    </div>
</template>


