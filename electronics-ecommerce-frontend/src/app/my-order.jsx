import '../styles/my-order.scss'
import { useState,useEffect } from "react"
import { host } from "../App";
import { useSelector } from "react-redux";
import { useNavigate } from 'react-router-dom';

export default function MyOrder(){
    
    let navigate = useNavigate();
    const {userInfo} = useSelector((state) => state.auth); 
    const [orders, setOrders] = useState([]);
    const [message, setMessage] = useState();

    useEffect(() => {
        const getUserOrders = async() => {
            try{
                const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/order?get_user_order=${userInfo.username}`,
                {
                    method: "GET",
                    headers:{ 
                        'Content-Type': 'application/json', 
                    }, 
                });
    
                const data = await response.json();
    
                if(response.status === 200){
                    setOrders(data);
                }else{
                    throw new Error('Get order details failed! Try later!');
                }
            
            }catch(e){
                setMessage(e.message);
            }
        }
        getUserOrders();
    },[userInfo])

    console.log(orders);
    return (
        <>
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
        </>
    )
}