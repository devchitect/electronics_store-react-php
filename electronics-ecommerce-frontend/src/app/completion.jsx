import '../styles/completion.scss'

import {useState, useEffect} from 'react';
import { useSearchParams } from "react-router-dom";
import { useDispatch } from 'react-redux';
import { clearCart } from '../redux-store/slice/cart-slice';
import { host } from '../App';
import { Link } from 'react-router-dom';

export default function Completion(){
    const dispatch = useDispatch();
    let [searchParams] = useSearchParams();
    const [message, setMessage] = useState();
    const [basic, setBasic] = useState({});
    const [details, setDetails] = useState([]);

    dispatch(clearCart());

    useEffect(() => {

        const getOrderDetails = async() => {
            try{

                const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/order?get_order&id=${searchParams}`,
                    {
                        method: "GET",
                        headers:{ 
                            'Content-Type': 'application/json', 
                        }, 
                    });
        
                    const data = await response.json();
        
                    if(response.status === 200){
                       setBasic(data.basic);
                       setDetails(data.details);

                    }else{
                        throw new Error('Get order details failed! Try later!');
                    }
        
                }catch(e){
                    setMessage(e.message);
                }
        }
        getOrderDetails();

    },[searchParams])

    

    return (
        <>
            {(basic && details) ?
            <div className='completion'>
                <div className='completion-title'>
                    <h1 className="text-center">Thank you!</h1>
                    <h3>This is your order:</h3>
                </div>
                          
                <div className='order-details'>
                    <div className='order-title'>
                        <h4>Order ID: {basic.id}</h4>
                        <h4>Created at: {basic.created_date}</h4>
                    </div>
                   
                    <div className='intro'>
                        <div>
                            <span>Status:</span>
                            {basic.status === 'unpaid' ? <span><i className="required bi bi-exclamation-circle"></i> Waiting for payment!</span>
                                : <span><i className="success bi bi-check-circle"></i> Paid!</span>
                            }
                        </div>
                        <div>
                            {basic.payment_method && 
                            <><span>Payment Method:</span> <span>{basic.payment_method.charAt(0).toUpperCase() + basic.payment_method.slice(1) }</span></> 
                            }
                        </div>
                    </div>
                
                    <div>
                        <h5>Customer Info:</h5>
                        <div>
                            <span>Fullname:</span> <span>{basic.fullname}</span>
                        </div>
                        {basic.username && 
                        <div>
                            <span>Username:</span> <span>{basic.username}</span>
                        </div>
                        }
                        <div>
                            <span>Phone:</span> <span>{basic.phone}</span>
                        </div>
                        <div>
                            <span>Email:</span> <span>{basic.email}</span>
                        </div>
                        <div>
                            <span>Address:</span> <span>{basic.address}</span>
                        </div>
                    </div>
                    <div>
                        <h5>Order Details:</h5>                   
                        <div className='products'>
                            {details.map((i) => {
                                return(
                                    <div className='product'>
                                        <div>
                                            <div>{i.product_name}</div>
                                            <div>x {i.amount}</div>
                                        </div>                   
                                        <div className='price'>{i.price * i.amount}</div>
                                    </div> 
                            )})}
                        </div>         

                         <div className='total'>
                            <span>Subtotal:</span> <span className='price'>{basic.total}</span>
                        </div>   
                        <div className='total'>
                            <span>Shipping:</span> <span>-</span>
                        </div>
                        <div className='total'>
                            <span>Total:</span> <span className='price'>{basic.total}</span>
                        </div>
                    </div>

                    <div className='goodbye'>
                        It's our pleasure to serve you, see you again,
                        <img className='logo' src={require('../resources/images/logo.png')} alt="" />
                    </div>
                </div>

                <div className='completion-btn-box'>
                    <Link to='/home' className='link completion-btn'>Home</Link>
                </div>

            </div>
            : <div>Loading</div>    
        }
        </>
    )
}