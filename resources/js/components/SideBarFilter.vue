<script setup>
import { ref, onMounted } from 'vue';
import { useProductStore } from '@/store/productStore.js';
import { useEntitiesStore } from '@/store/entityStore.js';

const productStore = useProductStore();
const entitiesStore = useEntitiesStore();

const selectedFilters = {
  brand: null,
  category: null,
  color: null,
  size: null,
};

const applyFilters = () => {
  const filteredProducts = productStore.sortedProducts.filter((product) => {
    return (
      (!selectedFilters.brand || product.brand === selectedFilters.brand) &&
      (!selectedFilters.category || product.category === selectedFilters.category) &&
      (!selectedFilters.color || product.color === selectedFilters.color) &&
      (!selectedFilters.size || product.size === selectedFilters.size)
    );
  });

  // Update the displayed products
  displayedProducts.value = filteredProducts;
};

const resetFilters = () => {
  // Reset all filters
  Object.keys(selectedFilters).forEach((key) => {
    selectedFilters[key] = null;
  });

  // Refresh the displayed products
  displayedProducts.value = productStore.sortedProducts;
};

// Fetch entities and products on component mount
onMounted(() => {
  // Fetch entities
  entitiesStore.fetchBrands();
  entitiesStore.fetchCategories();
  entitiesStore.fetchColors();
  entitiesStore.fetchSizes();

  // Fetch products
  productStore.fetchProducts();
});

// Function to handle radio button changes for sorting
const handleSortChange = (sortType) => {
  productStore.sortProductsBy(sortType);
  applyFilters(); // Reapply filters after sorting
};
</script>
<template>
    <div class="col-lg-3">
        <div class="axil-shop-sidebar">
            <div class="d-lg-none">
                <button class="sidebar-close filter-close-btn">
                    <i class="far fa-times"></i>
                </button>
            </div>
            <div class="toggle-list product-categories">
                <h6 class="title">Brands</h6>
                <div class="shop-submenu">
                    <ul >
                       
                        <li v-for="(index,item) in entitiesStore.brands" :key="index.id" ><a href="#">{{index.name}}</a></li>
                      
                       
                      
                    </ul>
                </div>
            </div>
            <div class="toggle-list product-categories product-categories">
                <h6 class="title">Categories</h6>
                <div class="shop-submenu">
                    <ul  >
                     
                        <li v-for="(index,item) in entitiesStore.categories" :key="index.id"><a href="#">{{index.name}}</a></li>
                      
                    </ul>
                </div>
            </div>
      <div class="toggle-list product-color">
        <h6 class="title">COLORS</h6>
        <div class="shop-submenu">
          <ul>
            <li v-for="color in entitiesStore.colors" :key="color.id">
              <label :for="color.name">
                <input
                  type="radio"
                  :id="color.name"
                  :value="color.name"
                  v-model="selectedFilters.color"
                  @change="applyFilters"
                />
                <a :class="['color', color.name.toLowerCase()]"></a>
              </label>
            </li>
          </ul>
        </div>
      </div>
  
      <div class="toggle-list product-size">
        <h6 class="title">SIZE</h6>
        <div class="shop-submenu">
          <ul>
            <li v-for="size in entitiesStore.sizes" :key="size.id">
              <label :for="size.product_size">
                <input
                  type="radio"
                  :id="size.product_size"
                  :value="size.product_size"
                  v-model="selectedFilters.size"
                  @change="applyFilters"
                />
                <a>{{ size.product_size }}</a>
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="toggle-list product-price-range">
                <h6 class="title">PRICE</h6>
                <div class="shop-submenu">
                    <ul>
                        <li class="chosen"><a href="#">30</a></li>
                        <li><a href="#">5000</a></li>
                    </ul>
                    <form action="#" class="mt--25">
                        <div id="slider-range"></div>
                        <div class="flex-center mt--20">
                            <span class="input-range">Price: </span>
                            <input
                                type="text"
                                id="amount"
                                class="amount-range"
                                readonly
                            />
                        </div>
                    </form>
                </div>
            </div>
      <!-- Your existing HTML code -->
  
      <button class="axil-btn btn-bg-primary" @click="resetFilters">All Reset</button>
    </div>
</div>
  </template>



