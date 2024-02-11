
import {Item} from "../store/cartStore";
import {defineStore} from "pinia";
import { ElNotification } from "element-plus";
import {useCartStore} from "../store/cartStore";
const showNotification = (title, message, type) => {
    ElNotification({

      title,
      message,
      type,
      offset:70
    });
};

interface Wishlist{
     wishList:Item[],
}

export const  useWishlistStore = defineStore({
    id: 'wishlist',
      state:():Wishlist=>{
          return {
              wishList:[],
          }
      },
    actions: {
        addToWishList(item:Item){
            let targetIndex=this.findItemIndex(item);
            targetIndex === -1
                ? (this.wishList.unshift(item),
                    showNotification('Success', 'Item added to the wishlist', 'success'))
                :
                showNotification('Success', 'Item added to the wishlist', 'success');


        },
        removeFromWishList(item:Item){
            let targetIndex=this.findItemIndex(item);
            targetIndex !== -1
                ? (this.wishList.splice(targetIndex, 1),
                    showNotification('Success', 'Item removed from the wishlist', 'success'))
                : console.log('item not found');

        },
        transferToCart(item:Item){

            let targetIndex=this.findItemIndex(item);
            targetIndex !== -1
                ? (this.wishList.splice(targetIndex, 1),
                    useCartStore().addItem(item),
                    showNotification('Success', 'Item moved to the cart', 'success'))
                : console.log('item not found');

        },

        findItemIndex(item:Item){
            return this.wishList.findIndex(currItem => currItem.id === item.id);
        }

    },
});
