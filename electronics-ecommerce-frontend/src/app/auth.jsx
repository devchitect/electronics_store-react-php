import { useEffect } from "react";
import "../styles/auth.scss";
import { Outlet, Link, useLocation } from "react-router-dom";
import {scrollTop} from '../App'
import { useSelector } from "react-redux";

export default function Auth(){

    const {userInfo} = useSelector((state) => state.auth);
    const location = useLocation();
    const curentPath = location.pathname;

    function activeAuthBtn(e){
        deactiveAuthBtn();
        const el = e.target;
        el.style.background = "rgba(0, 0, 0, 0.8)";
        el.style.color = "cyan";
        el.style.transform = "scale(1.2)";
        el.style.textShadow = "0 0 10px cyan";
    }

    function deactiveAuthBtn(){
        document.querySelectorAll(".acc-btn").forEach((btn) => {
            btn.style.background = "lightgrey";
            btn.style.color = "black";
            btn.style.transform = "scale(1)";
            btn.style.textShadow = "initial";
        })    
    }

    useEffect(() => {
        scrollTop();

        if(!userInfo){
            //css button active
            if(curentPath === '/account/sign-up'){
                document.querySelector(".sign-up-btn").click();
            }else if(curentPath === '/account/sign-in'){
                document.querySelector(".sign-in-btn").click();
            }
        }else{
            if(curentPath === '/account/profile'){
                document.querySelector(".profile-btn").click();
            }else if(curentPath === '/account/orders'){
                document.querySelector(".orders-btn").click();
            }else if(curentPath === '/account/favorites'){
                document.querySelector(".favorites-btn").click();
            }
        }
    },[userInfo, curentPath])

    return(
        <>
            <div className="account-wrapper">
                <h3 className="account-title">Account</h3>
                {!userInfo &&
                <div className="account-navigate">
                    <Link onClick={(event) => {activeAuthBtn(event)}} className="acc-btn sign-in-btn" to="sign-in">Sign in</Link>
                    <Link onClick={(event) => {activeAuthBtn(event)}} className="acc-btn sign-up-btn" to="sign-up">Sign up</Link>
                </div>
                }
                 {userInfo &&
                <div className="account-navigate">
                    <Link onClick={(event) => {activeAuthBtn(event)}} className="acc-btn profile-btn" to="profile">Profile</Link>
                    <Link onClick={(event) => {activeAuthBtn(event)}} className="acc-btn orders-btn" to="orders">My Orders</Link>
                    <Link onClick={(event) => {activeAuthBtn(event)}} className="acc-btn favorites-btn" to="favorites">Favorites</Link>

                </div>
                }
                <Outlet context={userInfo}/>         
            </div>
        </>
    )
}