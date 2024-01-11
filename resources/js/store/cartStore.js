import { ref, watch } from "vue";
import { defineStore } from "pinia";
import { ElNotification } from "element-plus";
export default defineStore('useCartStore', () => {
    const CART_KEY = 'cartItems';
    const items = ref(JSON.parse(localStorage.getItem(CART_KEY)) || []);
    const totalItems = ref(items.value.reduce((acc, item) => acc + item.count, 0));
    const totalCost = ref(parseFloat(items.value.reduce((acc, item) => acc + item.price * item.count, 0)).toFixed(2));

    watch(items, (newItems) => {
        localStorage.setItem(CART_KEY, JSON.stringify(newItems));
        totalItems.value = newItems.reduce((acc, item) => acc + item.count, 0);
        totalCost.value = parseFloat(newItems.reduce((acc, item) => acc + item.price * item.count, 0)).toFixed(2);
    }, { deep: true });
    const showNotification = (title, message, type) => {
        ElNotification({
          title,
          message,
          type,
        });
      };
    const calculateSubtotal = (item) => parseFloat((parseFloat(item.price) * item.count).toFixed(2));
    const addItem = (item) => {
        let targetItem = items.value.find(currItem => currItem.id === item.id);
    
        if (targetItem) {
            showNotification("Success", "Item added to the cart", "success");
            //targetItem.count += 1;
          //  targetItem.subtotal = item.price; // Update subtotal for existing item
        } else {
            showNotification("Success", "Item added to the cart", "success");
            const newItem = { ...item, count: 1 };
            newItem.subtotal = newItem.price; //Calculate subtotal after ensuring price is defined
            items.value.push(newItem); // Add new item with subtotal
        }
    };
    const updateItemSubtotal = (item) => {
        const targetItem = items.value.find(currItem => currItem.id === item.id);
        if (targetItem) {
            targetItem.subtotal = calculateSubtotal(targetItem);
           
        }
    };
    const increaseItem = (item, number = 1) => {
        let targetItem = items.value.find(currItem => currItem.id === item.id);

        if(targetItem) {
            targetItem.count += number;
            updateItemSubtotal(targetItem);
            showNotification("Info", "Item sub-total updated", "info");
        }
    };

    const decreaseItem = (item, number = 1) => {
        let targetItem = items.value.find(currItem => currItem.id === item.id);

        if(targetItem) {
            if (number === 'all' || targetItem.count <= number) {
                items.value = items.value.filter(currItem => currItem.id !== item.id);
                showNotification("success", "Item removed from the cart", "info");
            } else {
                targetItem.count -= number;
                updateItemSubtotal(targetItem);
                showNotification("Info", "Item sub-total updated", "info");
            }
        }
    };
    const removeItem = (item) => {
        let targetItem = items.value.find(currItem => currItem.id === item.id);

        if(targetItem) {
            if(targetItem.count === 1) {
                items.value = items.value.filter(currItem => currItem.id !== item.id);
            } else {
                targetItem.count -= 1;
            }
        }
    };
   
    

    const clearCart = () => {
        items.value = [];
        totalItems.value = 0;
        totalCost.value = 0;
        showNotification("Success", "All items in the cart are cleared", "success");
    };

    return {
        items,
        increaseItem,
        decreaseItem,
        addItem,
        removeItem,
        clearCart,
        totalItems,
        totalCost
    };
});
