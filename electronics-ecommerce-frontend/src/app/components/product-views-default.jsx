import { host } from "../../App"
import { Link } from "react-router-dom";
import { useContext } from "react";
import "../../styles/product-views-default.scss";
import { PopupContext } from "../../context/context";
import { useDispatch } from "react-redux";
import { addToCart } from "../../redux-store/slice/cart-slice";


export default function ProductViewsDefault({productList,title}){
    let temp = title.charAt(0).toLowerCase() + title.slice(1);

    const trigger = useContext(PopupContext);
    const dispatch = useDispatch();

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
        {productList ? 
            <div className="list-sales-wrapper">
                <div className="list-sales-title">
                    <h5>{title}</h5>
                    {(title === 'Laptop' || title === 'Tablet' || title === 'Smartphone') && 
                    <Link className="link" to={`/${temp}`}>View All</Link>
                    }
                </div>
                <div className="list-sales-container">
                    {productList.map(product => (
                        <div className="sales-card" key={product.product_id}>
                            <div className="sales-card-img">
                                <Link to={`/${product.category_name}/${product.product_id}`} >
                                    <img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${product.overview_image}`} alt="" />
                                </Link>
                                <div className="sales-info-buttons">
                                    <button className="sales-nav-btn" title="Add To Cart" onClick={() => {handleAddCart(product)}} ><div className="button-icon bi bi-basket"></div></button>
                                    <Link className="sales-nav-btn" to={`/${product.category_name}/${product.product_id}`} title="View Details"><div  className="button-icon bi bi-search"></div></Link>
                                    <button  className="sales-nav-btn" title="Add to Favorites"><div className="button-icon bi bi-heart"></div></button>
                                </div>
                            </div>
                            
                            <div className="sales-info">
                                <Link className="link sales-info-title" title={`${product.name}`}>{product.name}</Link>
                                <h5 className="sales-info-category">{product.category_name}</h5>
                                <div className="sales-info-price">
                                    {
                                        (product.buy_price !== false  && product.buy_price !== product.original_price) ? 
                                        <span className="valid-price">{product.buy_price}</span> : <></>
                                    }

                                    {
                                        (product.buy_price !== false  && product.buy_price !== product.original_price) ? 
                                        <span className="unvalid-price">{product.original_price}</span> : <span className="valid-price">{product.original_price}</span>                             
                                    }
                                </div>
                            </div>
                        </div>
                    ))}
                </div>   
            </div>
        
        :<div  className="list-sales-wrapper">
            <h3 className="list-sales-title" style={{textAlign: "center"}}> Product(s) not found!</h3>
        </div>    
        }
        </>
    )
}