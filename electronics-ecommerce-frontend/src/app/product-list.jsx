import '../styles/product-list.scss'

import { useEffect, useState } from 'react'
import { useOutletContext } from 'react-router-dom'
import { Link } from 'react-router-dom';
import { host } from '../App';
import ProductViewsDefault from './components/product-views-default';

export default function ProductList(){
    let brands = '&';
    let [category,brand,min_price,max_price] = useOutletContext();
    const [productList, setProductList] = useState([]);

    brand.forEach((b) => {
        brands += `brand[]=${b}&`
    })


    useEffect(() => {
        const fetchProductList = async() => {
            try{
                const response = await 
                fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=productlist&category=${category}${brands}min_price=${min_price}&max_price=${max_price}`,
                {
                    method: "GET",
                    headers:{ 
                        'Content-Type': 'application/json', 
                    }, 
                })
                const data = await response.json();

                if(response.status === 200){
                    setProductList(data);
                }else{
                    throw new Error(data);
                }
              
                
            }catch(error){
                setProductList();
            }
        }
        fetchProductList();

    },[category,brands,min_price,max_price])

    return(
        <>
            <div className='product-list'>
                <ProductViewsDefault productList={productList} title={""} />
            </div>
        </>
    )
}


