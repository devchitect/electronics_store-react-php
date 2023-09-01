import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import { host } from "../../App";

// A slice is the portion of Redux code that relates to a specific set of data and actions within the store 's state. 
// A slice reducer is the reducer responsible for handling actions and updating the data for a given slice. 

const cartItems = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')).cartItems : [ ];
const amount = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')).amount : 0;
const total = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')).total : 0;

const initialState = {
    cartItems, //prduct_id , name, price, amount, image, discount
    amount,
    total, 
    isLoading: true
};


const cartSlice = createSlice({
    name: 'cart',
    initialState,
    reducers: {
        clearCart:(state) => {
            state.cartItems = [];
            state.amount = 0;
            state.total = 0;
            localStorage.setItem('cart', JSON.stringify(state));
        },

        addToCart: (state, action) => {
            let flag = false;

            state.cartItems.forEach((i) => {
                if(i.id === action.payload.id){
                    i.amount += 1;
                    state.total += i.price; 
                    state.amount += 1; 
                    flag = true;
                    return;
                }
            });

            if(!flag){
                state.total += action.payload.price; 
                state.amount += action.payload.amount;
                state.cartItems.push(action.payload);
            }
            localStorage.setItem('cart', JSON.stringify(state));
        },

        decreaseFromCart: (state, action) => {
            let id = action.payload.id;
            let flag = false;

            state.cartItems.forEach((i) => {
                if(i.id === id){

                    if(i.amount > 1){
                        i.amount -= 1;

                    }else if(i.amount === 1){
                        flag = true;
                    }

                    state.total -= i.price;
                    state.amount -= 1;
                    return;
                }
            })

            if(flag){
                state.cartItems = state.cartItems.filter(i => i.id !== id);
            }
            localStorage.setItem('cart', JSON.stringify(state));
        },

        removeFromCart: (state, action) => {
            let id = action.payload.id;

            state.cartItems.forEach((i) => {
                if(i.id === id){
                    state.total -= i.price * i.amount;
                    state.amount -= i.amount;
                }
            })

            state.cartItems = state.cartItems.filter(i => i.id !== id);
            localStorage.setItem('cart', JSON.stringify(state));
        }

    },
    extraReducers: (builder) => {
        // builder.addCase(, (state) => {

        // })
    }
    
});

export const {clearCart, addToCart, decreaseFromCart, removeFromCart} = cartSlice.actions
export default cartSlice.reducer

export const addToUserCart = createAsyncThunk(
    'auth/signup',
    async (data , {rejectWithValue}) => {
        try {
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/user?signup`,
            {
                method: "POST",
                headers:{ 
                'Content-Type': 'application/json', 
                },
                body: JSON.stringify(data),
            })
            
            const mess = await response.json();

            if(response.status === 201){
                return JSON.stringify(mess);
            }else{
                throw new Error(JSON.stringify(mess));
            }

        } catch (error) { 
            return rejectWithValue(error.message)
              
        }
    }
)
