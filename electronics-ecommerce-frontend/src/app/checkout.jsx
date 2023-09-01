import '../styles/checkout.scss'
import BreadCrumb from "./components/breadcrumb"
import TextField from '@mui/material/TextField';
import { styled } from "@mui/material/styles";
import { useDispatch, useSelector } from 'react-redux';
import { useForm } from 'react-hook-form';
import { Link, Navigate ,useNavigate, createSearchParams } from 'react-router-dom';
import { host } from '../App';
import { useEffect, useState } from 'react';
import {Elements} from '@stripe/react-stripe-js';
import {loadStripe} from '@stripe/stripe-js';
import {useStripe, useElements, PaymentElement} from '@stripe/react-stripe-js';
import { clearCart } from '../redux-store/slice/cart-slice';
import { scrollTop } from '../App';

const stripePromise = loadStripe('pk_test_51NibE0Eipy3X3NsBscvkSIunMBCAQZqdJI33KgVKNGpiiqXu1xYdy6Etdm1kwMpaBY1yv894YEFkHbdQGsTb1VZM00QxedFqQf');


export default function Checkout(){

    const navigate = useNavigate();
    const { register, handleSubmit, formState: {errors}} = useForm();
    const {total, amount, cartItems} = useSelector((state) => state.cart);
    const {userInfo} = useSelector((state) => state.auth);
    const [payment, setPayment] = useState();
    const [billingDetails, setBillingDetails] = useState({});
    const [clientSecret, setClientSecret] = useState();
    const [message, setMessage] = useState();

    useEffect(()=> {
        scrollTop();
    },[])


    const options = {
        // passing the client secret obtained in step 3
        clientSecret: clientSecret,
        // Fully customizable with appearance API.
        appearance: {/*...*/},
      };


    const handleCashPayment = async(data) => {

        const order = {            
            total: total,
            amount: amount,
            cartItems: cartItems,
            customer: data,
            method : "cash on delivery",
            status: "unpaid",
            username : (userInfo ? userInfo.username : ""),         
        };

        try{

        const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/checkout?cash`,
            {
                method: "POST",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
                body: JSON.stringify(order),
            });

            const data_res = await response.json();

            if(response.status === 200){
               
                navigate({
                    pathname: '/completion',
                    search: `?${data_res}`
                })                
               
            }else{
                throw new Error('Place order failed! Try later!');
            }

        }catch(e){
            setMessage(e.message);
        }

    }  
  
    const stripeMethod = () => {
        setPayment('stripe');

        const pushOrderDetails = async() => {
            
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/checkout?stripe&create_payment_intent`,
            {
                method: "POST",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
                body: JSON.stringify(parseInt(total*100)),
            });
            const data = await response.json();
            setClientSecret(data);
        }
        pushOrderDetails();
    }

    if(amount === 0){
        return <Navigate to='/cart'/>
    }
  
    return (
        <>
            <BreadCrumb/>
            <div className="checkout">
                <div className='checkout-wrapper'>   
                    <div className='checkout-summary'>
                        <h3 className='checkout-box-title'>Order Summary</h3>
                        <div>
                            <table className='checkout-order-table'>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {cartItems.map((i,index) => {
                                        return (
                                            <tr key={index}>
                                                <td>
                                                    <div className='checkout-item-name'>{i.name}</div>
                                                    <div className='checkout-item-amount'>Amount: <span>x{i.amount}</span></div>
                                                </td>
                                                <td className='checkout-item-price'>{i.amount * i.price}</td>
                                            </tr>
                                        )
                                    })}
                                </tbody>
                            
                                <tfoot>
                                    <tr>
                                        <th>Sub Total</th>
                                        <td className='checkout-item-price'>{total}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <td>-</td>
                                    </tr>
                                    <tr className='row-total'>
                                        <th>Total</th>
                                        <td className=' checkout-item-price font-bold'>{total}</td>
                                    </tr>       
                                </tfoot>
                                                    
                            </table>      
                        </div>                      
                    </div>

                    <div>        
                       

                        <div className='checkout-payment'>
                            <h3 className='checkout-box-title'>Payment Method</h3>
                            <div className='checkout-payment-content'>
                                <div className='payment-box'>
                                    <label>
                                        <input type="radio" name='payment' onChange={() => {setPayment('cash')}}/>
                                        <span className='cash-label'>Cash On Delivery</span>
                                    </label>
                                    {(payment === 'cash') && 
                                    <div className='cash'>
                                        <form onSubmit={handleSubmit(handleCashPayment)}>
                                            <BillingDetails register={register} errors={errors}/>
                                            <CheckoutSubmitButton title={'Place order'}/>
                                        </form>
                                    </div>
                                    }
                                </div>

                                <div className='payment-box'>
                                    <label>
                                        <input type="radio" name='payment' onChange={() => {stripeMethod()}}/>
                                        <div className='payment-image-box payment-image-box-stripe'>
                                            <img src={require('../resources/images/payment/stripe.png')} alt="" />
                                            <img src={require('../resources/images/payment/visa.png')} alt="" />
                                            <img src={require('../resources/images/payment/mastercard.png')} alt="" />
                                        </div>                                       
                                    </label>
                                    
                                    {(payment === 'stripe' && !clientSecret) &&
                                    <div className='wait-line'><h4>Loading....</h4></div>
                                    }

                                    {(payment === 'stripe' && clientSecret) &&
                                    <div className='stripe'>
                                        <Elements stripe={stripePromise} options={options} key={clientSecret} >
                                            <StripeCheckout billingDetails={billingDetails}/>
                                        </Elements>
                                    </div>
                                    }
                                
                                </div>
                                
                                <div className='payment-box'>
                                    <label>
                                        <input type="radio"  name='payment' onChange={() => {setPayment('paypal')}}/>
                                        <div className='payment-image-box'>
                                            <img src={require('../resources/images/payment/paypal.png')} alt="" />
                                        </div>
                                    </label>
                                    {(payment === 'paypal') && 
                                    <div className='wait-line'>
                                        <h4>Coming Soon..!</h4>
                                    </div>
                                    }
                                </div>

                            </div>
                        </div>
                    {/* {payment && <CheckoutSubmitButton/>} */}
                </div>
            </div>
            </div>
        </>
    )
}

