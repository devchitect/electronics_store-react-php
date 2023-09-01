import '../styles/commons.scss'

import { useForm } from 'react-hook-form'
import { host } from '../App';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';

export default function OrderTracking(){
    let navigate = useNavigate();
    const {register, formState: {errors} , handleSubmit} = useForm();
    const [orders, setOrders] = useState();
    const [message, setMessage] = useState();
    const [phone, setPhone] = useState();

    const getOrderByPhone = async({phone}) => {
        
        setPhone(phone);
        try{
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/order?get_phone_order=${phone}`,
            {
                method: "GET",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
            });

            const data = await response.json();

            if(response.status === 200){
                setOrders(data);
        
                if(data.length === 0){
                    throw new Error('Order(s) not found!');
                }

            }else{
                throw new Error('There is something wrong! check if the phone number correct!');
            }
        
        }catch(e){
            setMessage(e.message);
        }
    }

    return(
        <>
            <div className="order-tracking">
                <h2 className="order-tracking-title">Order Tracking</h2>
                
                <form className='order-tracking-form' onSubmit={handleSubmit(getOrderByPhone)}>
                    <h4>Enter your phone number: </h4>
                    
                    <div className='order-tracking-field'>
                        <input type="text" placeholder=''  {...register("phone", {required: true, pattern: /^\d{10,}$/g})} onChange={()=> {setMessage()}}/>
                        <label >Phone number</label>
                    </div>
                    {errors.phone && <div className='required'> Phone number must atleast 10 digits!</div>}

                    <button className='order-tracking-btn'>Search</button>
                </form>
            </div>

            {(orders && orders.length > 0) ?
            <div className='order-tracking-result'>
                <h3 className='order-tracking-result-title'>Order(s) found with phone number: {phone}</h3>
            <div className='my-order'>
                {orders.map((i,index) => {
                    return(
                        <div className='order-box' key={index}>
                            <h5 className='order-box-title'>Order ID: {i.id}</h5>
                            <div className='order-box-content'>
                                <p>Method: {i.payment_method}</p>
                                {i.status === 'paid' ? <p>Status:  <span><i className='success bi bi-check-circle'></i> {i.status}</span> </p> : <p>Status: <i className='required bi bi-exclamation-circle'></i> Waiting for payment!</p> }
                                <p><b>Total</b>: ${i.total}</p>
                                <p>{i.amount} Product(s).</p>
                            </div>
                            <button className='order-btn' onClick={() => {navigate({
                                pathname:'/completion',
                                search:`?${i.id}`
                            })}}>View order details!</button>
                        </div>
                    )
                })}
            </div>
            </div>
            : <div>
                <h3 className='required' style={{textAlign: 'center', marginBottom:'100px' }}>{message}</h3>
            </div>
            }
        </>
    )
}