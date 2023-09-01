import "../../styles/cart.scss"

import { host } from "../../App"
import { Link } from "react-router-dom"
import { useDispatch } from "react-redux"
import { decreaseFromCart, addToCart, removeFromCart } from "../../redux-store/slice/cart-slice"

export default function CartItem({cartItem}){
    const dispatch = useDispatch();
    

    function handleDecrease(){
        dispatch(decreaseFromCart({
            id : cartItem.id
        }))
    }
    function handleIncrease(){
        dispatch(addToCart({
            id : cartItem.id

        }))
    }

    return(
        <>
            <div className="cart-item-container">

                <div className="cart-item-product-info">
                    
                    <div className="cart-item-image-box">
                        <img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${cartItem.image}`} alt="" />
                    </div>

                    <div className="cart-item-details">
                        <Link className="link cart-item-name" to={`/${cartItem.category}/${cartItem.id}`}
                        title={`${cartItem.brand} ${cartItem.name}`} >{cartItem.brand} {cartItem.name}</Link>
                       <div className="cart-item-category">{cartItem.category}</div>
                       <div className="cart-item-buy-price"> 
                            <span>Price: </span>
                            <span className="cart-item-price">{cartItem.price}</span>
                            {cartItem.discount > 0 && <span className="cart-item-discount required">- {cartItem.discount}%</span>}
                        </div>
                        {cartItem.discount > 0 &&
                        <>
                            <div>
                                
                            </div>
                            <div className="cart-item-price cart-item--before-discount">{parseInt(cartItem.price / (100 - cartItem.discount) * 100)}</div>
                        </>
                        }
                    </div>
                </div>  

                <div className="amount-box">
                    <span  className="amount-btn bi bi-dash-lg" onClick={() => {handleDecrease()}}></span>
                    <input type="number" value={cartItem.amount} readOnly/>
                    <span className="amount-btn bi bi-plus-lg" onClick={() => {handleIncrease()}}></span>
                </div>

                <div className="cart-item-subtotal cart-item-price">{cartItem.amount * cartItem.price}</div>
                
                <div className="remove-btn-box">
                    <div className="remove-btn bi bi-trash" onClick={() => {dispatch(removeFromCart({id: cartItem.id}))}}></div>
                </div>
               
            </div>
        </>
    )
}

