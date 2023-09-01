import '../styles/cart.scss';
import { useSelector, useDispatch } from 'react-redux';
import BreadCrumb from './components/breadcrumb';
import { Link } from 'react-router-dom';
import CartItem from './components/cart-item';
import { clearCart } from '../redux-store/slice/cart-slice';
import { useEffect } from 'react';
import { scrollTop } from '../App';

export default function Cart(){

    const dispatch = useDispatch();
    const {amount, cartItems, total} = useSelector((state) => state.cart)

    const handleResetCart = () => {
        dispatch(clearCart());
    }

    useEffect(() => {
        scrollTop();
    },[]);

    return (
        <>
            <BreadCrumb/>
            <div className='cart'>
                {!amount && 
                    <div className='empty-cart'>
                        <h3 className='empty-cart-title'>Your cart is currently empty!</h3>
                        <Link className='empty-cart-link link' to='/home'>Continue Shopping!</Link>
                    </div>
                }
                {amount > 0 &&
                <>
                    <Link to="/home" className='link back-to-shopping'><i className="bi bi-chevron-double-left"></i> <span>Back to shopping</span></Link>
                    <div className='cart-container'>
                        <div>
                            <div className='cart-table'>
                                <div className='cart-title'>
                                    <h4>Product Info</h4>
                                    <h4>Amount</h4>
                                    <h4>Total</h4>
                                    <h4>Action</h4>
                                </div>

                                <div className='cart-table-content'>
                                {cartItems.map((i, index) => {
                                return (
                                    <CartItem key={index} cartItem={i}/>
                                    )
                                })}
                                </div>
                            </div>

                            <div className='cart-container-extra-action'>
                                <button className='reset-cart-btn' onClick={() => {handleResetCart()}}>Clear Cart</button>   
                            </div>
                        </div>
                       

                        <div className='cart-summary'>
                            <h3 className='cart-summary-title'>Cart Summary</h3>
                            <div className='cart-summary-quantity'><span className='summary-amount'>{amount}</span> Products.</div>
                            <div className='discount-box-wrapper'>
                                <div className='discount-box'>
                                    <input type="text"  placeholder=''/>
                                    <label >Discount Code</label>
                                </div>
                                <button className='discount-box-apply-btn'>Apply</button>
                            </div>  
                            <table className='cart-summary-table'>
                                <tbody>
                                    <tr>
                                        <th>Sub Total</th>
                                        <td className='cart-item-price'>{total}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td className='font-bold cart-item-price'>{total}</td>
                                    </tr>                  
                                </tbody>                     
                            </table>      
                            <div className='vat-noti'>(This price already includes VAT)</div>

                            <div className='cart-summary-checkout-box'>
                                <Link className='cart-summary-checkout-btn link' to='/checkout' onClick={scrollTop}>Checkout</Link>
                            </div> 
                        </div>
                    </div>

                </>               
                }
            </div>
        </>
    )
}

