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


const  resetFilterArrays=()=> {
  console.log(productStore.current_page)
  for (const key in productStore.filters) {
    if (Array.isArray(productStore.filters[key])) {
      productStore.filters[key] = [];
      productStore.applyFilters()
    }
  }
}

</script>

<template>
    <div class="col-lg-2">
        <div class="axil-shop-sidebar">
    <el-row style="margin-top:55px">
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


    <!-- Categories -->
  
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

      <el-button type="primary" @click="resetFilterArrays">Reset Filter</el-button>
    </el-row>
              

        </div>
    </div>
</template>


