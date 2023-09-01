import "../styles/si-su.scss"

import { useForm } from "react-hook-form"
import { signUp, resetMessage } from "../redux-store/slice/auth-slice";
import { useSelector, useDispatch } from "react-redux";
import { useEffect } from "react";
import { Navigate, useOutletContext } from "react-router-dom";
import { scrollTop } from "../App";


export default function Signup(){

    const {messageSU, loading, success} = useSelector((state) => state.auth);  
    const userInfo = useOutletContext();
    const dispatch = useDispatch();
    const {register, handleSubmit, watch, reset, formState: {errors} } = useForm();

    const onSubmit = (data) => {
        scrollTop();
        if(data.email){
            data.email = data.email.toLowerCase();
        }
        delete data.policy;
        dispatch(signUp(data));
    }

    const pass_watch = watch('password', '');

    function revealPass(){
        let x = document.getElementById("password");
        let b = document.querySelector(".pass-icon");
        if (x.type === "password") {
            x.type = "text";
            b.classList.replace("bi-eye-slash-fill","bi-eye-fill");
          } else {
            x.type = "password";
            b.classList.replace("bi-eye-fill","bi-eye-slash-fill");
          }
            
    }

    useEffect(() => {     
        scrollTop();

        if(success || (!success && messageSU)){
            reset({
                email:"",
                username:"",
                password:"",
                firstname:"",
                lastname:"",
                phone:""
            })
            const timer = setTimeout(()=> {
                dispatch(resetMessage());          
            }, 10000)     
            return () => clearTimeout(timer);    
        }

    }, [reset, dispatch, success, messageSU, userInfo])

    if(userInfo){
        return (<Navigate to="/account/profile"/>)
    }
    return(
        <>
            <div className="sign-up sign">
                <div className="sign-up-wrapper sign-wrapper">
                    <div className="sign-content">
                        <div className="sign-up-intro sign-intro">
                            <h3>Sign Up</h3>
                            <h5> &#128161; Become our member to get extra benefits and surprise promotions!</h5>
                            {success ? <div className="success-noti"><i className="bi bi-check-circle"></i> {messageSU}</div> : <></>}
                            {!success && messageSU ? <div className="error-noti"><i className="bi bi-exclamation-circle"></i> {messageSU}</div> : <></>}
                        </div>

                        <div className="">
                            <form className="sign-up-box sign-box" id="sign-up-form" onSubmit={handleSubmit(onSubmit)}>
                                <div className="input-box">
                                    <input type="text" name="username" placeholder=" " {...register("username", { required: true })} />
                                    <label htmlFor="username">Username<span className="required">*</span></label>
                                </div>
                                {errors.username && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Username is required</div>}     

                                <div className="input-box">
                                    <input type="text" name="firstname" placeholder=" "  {...register("firstname", { required: true })}/>
                                    <label htmlFor="Firstname">First name<span className="required">*</span></label>
                                </div>
                                {errors.firstname && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> We need your name for better communication!</div>}
                                
                                <div className="input-box">
                                    <input type="text"  name="lastname" placeholder=" " {...register("lastname")} />
                                    <label htmlFor="lastname">Last name (optional)</label>
                                </div>

                                <div className="input-box">
                                    <input type="text"  name="phone" placeholder=" " {...register("phone", {required: true, pattern: /^\d{10,}$/g})} />
                                    <label htmlFor="phone">Phone<span className="required">*</span></label>
                                </div>
                                {errors.phone && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Phone must be at least 10 digits!</div>}

                                <div className="input-box">
                                    <input type="text" name="email" placeholder=" " {...register("email", {pattern: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/})} />
                                    <label htmlFor="email">Email (optional)</label>
                                </div>
                                {errors.email && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Email must in correct form!</div>}

                                <div className="input-box">
                                    <input type="text" name="address" placeholder=" " {...register("address")} />
                                    <label htmlFor="address">Address (optional)</label>
                                </div>

                                <div className="input-box"> 
                                    <input type="password" name="password" id="password" placeholder=" " 
                                     {...register("password", { required: true, pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*,.?&])[A-Za-z\d@$!%,.#^;:*?&]{8,}$/ })} />
                                    <label htmlFor="password">Password<span className="required">*</span></label>
                                    <div className="pass-icon bi bi-eye-slash-fill" onClick={revealPass}></div>
                                </div>    
                                {errors.password && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Password is absolutely needed!</div>}       
                                
                                <div className="password-requirements">
                                    <h4>For security, password must at least:</h4>
                                    <div>
                                        
                                        {pass_watch.match(/[A-Za-z\d\W]{8,}$/) ? <i class="bi bi-check-circle-fill"></i> :  <i className="bi bi-exclamation-circle-fill"></i>}
                                        <span>8 characters long.</span>
                                   </div>
                                   <div>
                                        {pass_watch.match(/(?=.*[A-Z])/) ? <i class="bi bi-check-circle-fill"></i> :  <i className="bi bi-exclamation-circle-fill"></i>}
                                        <span>1 uppercase letter (A-Z).</span>
                                   </div>
                                   <div>
                                        {pass_watch.match(/(?=.*[a-z])/) ? <i class="bi bi-check-circle-fill"></i> :  <i className="bi bi-exclamation-circle-fill"></i>}
                                        <span>1 lowercase letter (a-z).</span>
                                   </div>
                                   <div>
                                        {pass_watch.match(/(?=.*\d)/) ? <i class="bi bi-check-circle-fill"></i> :  <i className="bi bi-exclamation-circle-fill"></i>}
                                        <span>1 number  (0-9).</span>
                                   </div>
                                   <div>
                                        {pass_watch.match(/(?=.*[@$!%*?.#^;:,&])/) ? <i class="bi bi-check-circle-fill"></i> :  <i className="bi bi-exclamation-circle-fill"></i>}
                                        <span>1 special character (<span style={{fontWeight:"bold"}}>@$!%*#^;:?.,&</span>).</span>
                                   </div>
                                   <div>
                                        {pass_watch.match(/(?=.*["'<>(){}[|/])/) && <span><i className="bi bi-exclamation-circle-fill"></i> Detected unallowed character!</span>}
                                    </div>
                                </div>  

                                <div className="addition-box">
                                    <input type="checkbox" id="policy"  {...register("policy", {required:true})}/>
                                    <label className="addition" htmlFor="policy">By signing up, you accept our <a href="/" className="link">policy</a>.</label>  
                                               
                                </div>
                                {errors.policy && <div className=" error-small-noti " style={{marginTop:10 + 'px'}}><i className="bi bi-exclamation-circle"></i> Check this box!</div>}
                                                                                                    
                                <button>{loading ? <span>Loading</span> : <span>Sign Up</span> }</button>
                            </form>
                        </div>
                    </div>        
                </div>  
            </div>
      
        </>
    )
}