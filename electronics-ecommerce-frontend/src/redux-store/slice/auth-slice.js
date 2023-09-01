import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import { host } from "../../App";
 
const userToken = getCookie('jwt');
const userInfo = localStorage.getItem('info') ? JSON.parse(localStorage.getItem("info")) : null;

const initialState =  {
    loading: false,
    auth: false,
    userInfo, // for user object
    userToken, // for storing the JWT
    messageSU: null,
    messageSI : null,
    success: false, // for monitoring the registration process.
};


const authSlice = createSlice({
    name: "auth",
    initialState,
    reducers: {
        // Redux Toolkit allows us to write "mutating" logic in reducers. 
        // It doesn't actually mutate the state because it uses the Immer library,
        // which detects changes to a "draft state" and produces a brand new immutable state based off those changes.
        resetMessage: (state) => {
            state.success = false;
            state.messageSI = null;
            state.messageSU = null;
        },  

        signOut: (state) => {
            setCookie('jwt','null', -2); // deletes token cookie
            localStorage.removeItem('info'); 
            state.loading = false;
            state.userInfo = null;
            state.userToken = null;
            state.auth = false;
            window.location.reload();
          },

    },

    extraReducers: (builder) => {
        builder
            /* Sign Up*/
            .addCase(signUp.pending , (state) =>{
                state.loading = true;
            })
            .addCase(signUp.fulfilled, (state,action) => {
                state.loading = false;
                state.success = true;
                state.messageSU = action.payload;           
            })
            .addCase(signUp.rejected, (state, action) => {  //rejectWithValue
                state.loading = false;
                state.messageSU = action.payload;        
            })
            /* Sign In */
            .addCase(signIn.pending, (state) => {
                state.loading = true;
            })
            .addCase(signIn.fulfilled, (state,action) => {
                state.loading = false;
                state.auth = true;
                state.userToken = action.payload.jwt;
                state.userInfo = action.payload.info;
                setCookie("jwt",action.payload.jwt,2);
                localStorage.setItem("info",JSON.stringify(action.payload.info));
            })
            .addCase(signIn.rejected, (state,action) => { //rejectWithValue
                state.loading = false;
                state.messageSI = action.payload;
               
            })
            /*Get User Profile*/
            .addCase(getProfile.pending, (state) => {
                state.loading = true;
            })
            .addCase(getProfile.fulfilled, (state, action) => {
                state.loading = false;
                state.auth = true;
                state.userInfo = action.payload;
                localStorage.setItem("info",JSON.stringify(action.payload));
            })
            .addCase(getProfile.rejected, (state, action) => {
                setCookie('jwt','null', -1);
                localStorage.removeItem('info'); // deletes info from storage
                state.loading = false;
                state.userInfo = null;
                state.userToken = null;
                state.messageSI = null;
                state.messageSU = null;
                state.auth = false;
            })

    }       
})

export const { resetMessage, signOut} = authSlice.actions
export default authSlice.reducer

//Sign Up
export const signUp = createAsyncThunk(
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

//Sign In
export const signIn = createAsyncThunk(
    'auth/signin',
    async (data , {rejectWithValue}) => {
        try {
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/user?signin`,
            {
                method: "POST",
                headers:{ 
                'Content-Type': 'application/json', 
                },
                body: JSON.stringify(data),
            })
            
            const mess = await response.json();

            if(response.status === 200){
                return JSON.parse(JSON.stringify(mess));
            }else{
                throw new Error(JSON.stringify(mess));
            }

        } catch (error) {
            return rejectWithValue(error.message)
              
        }
    }
)


export const getProfile = createAsyncThunk(
    'auth/profile',
    async (userToken,{rejectWithValue}) => {
        try {
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/user?profile`,
            {
                method: "POST",
                headers:{ 
                'Content-Type': 'application/json', 
                'Authorization': `Bearer ${userToken}`, //Apache XAMPP failed to pass this header attribute
                },
                body: JSON.stringify(`Bearer${userToken}`), //
            })
            
            const mess = await response.json();

            if(response.status === 200){
                return JSON.parse(JSON.stringify(mess));
            }else{
                throw new Error("Failed");
            }

        } catch (error) {
            return rejectWithValue(error.message)

        }
    }
)

function setCookie(cname, cvalue, exdays){
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}