import '../../styles/banner.scss'
import { useEffect } from 'react';

export default function Banner(){

    /*Slider with CSS style */
    let slider, slider_images, iw;
   

    useEffect(() => {

        const cb = setInterval(() => {
            swipeRight();
          }, 6000);

        return () => clearInterval(cb);
        
    })
   
    function swipeLeft(){      
        slider = document.getElementById("slider");
        slider_images = document.getElementById("slider_wrapper").children.length;
        iw  = document.getElementById("1").offsetWidth;
        let slider_pos = slider.scrollLeft;
        slider.scrollLeft += -iw;
        if(slider_pos === 0){
            slider.scrollLeft += iw * (slider_images - 1);
        }

    }

    function swipeRight(){
        slider = document.getElementById("slider");
        slider_images = document.getElementById("slider_wrapper").children.length;
        iw  = document.getElementById("1").offsetWidth;
        let slider_pos = slider.scrollLeft;
        slider.scrollLeft += iw;     
        if(slider_pos === iw * (slider_images - 1)){
            slider.scrollLeft += -(iw * (slider_images - 1));
        }  
    }

    return (
        <>
            <div className="banner">
                <div className='banner-main-wrapper'>
                    <div className='banner-main' id="slider">
                        <div className='banner-main-container' id="slider_wrapper">
                            <a href="" id='1'><img src={require('../../resources/images/banner/banner-ip_14_pro.jpg')} alt="" /></a>
                            <a href="" id='2'><img src={require('../../resources/images/banner/galaxy-s23-ultra-highlights.jpg')} alt="" /></a>
                            <a href="" id='3'><img src={require('../../resources/images/banner/banner-apple_watch_ultra.jpg')} alt="" /></a>
                            <a href="" id='4'><img src={require('../../resources/images/banner/iPadPro.jpg')} alt="" /></a>
                        </div>    
                    </div>
                    
                    <button className="banner-btn banner-btn-left bi bi-caret-left-fill" onClick={swipeLeft}></button>
                    <button className="banner-btn banner-btn-right bi bi-caret-right-fill" onClick={swipeRight}></button>
                </div>
               

                <div className='banner-minor-top'>
                    <img src={require('../../resources/images/banner/banner-apple_watch.jpg')} alt="" />
                </div>

                <div className='banner-minor-bot'>
                    <img src={require('../../resources/images/banner/iPadPros.jpg')} alt="" />
                </div>
            </div>
        </>
    )
}