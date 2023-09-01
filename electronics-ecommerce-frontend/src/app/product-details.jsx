import '../styles/product-details.scss';

import { useEffect, useState, useContext } from "react";
import { useParams, useNavigate, useLoaderData} from "react-router-dom";
import { useDispatch } from 'react-redux';
import { host } from "../App";
//import { useForm } from "react-hook-form";
import { scrollTop } from '../App';
import { PopupContext } from '../context/context';
import { addToCart } from '../redux-store/slice/cart-slice';

export const fetchProduct = async (id,category) => {
       
    const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?key=details&id=${id}&category=${category}`,
    {
        method: "GET",
        headers:{ 
            'Content-Type': 'application/json', 
        }, 
    });

    if( response.status === 200){
        return await response.json();;
    }else{
        throw new Response("Not Found", {status: 400})
    }
    
}


export default function Details(){
    const trigger = useContext(PopupContext);
    const dispatch = useDispatch();

    const product = useLoaderData();
    //const { auth } = useSelector((state) => state.auth);
    const [productData, setProduct] = useState({});
    const [images, setImages] = useState([]);
    let params = useParams();
    let navigate = useNavigate();
    let slider, slider_images, iw;
    let category = params.categoryName.charAt(0).toUpperCase() + params.categoryName.slice(1);

    function setNumberOfImages(num) {
        document.documentElement.style.setProperty('--details-images', num);
    }
    
    useEffect(() => {
        scrollTop();

        setProduct(product);
        setImages(product.images);
        setNumberOfImages(product.images.length);

    },[navigate, product])


    function swipeLeft(w){    
        if(w === 1){
            deactive();
            slider = document.getElementById("images-wrapper");
            slider_images = document.getElementById("images-container").children.length;
            iw  = document.querySelector(".image").offsetWidth;
            let slider_pos = slider.scrollLeft;
            slider.scrollLeft += -iw;
            if(slider_pos === 0){
                slider.scrollLeft += iw * (slider_images - 1);
            }
           
        }else{
            slider = document.getElementById("minor-images-slideshow-wrapper");
            slider_images = document.getElementById("minor-images-slideshow").children.length;
            iw  = document.querySelector(".minor-image").offsetWidth;
            let slider_pos = slider.scrollLeft;
            slider.scrollLeft += -iw;
            if(slider_pos === 0){
            slider.scrollLeft += iw * (slider_images - 1);
            }
        }  

    }

    function swipeRight(w){
        if(w === 1){ 
            deactive();
            slider = document.getElementById("images-wrapper");
            slider_images = document.getElementById("images-container").children.length;
            iw  = document.querySelector(".image").offsetWidth;
            let slider_pos = slider.scrollLeft;
            slider.scrollLeft += iw;     
            if(((iw + slider_pos) > ( iw * (slider_images - 1)))){
                slider.scrollLeft += -(iw * (slider_images - 1));
            }  
            //console.log(iw , slider_pos , iw * (slider_images - 1))
        }else{
            slider = document.getElementById("minor-images-slideshow-wrapper");
            slider_images = document.getElementById("minor-images-slideshow").children.length;
            iw  = document.querySelector(".minor-image").offsetWidth;
            let slider_pos = slider.scrollLeft;
            console.log(slider_pos);
            console.log(slider.offsetWidth);
            console.log(iw * (slider_images - 1));
            slider.scrollLeft += iw;     
            if(slider_pos + slider.offsetWidth >  slider.offsetWidth){
                slider.scrollLeft += -(iw * (slider_images - 1));
            }  
        }
       
    }

    function deactive(){
        const is = document.querySelectorAll(".minor-image");
        is.forEach((m) => {
            m.style.borderColor = "transparent";
            m.style.opacity = "0.65"; 
         })
    }

    
    function active(x){
        x.style.borderColor = "cyan"; 
        x.style.opacity = "1"; 
    }

    function focusSlide(evt){
        slider = document.getElementById("images-wrapper");
        let i =  parseInt(evt.target.id);
        let x = evt.currentTarget;
        const mains = document.querySelectorAll(".image");
        mains.forEach((m, index) => {
            if(index === i){
                m.scrollIntoView({behavior:"smooth",block:"nearest"});
            }
        })
        deactive();
        active(x);
    }


    
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
            <div className="product-details">
                
                <div className="product-details-wrapper">
                    <div className="images-gallery">
                        <div className="images">
                            <div className="images-wrapper" id="images-wrapper">
                                <div className="images-container" id="images-container">
                                    {images.map((image,index) => (
                                        <div className="image" key={index}><img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${image}`} alt="" /></div>
                                    ))}
                                </div>       
                            </div>
                            <button className="details-btn details-btn-left bi bi-caret-left-fill" onClick={() => {swipeLeft(1)}}></button>
                            <button className="details-btn details-btn-right bi bi-caret-right-fill" onClick={() => {swipeRight(1)}}></button>
                        </div>

                        <div className="minor-slideshow">
                            <div className="minor-images-slideshow-wrapper" id="minor-images-slideshow-wrapper" >
                                <div className="minor-images-slideshow" id="minor-images-slideshow">
                                    {images.map((image,index) => (
                                        <div className="minor-image" key={index} id={index} 
                                        onClick={(evt) => {focusSlide(evt)}} >
                                            <img id={index} src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${image}`} alt="" />
                                        </div>
                                    ))}
                                </div>    
                            </div>
                            <button className="ms-btn ms-left bi bi-caret-left-fill" onClick={() => {swipeLeft(0)}}></button>
                            <button className="ms-btn ms-right bi bi-caret-right-fill" onClick={() => {swipeRight(0)}}></button>
                        </div> 
                    </div>
                  
                    

                    <div className="details">
                        <div className="details-category-brand">
                            <span className="category-s">{category}</span>
                            <span className="brand-s">{productData.brand}</span>
                        </div>                  
                        <div className="details-pname">{productData.name}</div>
                        <div className="views"><span>Views:</span> <span className="required">{productData.views}</span></div>
                        <div className="star-rating"><span className="text">4.5</span><span className="star bi bi-star-fill"></span></div>
                        {productData.stock > 0 ?  <div className="available">Available: <span className="success font-bold">In Stock</span></div> 
                        : <div className="available">Available: <span className="alert font-bold">Out of Stock</span></div>}
    
                        <div className="price-box">
                            <div className="price-box-main">
                                <div className="buy-price">{productData.buy_price}</div>
                                {productData.original_price !== productData.buy_price && 
                                <div className="percent">-{parseFloat((productData.original_price - productData.buy_price) /  productData.original_price * 100).toFixed(2)}%</div>
                                }
                            </div>
                            {productData.original_price !== productData.buy_price &&
                            <div className="og-price">{productData.original_price}</div>
                            }
                        </div>

                        {productData.stock > 0 ? 
                        <div className="button-box" > 
                            <button className="buy-btn" onClick={() => {handleAddCart(productData)}}>Add to Cart <span className="bi bi bi-basket"></span></button>
                        </div> : 
                        <div className="button-box">                          
                        <button className="buy-btn">Subsribe for new infomation!<span className="bi bi bi-basket"></span></button>
                        </div>}

                        <div>

                        </div>
                    </div>                 
                </div>   

                <div className="details-extend">
                    <div className="specification">
                        <h3 className="specification-title">Specification</h3>
                        <Specs product={productData} category={category} />
                    </div>

                    <div>
                        <StarRating/>
                    </div>
                </div>    

                <div>
                <Comment/>
                </div>                    
            </div>
        </>
    )
}

function Specs({product, category}){

    const p = Object.assign({},product)
    
    delete p.original_price;
    delete p.buy_price;
    delete p.stock;
    delete p.category_id;
    delete p.id;
    delete p.category;
    delete p.views;
    delete p.product_id;
    delete p.name;
    delete p.images;

    const pa = Object.entries(p);
    
  
    pa.map(function(key){
        key[0] = key[0].replaceAll(/[_]/g," ");
        key[0] = key[0].charAt(0).toUpperCase() + key[0].slice(1);
        return true;

    })


    return(
        <> 
        <table className="specs-table">
            <tbody>
                {pa.map((key, i) => (
                    <tr className="row" key={i}>
                        <th>
                        {key[0]}
                        </th>
                        <td>
                        {key[1].split(";").map((x) => (
                            <div key={x}>{x}</div>
                        ))}
                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
        </>
    )
}

function StarRating(){

    
    function setStarRate(five,four,three,two,one) {
        document.documentElement.style.setProperty('--five-star', five);
        document.documentElement.style.setProperty('--four-star', four);
        document.documentElement.style.setProperty('--three-star', three);
        document.documentElement.style.setProperty('--two-star', two);
        document.documentElement.style.setProperty('--one-star', one);
    }

    const [rate, setRate] = useState(null);
    const [hover, setHover] = useState(null);
    //const { register, handleSubmit, watch, formState: {errors} } = useForm();
    let allStar = 80, fiveStar = 45, fourStar = 25, threeStar = 10, twoStar = 3, oneStar = 2;
    //let main = (((fiveStar * 5) + (fourStar * 4) + (threeStar * 3) + (twoStar * 2) + (oneStar * 1)) / allStar).toFixed(1);

    let five = (fiveStar / allStar * 100).toFixed(0) + "%";
    let four = (fourStar / allStar * 100).toFixed(0) + "%";
    let three = (threeStar / allStar * 100).toFixed(0) + "%";
    let two = (twoStar / allStar * 100).toFixed(0) + "%";
    let one = (oneStar / allStar * 100).toFixed(0) + "%";

    useEffect(() => {
        setStarRate(five,four,three,two,one);
    },[five,four,three,two,one])

    return (
        <>
         <div className='all-rates'>
                <h3>Customers Experience / Reviews</h3>
                <div className='all-rates-content'>
                    <h4 className='all-rates-content-title' >Total Reviews: {allStar}</h4>
                    <div>
                        <div className='star-row'>
                            <div className='star-num'>  
                                <span>5</span> <span className='star bi bi-star-fill'></span>
                            </div>
                            <div className='progress'>
                                <div className='progress-inner five'></div>                         
                            </div>
                            <div className='progress-percent'>{five}</div>
                        </div>

                        <div className='star-row'>
                            <div className='star-num'>  
                                <span>4</span> <span className='star bi bi-star-fill'></span>
                            </div>
                            <div className='progress'>
                                <div className='progress-inner four'></div>
                            </div>
                            <div className='progress-percent'>{four}</div>
                        </div>

                        <div className='star-row'>
                            <div className='star-num'>  
                                <span>3</span> <span className='star bi bi-star-fill'></span>
                            </div>
                            <div className='progress'>
                                <div className='3 progress-inner three'></div>
                            </div>
                            <div className='progress-percent'>{three}</div>
                        </div>

                        <div className='star-row'>
                            <div className='star-num'>  
                                <span>2</span> <span className='star bi bi-star-fill'></span>
                            </div>
                            <div className='progress'>
                                <div className='2 progress-inner two'></div>
                            </div>
                            <div className='progress-percent'>{two}</div>
                        </div>

                        <div className='star-row'>
                            <div className='star-num'>  
                                <span>1</span> <span className='star bi bi-star-fill'></span>
                            </div>
                            <div className='progress'>
                                <div className='1 progress-inner one '></div>
                            </div>
                            <div className='progress-percent'>{one}</div>
                        </div>
                        
                    </div>
                    <button className='review-btn'>View all reviews</button>
                </div>



                <form className='rating-form' action="">
                <div>
                   
                    <div>
                        {[...Array(5)].map((x,i) => {
                        const value = i + 1;
                        const color = value <= ( hover || rate ) ? "#ffc107" : "grey";
                        return(
                            <label className="star-wrap" key={i}>
                                <input type="radio" className="" value={value}  onClick={() => {setRate(value)}}/>
                                <span className="star-radio bi bi-star-fill" style={{color: color}}  
                                    onMouseEnter={() => {setHover(value)}}  onMouseLeave={() => {setHover(null)}}
                                /> 
                            </label>
                        )})}
                    </div>
                </div>

                <div className='experience'>
                        {(hover || rate) === null  && <div className='font-bold'>Hello there &#128075;</div> }
                        {(hover || rate)  === 1     && <div className='font-bold'>Terrible &#128529;</div> }
                        {(hover || rate)  === 2     && <div className='font-bold'>Bad &#128580;</div> }
                        {(hover || rate)  === 3     && <div className='font-bold'>Normal &#128522;</div> }
                        {(hover || rate)  === 4     && <div className='font-bold'>Good &#129395;</div> }
                        {(hover || rate)  === 5     && <div className='font-bold'>Excellent&#129321;</div> }
                    </div>
                
                <div className='rate-input-wrap'>
                    <textarea name="" id="" cols="45" rows="3" placeholder='Describe your experience here...'></textarea>
                </div>

                <button className='send-btn'>Send</button>
            </form>

            </div>
        </>
    )
}

function Comment(){

    return (
        <>
            <div className='comment-wrap'>
                <h3 className='comment-title'>Comment / Q&A</h3>
                <form className='comment-form' action="">
                    <div className='comment-info'>
                        <input type="text" placeholder='name'/>
                        <input type="text" placeholder='phone'/>
                    </div>
                    <div className='comment-text'>
                        <textarea name="" id="" cols="45" rows="5" placeholder='Comment here....'></textarea>
                    </div>
                    <button className='comment-btn'>Send</button>
                </form>
                <div></div>
            </div>
        </>
    )
}