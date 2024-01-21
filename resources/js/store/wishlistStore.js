import { ref, watch } from 'vue';
import { defineStore } from 'pinia';
import { ElNotification } from 'element-plus';
import useCartStore from "@/store/cartStore.js";
export const useWishlistStore = defineStore('useWishlistStore', () => {
  const useCart = useCartStore();
  const WISHLIST_KEY = 'wishlistItems';
  const wishlistItems = ref(JSON.parse(localStorage.getItem(WISHLIST_KEY)) ||[]);
 // const totalItems=ref( wishlistItems.value.reduce((acc, item) => acc + item.count, 0))

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

    const isAlreadyInWishlist = wishlistItems.value.find(currItem => currItem.id === item.id);

    if (!isAlreadyInWishlist) {
      wishlistItems.value.push(item);
      showNotification('Success', 'Item added to the wishlist', 'success');
    } else {
      showNotification('Info', 'Item is already in the wishlist', 'info');
    }
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
 
  };

  return {
    wishlistItems,
    addToWishlist,
    removeFromWishlist,
    moveItemToCart,

  };
});
