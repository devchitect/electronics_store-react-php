import '../../styles/header.scss';

import logo from '../../resources/images/logo.png'
import { Link } from 'react-router-dom'; 
import { useEffect, useRef, useState } from 'react';
import { useContext } from 'react';
import { CategoryContext} from '../../context/context';
import { useSelector } from "react-redux";
import { scrollTop } from '../../App';
import { useDispatch } from 'react-redux';
import { signOut } from '../../redux-store/slice/auth-slice';
import { useForm } from 'react-hook-form';
import { host } from '../../App';

export default function Header(){
    const {register, handleSubmit, getValues, formState: {errors}, clearErrors} = useForm();
    const {userInfo} = useSelector((state) => state.auth)
    const {amount, total} = useSelector((state) => state.cart)
    const [searchResult, setSearchResult] = useState([]);
    const [message, setMessage] = useState();
    const ref = useRef(null);

    const categories = useContext(CategoryContext);
    const dispatch = useDispatch();

    useEffect(() => {

    },[userInfo])
  
    const handleSignOut = () => {
        dispatch(signOut());
    }


    //Searchbar for tablet, phone (responsive)
    function toggleSearch(){
        const searchBar = document.getElementById('header-form-searchbar');
        if(searchBar.classList.contains("dp-block")){
            searchBar.classList.add("dp-none");
            searchBar.classList.remove("dp-block");
            searchBar.style.display = "none";
        }else{
            searchBar.classList.add("dp-block");
            searchBar.classList.remove("dp-none");
            searchBar.style.display = "block";
        }
    }
    function closeSearch(){
        const searchBar = document.getElementById('header-form-searchbar');
        searchBar.classList.add("dp-none");
        searchBar.classList.remove("dp-block");
        searchBar.style.display = "none";
    }
    document.addEventListener("click", function(evt) {
        let el = document.getElementById('search-respon-btn'),
          targetEl = evt.target; // clicked element   
          if(targetEl !== el &&  !el.contains(targetEl)){
            if(window.screen.width < 1380){
                closeSearch();
            }
          }   
         
    });


    // Close Search if already active while clicking categorys
    function toggleCategories(){
        const navDropDown = document.getElementById('header-nav-dropdown');
        const overlay = document.getElementById('overlay-bg');

        if(navDropDown.classList.contains("dp-block")){
            navDropDown.classList.replace("dp-block","dp-none");
            navDropDown.style.display = "none";
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = "none";
        }else{
            navDropDown.classList.replace("dp-none","dp-block");
            navDropDown.style.display = "block";
            overlay.style.opacity = '1';
            overlay.style.pointerEvents = "initial";
        }
        
    }
    function closeCategories(){
        const navDropDown = document.getElementById('header-nav-dropdown');
        const overlay = document.getElementById('overlay-bg');
        navDropDown.classList.replace("dp-block","dp-none");
        navDropDown.style.display = "none";
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = "none";
    }
     document.addEventListener("click", function(evt) {
        let el = document.getElementById('header-nav'),
          targetEl = evt.target; // clicked element   
          if(targetEl !== el &&  !el.contains(targetEl)){
                closeCategories();
          }   
    });
    
    const Search = async({keyword, category}) => {
        try{
            const response = await fetch(`http://${host.name}:${host.port}/electronics-ecommerce-backend/API/product?search_by_keyword=${keyword}&category=${category}`,
            {
                method: "GET",
                headers:{ 
                    'Content-Type': 'application/json', 
                }, 
            });

            const data = await response.json();

            if(response.status === 200){
                console.log(data)
               setSearchResult(data);

               if(data.length === 0){
                throw new Error('No results found!');
               }

            }else{
                throw new Error('There is something wrong! check if the phone number correct!');
            }
        
        }catch(e){
            setMessage(e.message);
        }
    }

    const handleClickOutsideSearchBar = (event) => {
        if (ref.current && !ref.current.contains(event.target)) {
            setMessage();
            clearErrors();
            setSearchResult([]);
        }
    };
 

    useEffect(() => {
        document.addEventListener("click",handleClickOutsideSearchBar, true);
        return () => {
            document.removeEventListener('click', handleClickOutsideSearchBar, true);
        };
    })


    return (
        <>
        <header className='header'>
            <div className='header-wrapper'>

                <div className='header-left'>
                    <Link to="home" onClick={() => {scrollTop()}} className='header-logo-wrapper'><img src={logo} alt="" /></Link>

                    <button className='header-nav' id="header-nav" onClick={toggleCategories} >
                        <span className='header-nav-icon bi bi-list'></span>
                        <span className='header-nav-text'>Categories</span>
                    </button>
                </div>
                
                <form className='header-form' id='header-form' onSubmit={handleSubmit(Search)} ref={ref}>
                    <span className='header-form-searchbar' id='header-form-searchbar'>
                        <select className='header-form-dropdown' name="category" id="" {...register('category')}>
                            <option value=''>All Categories</option>
                            {categories.map(category => (
                                <option  key={category.id} value={category.id}>{category.name.charAt(0).toUpperCase() + category.name.slice(1)}</option>
                            ))
                            }
                        </select>
                        <input className='header-form-search' type="text" name='keyword' placeholder='Search here ...' {...register("keyword", {required: true})} 
                        onChange={() => {clearErrors(); setSearchResult([]); setMessage()}} />
                        <input type="submit" hidden />
                        <button className='header-form-button' type='submit'>
                            <span className="header-form-button-icon bi bi-search"></span>
                        </button>
                    </span>   
                            
                    {(errors.keyword) &&        
                        <div className='header-search-popup'>
                            <div className='header-search-popup-title'>
                                <h5 className='required'><i className='bi bi-exclamation-circle'></i> <span>Enter a keyword first!</span></h5>
                            </div>
                        </div>        
                    }                
                    {(message) &&        
                        <div className='header-search-popup'>
                            <div className='header-search-popup-title'>
                                <h5><i className='required bi bi-exclamation-circle'></i> <span>{message}</span></h5>
                            </div>
                        </div>        
                    }
                    {(searchResult && searchResult.length > 0) &&
                        <div className='header-search-popup'>
                            <div className='header-search-popup-title'>
                                <h5>Result(s) found: </h5>
                            </div>
                            {searchResult.map((i,index) => {

                                return(
                                <Link to={`/${i.category_name}/${i.product_id}`} className='link header-search-popup-card' key={index} onClick={() => {setSearchResult([])}}>
                                    <img src={`http://${host.name}:${host.port}/electronics-ecommerce-backend/resources/${i.overview_image}`} alt="" />
                                    <div className='header-search-popup-card-title'>
                                        <div>{i.name}</div>
                                    </div>
                                </Link>
                                )
                            })}
                        </div>
                    }
                </form>

                <div className='header-right'>
                    <div className='header-search-respon' id='search-respon-btn'><div className='header-sr-icon bi bi-search' onClick={() => {toggleSearch()}}></div></div>

                    <div className='header-user-wrapper'>
                        <Link to="/account/profile" className="header-user-icon bi bi-person-circle link" onClick={scrollTop}></Link>
                        <div className='header-user-content'>
                            <div className='header-user-title'>Account</div>
                            <div className='header-user-info'>
                                { userInfo && <Link className='link' to="account/profile">{userInfo.firstname}</Link>}
                                {!userInfo && <Link className='link' to="account/sign-in">Sign In</Link> }
                            </div>

                             { userInfo &&
                                <div className='user-info-toggle'>
                                    <div className='user-info-box'>
                                        <Link to="/account/profile" className='link user-info-link' onClick={scrollTop}>Profile</Link>
                                        <div onClick={() => {handleSignOut()}} className='link user-info-link'>Sign Out</div>
                                    </div>
                                </div>
                            }         
                        </div>
                    </div>
                    
                    <Link to="/cart" className='link header-cart-wrapper' onClick={scrollTop}>
                        <div className='header-cart-icon bi bi-basket'>
                            <div className='header-cart-quantity'>{amount}</div>
                        </div>
                        <div className='header-cart-content'>
                            <div className='header-cart-title'>Cart</div>
                            <div className='header-cart-price'>
                                <span>$</span>
                                <span>{total}</span>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>

            <div className='header-nav-dropdown dp-none' id='header-nav-dropdown'>
                <div className='nav-dropdown-wrapper'>
                    <div className='nav-dropdown'>

                        {categories.map((c,i) => (     
                            <div key={i} className='nav-dropdown-lists'> 
                                <Link to={`/${c.name}`} className={`nav-dropdown-list nav-dropdown-list-${i+1}`}>
                                    <span className="list-icon bi-arrow-right-short"></span>
                                    <span>{c.name.charAt(0).toUpperCase() + c.name.slice(1)}</span>
                                </Link>
                            </div>               
                        ))}
                    </div>
                    
                </div>               
            </div>

           
            

        </header>
        <div className='overlay' id='overlay-bg'></div>
        </>
    )
}

