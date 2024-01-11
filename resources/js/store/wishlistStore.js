import { ref, watch } from 'vue';
import { defineStore } from 'pinia';
import { ElNotification } from 'element-plus';
import useCartStore from "@/store/cartStore.js";
export const useWishlistStore = defineStore('useWishlistStore', ()=> {
    const useCart= useCartStore();
  const WISHLIST_KEY = 'wishlistItems';
  const wishlistItems = ref(JSON.parse(localStorage.getItem(WISHLIST_KEY)) || []);

  const showNotification = (title, message, type) => {
    ElNotification({
      title,
      message,
      type,
    });
  };

  watch(wishlistItems, (newWishlistItems) => {
    localStorage.setItem(WISHLIST_KEY, JSON.stringify(newWishlistItems));
  }, { deep: true });

  const addToWishlist = (item) => {
    wishlistItems.value.push(item);
    showNotification('Success', 'Item added to the wishlist', 'success');
    //const isAlreadyInWishlist = wishlistItems.value.find(currItem => currItem.id === item.id);
    
   // if (!isAlreadyInWishlist) {
    
    //} else {
    //  showNotification('Info', 'Item is already in the wishlist', 'info');
   // }
  };

  const removeFromWishlist = (item) => {
    wishlistItems.value = wishlistItems.value.filter(currItem => currItem.id !== item.id);
    showNotification('Success', 'Item removed from the wishlist', 'success');
  };

  const moveItemToCart = (item, cartStore) => {
    // Remove item from wishlist
    removeFromWishlist(item);

    // Add item to cart
    useCart.addItem(item);
    showNotification('Success', 'Item added to the cart from the wishlist', 'success');
  };

  return {
    wishlistItems,
    addToWishlist,
    removeFromWishlist,
    moveItemToCart,
   
  };
});
