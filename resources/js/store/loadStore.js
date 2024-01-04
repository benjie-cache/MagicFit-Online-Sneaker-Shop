// src/store/index.js
import { defineStore } from 'pinia';

export const useLoadingStore = defineStore('loading', {
  state() {
    return {
      isLoading: false,
    };
  },
  actions: {
    setLoading(value) {
      this.isLoading = value;
    },
  },
});
