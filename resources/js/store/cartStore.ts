import {computed} from "vue";
import {defineStore} from "pinia";
import { ElNotification } from "element-plus";
interface ProductImage {
    url: string;
    view: string;
}
interface ProductColor {
    id: number;
    color_name: string;
    color_code: string;
    price: number;
    productImages: ProductImage[];
}
export interface Item {

    id: number;//this is the id for product color variant not the product
    brand_id: number;
    category_id: number;
    name: string;
    productColor: ProductColor;
    description: string;
    count?: number;
    itemSubtotal?: number;
}
interface cart{
    items:Item[],
    //totalItems:number,
   /// totalCost:number,

}

//constants
const CART_KEY ='cartItems'
//Add a constructor function for notification
const showNotification = (title, message, type) => {
    ElNotification({

      title,
      message,
      type,
      offset:70
    });
  };



export const useCartStore =defineStore('useCartStore', {
    state:():cart=>{
        return {
             //watch for changes in cart items

            items:JSON.parse(localStorage.getItem(CART_KEY)) || [],
            //totalItems:0,
            //totalCost:0,



        }

    },
    actions:{
        addItem(item: Item) {
            const targetItemIndex = this.items.findIndex(currItem => currItem.id === item.id);
            const targetItem = this.items[targetItemIndex];

            targetItemIndex !== -1
                ? (targetItem.count++, targetItem.itemSubtotal = this.calculateItemSubtotal(targetItem))
                : (item.count = 1, item.itemSubtotal = item.productColor.price, this.items.unshift(item));

            showNotification("Success", "Item added to the cart", "success");
        },

        increaseItem(item:Item,number=1){
            let targetIndex=this.findItemIndex(item);
            targetIndex !== -1
                ? (this.items[targetIndex].count++,
                     this.items[targetIndex].itemSubtotal = this.calculateItemSubtotal(this.items[targetIndex]))
                : console.log('item  to be increased not found');


        },
       decreaseItem(item:Item){
           let targetIndex=this.findItemIndex(item);
           //delete the item immediately the count turns zero
           targetIndex !== -1
               ? this.items[targetIndex].count > 1?
               //count is greater than 1
               (this.items[targetIndex].count--,
                   this.items[targetIndex].itemSubtotal = this.calculateItemSubtotal(this.items[targetIndex]))
                   //when only one item thats remaining
                 :(this.items=this.items.filter(currItem => currItem.id !== item.id))
                 //when item is not found
                 :console.log('item not found');
         },
         removeItem(item:Item){
             this.items=this.items.filter(currItem => currItem.id !== item.id);
         },
         calculateItemSubtotal(item:Item){
             return parseFloat((item.productColor.price * item.count).toFixed(2));
         },
        findItemIndex(item:Item){
            return this.items.findIndex(currItem => currItem.id === item.id);
        }




   },
   getters:{
        totalItems:(state)=>computed(()=>{
            return state.items.reduce((acc,currItem)=>acc+currItem.count,0)
        }),
        totalCost:(state)=>computed(()=>{
            return state.items.reduce((acc,currItem)=>acc+currItem.itemSubtotal,0)
        })

   }


}

);






