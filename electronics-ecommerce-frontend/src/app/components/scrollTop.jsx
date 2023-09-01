import { useEffect } from "react"
import { scrollTop } from "../../App";

export default function ScrollTop(){

    useEffect(() => {
        window.onscroll = () => {
            if(window.scrollY > 300){
                document.getElementById("scrollTop").style.display = "flex";
            }else{
                document.getElementById("scrollTop").style.display = 'none';
            }
        }
    })

    return (
        <>
            <div className="scrollTop" id="scrollTop" onClick={() => {scrollTop()}}>
                <div className="bi bi-arrow-up-circle"></div>
            </div>
        </>
    )
}