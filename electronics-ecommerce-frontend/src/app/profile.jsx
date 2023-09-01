import "../styles/profile.scss"

import { Navigate, useOutletContext} from "react-router-dom";
import { host } from "../App";
import { useForm } from "react-hook-form";
import { useSelector,useDispatch } from "react-redux";
import { useEffect, useState } from "react";
import { getProfile } from "../redux-store/slice/auth-slice";

export default function Profile(){
    const {userToken, userInfo} = useSelector((state => state.auth))
    //const userInfo = useOutletContext();
    const {register, handleSubmit, reset, formState: {errors}} = useForm();
    const [successVerify,setSuccessVerify] = useState("");
    const [errorVerify,setErrorVerify] = useState("");
    const dispatch = useDispatch();
  
    useEffect(() => {

    },[userInfo]);
    
    function openVerifyBox(){
        document.querySelector(".email-verify-popup").style.display = "flex";
        document.documentElement.style.overflowY = "hidden";
    } 
    function closeVerifyBox(){
        document.querySelector(".email-verify-popup").style.display = "none";
        document.documentElement.style.overflowY = "initial";
        reFetchAfterVerifyMail();
    } 

    const onSubmit = (data) => {
        verifyEmail(data);
        reset({
            verify_code: "",
        })
    }

    const reFetchAfterVerifyMail = () => {
        dispatch(getProfile(userToken));
    }

    function resetVerifyNoti(){
        setSuccessVerify("");
        setErrorVerify("");
    }

    const verifyEmail = async(data) => {
        try{
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/user?email_verify`,
            {
                method: "POST",
                headers:{ 
                'Content-Type': 'application/json', 
                'Authorization': `Bearer ${data.jwt}`
                },
                body: JSON.stringify(data),
            })

            const message = await response.text();

                if(response.status === 200){
                    setSuccessVerify(message);
                }else{
                    throw new Error(message);
                }
            
            }catch(e){
                setErrorVerify(e.message);
        }
    } 

    if(!userInfo){
        return <Navigate to="/account/sign-in"/>
     } 

    return(
        <> 
            <div className="profile">
               
                <div className="profile-container">
                    <div>

                    </div>
                    <div className="profile-box">
                        <div className="pbox-basic">
                            <h3 className="pbox-title">Basic Info</h3>
                            <div className="profile-row">
                                <div className="profile-label">Username:</div>
                                <div className="profile-data">{userInfo.username}</div>
                            </div>
                            <div className="profile-row">
                                <div className="profile-label">First Name:</div>
                                <div className="profile-data">{userInfo.firstname}</div>
                            </div>
                            <div className="profile-row">
                                <div className="profile-label">Last Name:</div>
                                <div className="profile-data">{userInfo.lastname}</div>
                            </div>      
                            <div className="profile-row">
                                <div className="profile-label">Phone:</div>
                                <div className="profile-data">{userInfo.phone}</div>
                            </div>      
                            <div className="profile-row">
                                <div className="profile-label">Email:</div>
                                <div className="profile-data">{userInfo.email}</div>
                                {!userInfo.verify_status ? <div className="required profile-addition"><i className="bi bi-exclamation-circle"></i> Unverified!</div> 
                                :  <div className="success profile-addition"><i className="bi bi-check-circle"></i> Verified!</div> }                
                            </div>
                            {!userInfo.verify_status &&
                            <div className="profile-row">
                                <button className="profile-button" onClick={() => {openVerifyBox()}} style={{textDecoration: "underline"}}>Click here to verify email!</button>
                                <div className="email-verify-popup">
                                    <form className="verify-form" onSubmit={handleSubmit(onSubmit)}>
                                        {!successVerify && 
                                        <>
                                            <h3>Enter your verify code:</h3>
                                            <div>
                                                <input type="text" placeholder="Email verify code" onFocus={() => {resetVerifyNoti()}} {...register("verify_code", {required: true, pattern: /^\d{6}$/g})} />
                                                <input type="hidden" {...register("jwt", {value: `Bearer${userToken}`})}  />
                                            </div>
                                        </>
                                        }
                                        {successVerify && <div className="success verify-error"><i className="bi bi-exclamation-circle"></i> Email verified!</div> }
                                        {errorVerify && <div className="required verify-error"><i className="bi bi-exclamation-circle"></i> Verify failed, check the if code correctly!</div> }
                                        {errors.verify_code && <div className="required verify-error"><i className="bi bi-exclamation-circle"></i> Verify code must be exactly 6 digits!</div>}
                                        <div className="verify-btn-box">
                                            {!successVerify && <button className="verify-btn">Submit</button>}
                                            <span className="verify-btn" onClick={() => {closeVerifyBox()}}>Close</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            }
                            <div className="profile-row">
                                <div className="profile-label">Address:</div>
                                <div className="profile-data">{userInfo.address}</div>
                            </div>
                            <div className="profile-row">
                                <button className="profile-button">Change Password</button>
                            </div>
                        </div>
                        <div className="pbox-coupons">
                            <h3 className="pbox-title">Coupons</h3>
                            {!userInfo.verify_status &&
                            <div className="profile-row">
                                <div className="profile-data">Verify your email and recieve $5 coupon right away!!</div>
                            </div>
                            }
                        </div>
                       
                    </div>
                </div>
                
            </div>          
        </>
    )
}
