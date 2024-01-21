import { ref } from 'vue';
import axios from 'axios';
import { ElNotification, ElMessageBox } from 'element-plus';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/store/authStore.js';
import useCartStore from '@/store/cartStore.js';



export default function useOrderProcessing() {
  const router = useRouter();
  const authStore = useAuthStore();
  const cartStore = useCartStore();
  
 
 
  const showNotification = (title, message, type) => {
    ElNotification({
        title,
        message,
        type,
    });
};

  const processOrder = async () => {
    if (cartStore.items.length) {
      try {
        const headers = authStore.getHeaders();
        const data = {
          orderItems: cartStore.items,
          cartTotal: cartStore.totalCost,
        };

        const res = await axios.post(
          'api/checkout/process-order',
          JSON.stringify(data),
          { headers }
        );

        if (res.status === 200 && res.data && res.data.message === 'Order processed') {
      //    centerDialogVisible.value = false;

                          ElMessageBox.confirm(
                              "Order placed successfully. What would you like to do?",
                              "Success",
          
                              {
                                  confirmButtonText: "View Orders",
                                  cancelButtonText: "Continue Shopping",
                                  type: "success",
                                  lockScroll: false,
                              
                              }
                          )
                              .then(() => {
                                  router.push({ name: "account" });
                              })
                              .catch(() => {
                                  router.push({ name: "shop" });
                              });
         
        } else {
          showNotification(
                                "Error",
                                res.data.message ||
                                "There was an issue processing the order",
                                "error"
                            );
       
        }

        cartStore.clearCart();
      } catch (error) {
        console.error("Error processing order:", error);
            showNotification(
                "Error",
                "There was an unexpected error processing the order",
                "error"
            );
       
      }
    } else {
      showNotification(
                    "No Cart Items",
                    "You have no items in your cart",
                    "warning"
                );
    
    }
  };

 

  return {
  //  loading,
    processOrder,
  
  };
}