function StripeCheckout(){
    const { register, handleSubmit, formState: {errors}} = useForm();
    const stripe = useStripe();
    const elements = useElements();
    const [message, setMessage] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const {total, amount, cartItems} = useSelector((state) => state.cart);
    const {userInfo} = useSelector((state) => state.auth);

    let navigate = useNavigate();

    const handleStripePayment = async(data) => {

        if (!stripe || !elements) {
            // Stripe.js hasn't yet loaded.
            // Make sure to disable form submission until Stripe.js has loaded.
            return;
        }

        setIsLoading(true);

        const {error , paymentIntent} = await stripe.confirmPayment({
            //`Elements` instance that was used to create the Payment Element
            elements,
            confirmParams: {
              return_url: `${window.location.origin}/completion`,
            },
            redirect: 'if_required' 
          });

          if (error) {
            // This point will only be reached if there is an immediate error when
            // confirming the payment. Show error to your customer (for example, payment
            // details incomplete)
            setMessage(error.message);
          }else if (paymentIntent && paymentIntent.status === "succeeded"){

            const order = {            
                total: total,
                amount: amount,
                cartItems: cartItems,
                customer: data,
                method : "stripe",
                status: "paid",
                username : (userInfo ? userInfo.username : ""),    
            };

            const pushBillingInfo = async() => {
            
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/checkout?stripe&success`,
                {
                    method: "POST",
                    headers:{ 
                        'Content-Type': 'application/json', 
                    }, 
                    body : JSON.stringify(order)
                });

                const data_res = await response.json();
                navigate({
                    pathname: '/completion',
                    search: `?${data_res}`,
                  });
            }

            pushBillingInfo();
           

          }else {           
            setMessage("Unexpected error occurs! Try again later!"); 
            // Your customer will be redirected to your `return_url`. For some payment
            // methods like iDEAL, your customer will be redirected to an intermediate
            // site first to authorize the payment, then redirected to the `return_url`.
          }
        setIsLoading(false);
    }

    return(
        <>
            <form onSubmit={handleSubmit(handleStripePayment)}>
                <BillingDetails register={register} errors={errors}/>
                <PaymentElement/>
                <button disabled={isLoading || !stripe || !elements} className='checkout-submit-btn'>
                    {isLoading ? "Loading" : "Pay now"}
                </button>
                {message && <div className='required' style={{textAlign: 'center'}}><i className="bi bi-exclamation-circle"></i> {message}</div>}
            </form>         
        </>
    )
}


function BillingDetails({register,errors}){
    const {userInfo} = useSelector((state) => state.auth);

    return(
        <>
            <div className='checkout-billing'>
                <h3 className='checkout-box-title'>Billing Details</h3>
                <div className='billing-details'>
                    <div className='client-name'>
                        <div>
                            <StyledTextField    
                                id="firstname"  label="First Name*"  variant="outlined"  className='billing-details-field'
                                size='small'    type="text"  defaultValue={userInfo ? userInfo.firstname : ""}
                                {...register("firstname", {required: true})}        
                            />
                            {errors.firstname && <div className='required'><i className="bi bi-exclamation-circle"></i> This field is required!</div>}
                        </div>
                        <div>
                            <StyledTextField    
                                id="lastname"  label="Last Name*"  variant="outlined"  className='billing-details-field'
                                size='small'    type="text"  defaultValue={userInfo ? userInfo.lastname : ""}
                                {...register("lastname", {required: true})}        
                            />
                            {errors.lastname && <div className='required'><i className="bi bi-exclamation-circle"></i> This field is required!</div>}

                        </div>
                    </div>
                
                    <div className='client-contact'>
                        <div>
                            <StyledTextField    
                                id="phone"  label="Phone*"  variant="outlined"  className='billing-details-field'
                                size='small'    type="text"  defaultValue={userInfo ? userInfo.phone : ""}
                                {...register("phone", {required: true})}        
                            />
                            {errors.phone && <div className='required'><i className="bi bi-exclamation-circle"></i> This field is required!</div>}
                        </div>
                        <div>
                            <StyledTextField    
                                id="email"  label="Email*"  variant="outlined"  className='billing-details-field'
                                size='small'    type="text"  defaultValue={userInfo ? userInfo.email : ""}
                                {...register("email", {required: true})}        
                            />
                            {errors.email && <div className='required'><i className="bi bi-exclamation-circle"></i> This field is required!</div>}
                        </div>
                    </div>

                    <StyledTextField    
                        id="address"  label="Address*"  variant="outlined"  className='billing-details-field'
                        size='small'    type="text"  defaultValue={userInfo ? userInfo.address : ""}
                        {...register("address", {required: true})}        
                    />
                    {errors.address && <div className='required'><i className="bi bi-exclamation-circle"></i> This field is required!</div>}

                </div>
            </div>
        </>
    )
}
        
function CheckoutSubmitButton({title}){
    return (
        <>
            <button className='checkout-submit-btn'>{title}</button>
        </>
    )
}
            
const StyledTextField = styled(TextField)({
    width : '100%',
    
    '& label': {
        color: 'grey',
        fontSize: '1rem',
      },
    '& label.Mui-focused': {
        color: 'black',
    },
    '& label.MuiInputLabel-shrink ': {
        fontWeight: 'bold',
        color: 'rgb(0, 0, 0, 0.8)',
      },
    '& .MuiInput-underline:after': {
      borderBottomColor: '#B2BAC2',
    },
    '& .MuiOutlinedInput-root': {
        color: 'black',
        padding: '6px 10px 0',

      '& fieldset': {
        borderColor: ' rgb(200, 200, 200)',
        borderWidth : '1px',
        borderStyle: 'solid',
        borderRadius: '5px'
      },
      '&:hover fieldset': {
        borderColor: 'grey',
        borderStyle: 'solid',
        borderWidth : '2px',
      },
      '&.Mui-focused fieldset': {
        borderColor: 'cyan',
        borderWidth : '2px',
        borderStyle: 'solid'
      },
    },
  });
