import './styles/reset.scss';
import "./styles/layout.scss";

import { Route, createBrowserRouter, RouterProvider, createRoutesFromElements} from "react-router-dom";
import { Outlet } from "react-router-dom";
import { useState, useEffect } from 'react';
import { CategoryContext, PopupContext } from './context/context';
import { useDispatch, useSelector} from 'react-redux';
import { getProfile } from './redux-store/slice/auth-slice';

import Header from './app/components/header'
import Footer from './app/components/footer'
import ScrollTop from './app/components/scrollTop';
import Home from './app/home'
import Blog from './app/blog';
import Category from './app/category';
import Cart from './app/cart';
import Details from './app/product-details';
import ProductList from './app/product-list';
import PageNotFound from './app/404';
import SimpleNav from './app/components/simple-nav';
import Auth from './app/auth';
import Signin from './app/sign-in';
import Signup from './app/sign-up';
import Profile from './app/profile';
import Checkout from './app/checkout';
import Completion from './app/completion';
import MyOrder from './app/my-order';
import OrderTracking from './app/order-tracking';

import { fetchProduct } from './app/product-details';

window.addEventListener('storage', () => {
    window.location.reload();
})

export const host = { 
  name: window.location.hostname,
  port: "8888",             
};   

export function scrollTop(){
  window.scrollTo({top: 0, behavior: 'smooth'});
}

const router = createBrowserRouter(
  createRoutesFromElements(
    <Route path="/" element={<Layout/>}>
      <Route index element={<Home />}/>
      <Route path="home" element={<Home />}/>

      <Route path=":categoryName" element={<Category />}>
        <Route index element={<ProductList />} />
        <Route path='all' element={<ProductList />}/>

        <Route path=":productId" element={<Details/>} 
              loader={async({params}) => {
                return await fetchProduct(params.productId,params.categoryName);
              }}
              errorElement={<PageNotFound/>}
        />
      </Route>  

      <Route path="account" element={<Auth />} errorElement={<PageNotFound/>}>
        <Route index element={<Profile />}/>
        <Route path="profile" element={<Profile/>}/>
        <Route path="orders" element={<MyOrder/>}/>
        <Route path="favorites" element={<Profile/>}/>
        <Route path="sign-in" element={<Signin />}/>
        <Route path="sign-up" element={<Signup />}/>
      </Route>
     
      <Route path='order-tracking' element={<OrderTracking/>} />
      <Route path="blog" element={<Blog />} />
      <Route path="cart" element={<Cart />} />
              
      <Route path="checkout" element={<Checkout />} />
      <Route path='completion' element={<Completion/>}/>

      <Route path="*" element={<PageNotFound />} />
      <Route path="404" element={<PageNotFound />} />
    </Route>
  )
)

//Main App
export default function App() {

  const {userToken} = useSelector((state) => state.auth)
  const dispatch = useDispatch();

  useEffect(() => {
    scrollTop();
  
    if(userToken){
      dispatch(getProfile(userToken));
    }
    
  },[dispatch, userToken]);

  return (
    <>
      <RouterProvider router={router} /> 
    </>
    
  );
}

//Layout
function Layout(){

  const {userToken} = useSelector((state) => state.auth)
  const [categories, setCategories] = useState([]);
  const [popUpType, setPopupType] = useState();
  const [popUpMess, setPopupMess] = useState();
  const popupTrigger = {setPopupType, setPopupMess};

  useEffect(() => {
    const fetchCategories = async () => {
      const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/category`,
      {
        method : "GET",          
        headers:{ 
            'Content-Type': 'application/json', 
        },  
      });
      const data = await response.json();  

      setCategories(data);  
      
    }
    fetchCategories();

    if(userToken){
      setPopupType('success');
      setPopupMess('Welcome Back!');
    }
    
  },[userToken])

  return (
    <main className='web-container'>
      <ScrollTop/>
      <Popup type={popUpType} message={popUpMess} setType={setPopupType} setMess={setPopupMess}/>
      <CategoryContext.Provider value={categories}>
        
        <SimpleNav/>
        <PopupContext.Provider value={popupTrigger}>

          <Header/>

          <Outlet ></Outlet>

        </PopupContext.Provider>

      </CategoryContext.Provider>
      <Footer/>
    </main>
  )
}


//Popup
function Popup({type,message,setType,setMess}){

  function close(){
    setType();
    setMess();
  }


  useEffect(() => {
    if(type && message){
      const timer = setTimeout(() => {
        setType();
        setMess();
      }, 3500);
      return () => clearTimeout(timer);
    }
   
  },[setType, setMess, type ,message])

  return(
    <>
    {(type === 'success' && message) &&
      <div className={type === 'success' ? 'popup bg-success' : 'popup bg-error'} onClick={close}>
          <h3 className='popup-title'>{message}</h3>
      </div>
    }
    </>
  )
}

//Preloader
function Preloader(){
  return(
    <>
      <div>Loading...</div>
    </>
  )
}