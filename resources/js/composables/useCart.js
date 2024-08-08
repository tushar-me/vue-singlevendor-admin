import { ref, onMounted } from 'vue';


export default function useCart() {
    let cart = ref([]);

    const addToCart = async (product) => {
        const index = cart.value.findIndex(item => {
            return item?.id === product?.id
        });
        if (index > -1) {

            if (cart.value[index].buyQty < cart.value[index].qty) {
                cart.value[index].buyQty++;
                Toast.fire({
                    icon: 'success',
                    title: "Quantity Updated..."
                })
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: "Max Quantity exist..."
                })
            }
            // cart.value[index].buyQty++;
            // Toast.fire({
            //     icon: 'success',
            //     title: "Quantity Updated..."
            // })
        } else {
            cart.value.push(product);
            Toast.fire({
                icon: 'success',
                title: "Added To Pos..."
            })
        }
        await setInLocalStorage();
    }
    const incrementQty = async (id) => {
        const index = cart.value.findIndex(item => {
            return item?.id === id
        });

        if (index > -1) {
            if (cart.value[index].buyQty < cart.value[index].qty) {
                console.log("buy qty", cart.value[index].buyQty)
                console.log("main qty", cart.value[index].qty)

                cart.value[index].buyQty++;
                Toast.fire({
                    icon: 'success',
                    title: "Quantity Updated..."
                })
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: "Max Quantity exist..."
                })
            }
        }

        await setInLocalStorage();
    }

    const decrementQty = async (id) => {
        const index = cart.value.findIndex(item => {
            return item?.id === id
        });
        if (index > -1) {
            if (cart.value[index].buyQty > 1) {
                cart.value[index].buyQty--;
                Toast.fire({
                    icon: 'success',
                    title: "Quantity Updated..."
                })
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: "Min Quantity 1 ...."
                })
            }
        }
        await setInLocalStorage();
    }

    const removeFromCart = async (item)=>{
        const index = cart.value.indexOf(item);
        if (index > -1) {
            cart.value.splice(index, 1);
            Toast.fire({
                icon: 'success',
                title: "Remove From Pos..."
            })
        }
        await setInLocalStorage();
    }

    const clearCart =()=>{
        localStorage.removeItem('pos_cart');
        cart.value = [];
    }

    const initCart = () => {
        const storedCart = localStorage.getItem('pos_cart');
        if (storedCart) {
            cart.value = JSON.parse(storedCart);
        }
    }

    const getAllItems = () => {
        return cart.value;
    }

    const getSubTotal =()=>{
        let subTotal = 0;
        cart.value.map(item =>{
            subTotal += item.price * item.buyQty
            return subTotal;
        })

        return subTotal;
    }


    const setInLocalStorage = async () => {
        localStorage.setItem('pos_cart', JSON.stringify(cart.value));
    }

    return { addToCart, initCart, incrementQty, decrementQty, removeFromCart, getAllItems, getSubTotal, clearCart, cart }
}
