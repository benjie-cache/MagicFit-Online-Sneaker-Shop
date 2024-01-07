// productStore.js
import { defineStore } from 'pinia';

export const useProductStore = defineStore({
  id: 'product',
  state: () => ({
    products: [],
    sortedProducts: [],
  }),
  getters: {
    getProductById: (state) => (productId) => {
      return state.products.find((product) => product.id === productId);
    },
  },
  actions: {
    setProducts(products) {
      this.products = products;
      this.sortedProducts = [...products]; // Initialize sortedProducts with the original products
    },
    sortProductsBy(property) {
      this.sortedProducts.sort((a, b) => {
        const aValue = a[property];
        const bValue = b[property];
        return aValue.localeCompare ? aValue.localeCompare(bValue) : aValue - bValue;
      });
    },
    resetSort() {
      this.sortedProducts = [...this.products];
    },
  },
});
