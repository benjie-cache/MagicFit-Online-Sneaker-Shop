// productStore.js
import { defineStore } from 'pinia';

export const useProductStore = defineStore({
  id: 'product',
  state: () => ({
    products: [],
    sortedProducts: [],
  
    filters: {
      brands:[],
      categories:[]
    },
  }),
  getters: {
    getProductById: (state) => (productId) => {
      return state.products.find((product) => product.id === productId);
    },
  },
  actions: {
    setProducts(products) {
      this.products = products;
      this.sortedProducts = [...products];

    
    },
   
    sortProductsBy(property) {
      this.sortedProducts.sort((a, b) => {
        const aValue = a[property];
        const bValue = b[property];
        return aValue.localeCompare ? aValue.localeCompare(bValue) : aValue - bValue;
      });
    },
    async applyFilters() {
      try {
       const headers={   "Content-Type": "application/json"}
        const apiUrl = 'api/products';
      // Send filters to the backend as query parameters
          console.log( JSON.stringify(this.filters))
          const response = await axios.get(apiUrl, {
            params:  { filters: JSON.stringify(this.filters) },
            headers: { "Content-Type": "application/json" },
          });
        console.log(response.data.data)
        // Update the sortedProducts in the store with the filtered products from the backend
        this.sortedProducts = response.data.data;
      
      } catch (error){
        console.error('Error applying filters:', error);
      }
    },
  
     
    
    },
    resetFilters() {
      // Reset filters to default values
      this.filters = {
        //brand: null,
        //category: null,
       // color: null,
        //size: null,
      };
      this.sortedProducts = [...this.products];
    },
    resetSort() {
      this.sortedProducts = [...this.products];
    },
  },
);
