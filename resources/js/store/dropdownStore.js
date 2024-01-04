import { ref } from 'vue';
import { defineStore } from "pinia";

export default defineStore('useDropdownStore', () => {
  const isOpen = ref(false);
  const isHeaderSearchOpen=ref(false);
  const isMaskOpen=ref(false);
const isAccountDropdownopen=ref(false);
  const toggleDropdown = () => {
    isMaskOpen.value=!isMaskOpen.value;
    isOpen.value = !isOpen.value;
  
  };
  const toggleHeaderSearchDropdown = () => {
    isMaskOpen.value=!isMaskOpen.value
    isHeaderSearchOpen.value = !isHeaderSearchOpen.value;
  
  };
  const toggleAccountDropdown=()=>{
    isAccountDropdownopen.value=!isAccountDropdownopen.value;
  }
  return {
    isOpen,
    toggleDropdown,
    isHeaderSearchOpen,
    toggleHeaderSearchDropdown,
    isAccountDropdownopen,
    toggleAccountDropdown
  };
})
