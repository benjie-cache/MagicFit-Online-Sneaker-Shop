// src/store/entities.js
import { defineStore } from 'pinia';

export const useEntitiesStore = defineStore('entities', {
  state: () => ({
    brands: [],
    categories: [],
    colors: [],
    sizes: [],
  }),

  actions: {
    setBrands(brands) {
      this.brands = brands;
    },

    setCategories(categories) {
      this.categories = categories;
    },

    setColors(colors) {
      this.colors = colors;
    },

    setSizes(sizes) {
      this.sizes = sizes;
    },
  },
});
