import "../styles/si-su.scss"

import { useForm } from "react-hook-form"
import { signIn, resetMessage } from "../redux-store/slice/auth-slice";
import { useSelector, useDispatch } from "react-redux";
import { useEffect, useState } from "react";
import { Navigate, useNavigate, useOutletContext } from "react-router-dom";
import { scrollTop } from "../App";

export default function Signin(){
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const userInfo = useOutletContext();
    const {loading, messageSI} = useSelector((state) => state.auth);
    const {register, handleSubmit, formState: {errors} } = useForm();
    const [captcha, setCaptcha] = useState("");

    const onSubmit = (data) => {
        scrollTop();
        dispatch(signIn(data));
    }

   
    useEffect(() => {
        scrollTop();
        dispatch(resetMessage());
        generateCaptcha();
        
    },[navigate, dispatch])
    

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

    function generateCaptcha(){
        let value  = btoa(Math.random()*123456);
        value = value.substring(0, 5);
        setCaptcha(value);
    }

    if(userInfo){
        return <Navigate to="/account/profile" />
     }
    return(
        <>
            <div className="sign-in sign">
                <div className="sign-in-wrapper sign-wrapper">
                    <div className="sign-content">
                        <div className="sign-in-intro sign-intro">
                            <h3>Sign in</h3>
                            <h5>&#x1F44B; Already our member?! Sign in now!</h5>
                            {!loading && messageSI ? <div className="error-noti"><i className="bi bi-exclamation-circle"></i> {messageSI}</div> : <></>}
                        </div>

                        <div className="">
                            <form className="sign-in-box sign-box" action="" onSubmit={handleSubmit(onSubmit)}>
                                <div className="input-box">
                                    <input className="username" type="text" name="username" {...register("username", {required: true})} placeholder=" " />
                                    <label htmlFor="username">Username</label>
                                </div>
                                {errors.username && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Fill the field first!</div>}

                                <div className="input-box"> 
                                    <input type="password" name="password" id="password" {...register("password", {required: true})} placeholder=" " />
                                    <label htmlFor="password">Password</label>
                                    <div className="pass-icon bi bi-eye-slash-fill" onClick={revealPass}></div>
                                </div>
                                {errors.password && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Fill the field first!</div>}

                                <div className="pass-option">
                                    <div>
                                        <input type="checkbox" id="save-pass" {...register("savepass")}/>
                                        <label className="save-pass-label" htmlFor="save-pass">Remember password</label>            
                                    </div>
                                    <a href="/">Forget password ?</a>
                                </div>

                                <div className="captcha">                                             
                                    <div className="captcha-wrapper">
                                        <Captcha captcha={captcha}/>
                                        <div className="captcha-reset-btn bi bi-arrow-counterclockwise" onClick={() => {generateCaptcha()}}/>
                                    </div>
                                </div>
                                <div className="input-box">
                                    <input type="text" name="captcha" id="password" {...register("captcha", {required: true , pattern: new RegExp(`${captcha}`)})} placeholder=" " autoComplete="off" />
                                    <label>Captcha<span className="required">*</span></label>            
                                </div>
                                {errors.captcha && <div className=" error-small-noti "><i className="bi bi-exclamation-circle"></i> Captcha not matched!</div>}

                            
                                <button>{loading ? <span>Loading</span> : <span>Sign In</span> }</button>
                            </form>
                        </div>
                    </div>                      
                </div>  
            </div>
        </>
    )
}

function Captcha(captcha){
    const c = captcha.captcha;
    const font_style = ["cursive","sans-serif","serif","monospace"];
  
    return (
        <div className="captcha-box">
            {c.split("").map((char,i) => {
                let degree = -20 + Math.trunc(Math.random()*69);
                let random_font = Math.trunc(Math.random()*font_style.length);
                return (
                    <div key={i} className="captcha-char" style={{transform: `rotate(${degree}deg)`, fontFamily:`${font_style[random_font]}` }}>
                        {char}
                    </div>
            )})}
        </div>
       
    )
   
}
