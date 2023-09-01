import "../styles/home.scss";

import {Link} from 'react-router-dom';
import { useState, useEffect, useContext } from 'react';
import { host, scrollTop } from "../App";
import Banner from "./components/banner";
import Introduce from "./components/introduce";
import ProductViewsDefault from "./components/product-views-default";
import { addToCart } from "../redux-store/slice/cart-slice";
import { useDispatch, useSelector } from "react-redux";
import { PopupContext } from "../context/context";

let key, limit, offset;

export default function Home(){
    const trigger = useContext(PopupContext);
    const dispatch = useDispatch();

    const [listMostViews, setMostViews] = useState([]);
    const [topViews, setTopViews] = useState({});
    const [listMostSales, setMostSales] = useState([]);
    const [laptopList, setLaptopList] = useState([]);
    const [tabletList, setTabletList] = useState([]);
    const [phoneList, setPhoneList] = useState([]);
    
    useEffect(() => {
        scrollTop();

        // fetch data
        fetchMostViews();
        fetchMostSales();
        fetchTopViews();
        fetchLaptop();
        fetchTablet();
        fetchPhone();
    }, []);
    

    const handleAddCart = (product) => {
        trigger.setPopupType('success');
        trigger.setPopupMess('Added to your Cart!');
        dispatch(addToCart({
            price: product.buy_price,
            discount: parseFloat((product.original_price - product.buy_price) / product.original_price * 100).toFixed(2),
            name: product.name,
            id : product.product_id,
            amount : 1,
            image : product.overview_image,
            category: product.category_name,
            brand: product.brand_name
        }));
    }

    return (
        <>        
        <Banner/>
        <Introduce/>
        <main className="home-page">
            <div className="list-views-wrapper">
                <h5 className="list-views-title">Most Viewed</h5>
                <div className="list-views-container">

                    <div className="list-views">
                        {listMostViews.map(product => (
                            <div className="views-card" key={product.product_id}>
                                <div className="views-card-img">
                                    <Link to={`/${product.category_name}/${product.product_id}`} ><img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${product.overview_image}`} alt="" /></Link>
                                    <div className="views-card-info-buttons">
                                        <button className="card-info-button" title="Add To Cart" onClick={() => {handleAddCart(product)}} ><div className="button-icon bi bi-basket"></div></button>
                                        <Link to={`/${product.category_name}/${product.product_id}`} className="card-info-button" title="View Details"><div className="button-icon bi bi-search"></div></Link>
                                        <button className="card-info-button" title="Add to Favorites"><div className="button-icon bi bi-heart"></div></button>
                                    </div>
                                </div>
                                <div className="views-card-info">
                                    <Link to={`/${product.category_name}/${product.product_id}`} title={`${product.name}`}  className="link views-card-info-title">{product.name}</Link>
                                    <h5 className="views-card-info-category">{product.category_name}</h5>
                                    <div className="views-card-info-price">
                                        {
                                            (product.buy_price !== false && product.buy_price !== product.original_price) ? 
                                            <span className="valid-price">{product.buy_price}</span> : <></>
                                           
                                        }

                                        {
                                            (product.discount_price !== false && product.buy_price !== product.original_price) ? 
                                            <span className="unvalid-price">{product.original_price}</span> : <span className="valid-price">{product.original_price}</span>
                                           
                                        }
                                    </div>
                                </div>   
                            </div>
                        ))}
                    </div>

                    <div className="list-top">
                        <div key={topViews.product_id}>
                            <div className="top-img">
                                <img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${topViews.overview_image}`} alt="" />
                            </div>
                            <div className="top-info-wrapper">
                                <h5 className="top-info-title">{topViews.name}</h5>
                                <h5 className="top-info-category">{topViews.category_name}</h5>
                                <div className="top-info-price">
                                    {
                                        (topViews.buy_price !== false && topViews.buy_price !== topViews.original_price) ? 
                                        <span className="valid-price">{topViews.buy_price}</span> : <></>
                                    }

                                    {
                                        (topViews.buy_price !== false && topViews.buy_price !== topViews.original_price) ? 
                                        <span className="unvalid-price">{topViews.original_price}</span> : <span className="valid-price">{topViews.original_price}</span>                             
                                    }
                                </div>
                                <div className="top-info-buttons">
                                    <button  className="top-info-button" title="Add To Cart" onClick={() => {handleAddCart(topViews)}} ><div className="button-icon bi bi-basket"></div></button>
                                    <Link className="top-info-button" to={`/${topViews.category_name}/${topViews.product_id}`}  title="View Details"><div className="button-icon bi bi-search"></div></Link>
                                    <button className="top-info-button" title="Add to Favorites"><div className="button-icon bi bi-heart"></div></button>
                                </div>
                            </div>
                        
                        
                        </div>
                    </div>
                </div>
            </div>
           
            <ProductViewsDefault productList={listMostSales} title={"Best Sales"}/>

            <div className="second-banner">
                <div>
                    <img src={require('../resources/images/banner/martin-shreder-5Xwaj9gaR0g-unsplash.jpg')} alt="" />  
                </div>

                <div>
                    <img src={require('../resources/images/banner/jason-blackeye-XYrjl3j7smo-unsplash.jpg')} alt="" />
                </div>
            </div>

            <ProductViewsDefault productList={laptopList} title={"Laptop"}/>
            <ProductViewsDefault productList={tabletList} title={"Tablet"}/>
            <ProductViewsDefault productList={phoneList} title={"Smartphone"}/>

        </main>
        </>

    )


    async function fetchMostViews(){
        key = "views";
        limit = 6;
        offset = 1;
        const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=${key}&limit=${limit}&offset=${offset}` ,
        {
            method: "GET",
            headers:{ 
                'Content-Type': 'application/json', 
            }, 
        });
        const data = await response.json();
        // set state when the data received
        setMostViews(data);
    };

    
    async function fetchTopViews(){
        key = "views";
        limit = 1;

        const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=${key}&limit=${limit}` ,
        {
            method: "GET",
            headers:{ 
                'Content-Type': 'application/json', 
            }, 
        });
        const data = await response.json();
        // set state when the data received
        setTopViews(data);
    };

    async function fetchMostSales(){
        key = "sales";
        limit = 5;
        const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=${key}&limit=${limit}`,{
            method: "GET",
            headers:{ 
                'Content-Type': 'application/json', 
            }, 
        });
        const data = await response.json();
        // set state when the data received
        setMostSales(data);          
    };

    async function fetchLaptop() {
        try{
            const response = await 
            fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=productlist&category=laptop&limit=5`,
            {
                method: "GET",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
            })
            const data = await response.json();

            if(response.status === 200){
                setLaptopList(data);
            }else{
                throw new Error(data);
            }
                
        }catch(error){
            
        }
    }

    async function fetchTablet() {
        try{
            const response = await 
            fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=productlist&category=tablet&limit=5`,
            {
                method: "GET",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
            })
            const data = await response.json();

            if(response.status === 200){
                setTabletList(data);
            }else{
                throw new Error(data);
            }  
            
        }catch(error){
            
        }
    }

    async function fetchPhone() {
        try{
            const response = await 
            fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=productlist&category=smartphone&limit=5`,
            {
                method: "GET",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
            })
            const data = await response.json();

            if(response.status === 200){
                setPhoneList(data);
            }else{
                throw new Error(data);
            }  
            
        }catch(error){
            
        }
    }
}