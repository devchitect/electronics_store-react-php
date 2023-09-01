import { configureStore } from "@reduxjs/toolkit";
import cartReducer from "./slice/cart-slice";
import authReducer from "./slice/auth-slice";

export default configureStore({
    reducer: {
        cart: cartReducer,
        auth: authReducer,
    },
})

