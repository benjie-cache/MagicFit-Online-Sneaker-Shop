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
    current_page: 1,
    totalPages: 1,
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
          
          const response = await axios.get(apiUrl, {
            params:  { filters: JSON.stringify(this.filters),   page: this.current_page },
            headers: { "Content-Type": "application/json" },
          });
        console.log(response.data)
        // Update the sortedProducts in the store with the filtered products from the backend
        this.sortedProducts = response.data.data;
        this.totalPages = response.data.meta.last_page;
        this.current_page = response.data.meta.current_page;
      
      } catch (error){
        console.error('Error applying filters:', error);
      }
    },
  
     
    
    },
    nextPage() {
      // Increment the current page if it's less than the total number of pages
      if (this.page < this.totalPages) {
        this.page += 1;
        this.applyFilters();
      }
    },

    prevPage() {
      // Decrement the current page if it's greater than 1
      if (this.page > 1) {
        this.page -= 1;
        this.applyFilters();
      }
    },
    handlePageChange(newPage) {
      if (newPage > this.page) {
        this.nextPage();
      } else if (newPage < this.page) {
        this.prevPage();
      }
    },
    resetSort() {
      this.sortedProducts = [...this.products];
    },
  },
);
