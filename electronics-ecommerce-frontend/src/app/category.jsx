import '../styles/category.scss'
import { Outlet } from "react-router-dom"
import { useParams } from "react-router-dom"
import { Link } from 'react-router-dom';
import BreadCrumb from './components/breadcrumb';
//import { useSearchParams } from "react-router-dom";
import { useEffect, useState } from 'react';
import Slider from '@mui/material/Slider';
import TextField from '@mui/material/TextField';
import InputAdornment from '@mui/material/InputAdornment';
import { useForm } from 'react-hook-form';
import { styled } from "@mui/material/styles";

const maximum = 6000, minimum = 0;
const minDistance = 300;

function valuetext(value) {
    return `$${value}`;
  }

export default function Category(){
    let params = useParams();
    let category_raw = params.categoryName;
    let product_id = params.productId ? params.productId : false;
    const [brand, setBrand] = useState([]);
    const [minPrice, setMinPrice] = useState(100);
    const [maxPrice, setMaxPrice] = useState(5000);

   const handleChange = (event, [minPrice, maxPrice], activeThumb) => {

    if (maxPrice - minPrice < minDistance) {
      if (activeThumb === 0) {
        const clamped = Math.min(minPrice, maximum - minDistance);
        setMinPrice(clamped);
        setMaxPrice(clamped + minDistance);
      } else {
        const clamped = Math.max(maxPrice, minDistance);
        setMinPrice(clamped - minDistance);
        setMaxPrice(clamped);
      }
    } else {
        setMinPrice(minPrice);
        setMaxPrice(maxPrice);
    }
  };
  
    return (
        <>
            <BreadCrumb/>
            <div className="category-wrapper">
                {!product_id && 
                    <div className='filter-container'>
                      
                        {/* <h3 className='filter-title'>
                            <button className='filter-submit-btn'>
                                Filter
                            </button>
                        </h3> */}

                        <div className='filter-box'>
                            <div className='filter-brand filter-item'>
                                <div className='filter-item-trigger '>Brands</div>
                                <div className='filter-popup'>
                                    <div>
                                        <BrandSelect category={category_raw} brand={brand} setBrand={setBrand}/>
                                    </div>                                
                                </div>
                            </div>
                            
                            <div className='filter-price filter-item'>
                                <div className='filter-item-trigger '>Price Range</div>
                                <div className='filter-popup'>
                                    <div className='price-container'>
                                        <div className='price-item'>
                                            <StyledTextField
                                                size='small'
                                                id="outlined-number"
                                                label="Min Price"
                                                type="number"
                                                value={minPrice}
                                                onChange={(e) => {setMinPrice(parseInt(e.target.value))}}
                                                InputLabelProps={{
                                                    shrink: true,}}
                                                InputProps={{
                                                    startAdornment: <InputAdornment 
                                                    sx={{
                                                        '& p':{
                                                        color: 'white'}
                                                    }}
                                                    position="start">$</InputAdornment>,
                                                    }}
                                            />
                                        </div>
                                        <div  className='price-item'>
                                            <div>
                                                <StyledTextField
                                                    size='small'
                                                    id="outlined-number"
                                                    label="Max Price"
                                                    type="number"
                                                    value={maxPrice}
                                                    onChange={(e) => {setMinPrice(parseInt(e.target.value))}}
                                                    InputLabelProps={{
                                                        shrink: true,
                                                    }}
                                                    InputProps={{
                                                        startAdornment: <InputAdornment  
                                                        sx={{
                                                            '& p':{
                                                            color: 'white'}
                                                        }}
                                                        position="start">$</InputAdornment>,
                                                    }}
                                                />
                                            </div>                            
                                        </div>
                                    </div>
                                    <div>
                                        <StyledSlider
                                            getAriaLabel={() => 'Minimum distance shift'}
                                            value={[minPrice,maxPrice]}
                                            min={minimum}  
                                            max={maximum}                      
                                            step={15}
                                            onChange={handleChange}
                                            valueLabelDisplay="auto"
                                            getAriaValueText={valuetext}
                                            disableSwap                                        
                                        />
                                    </div>
                                </div> 
                            </div> 

                        </div>        
                    </div>
                }
                {!product_id &&  <Outlet context={[category_raw, brand, minPrice, maxPrice]} />}
            </div>         
            {product_id &&  <Outlet/>}
        </>
    )
}

function BrandSelect({category, brand, setBrand}){

   const laptop_brand = [
    "apple","dell","lenovo","msi","hp","acer","asus","gigabyte","razer"
   ]
   const phone_brand = [
    "apple","huawei","lg","nokia","oppo","samsung","xiaomi"
   ]

   const tablet_brand = [
    "apple","huawei","samsung","xiaomi"
   ]


    function check(e){
        switch (e.currentTarget.checked){
            case true:
                e.currentTarget.parentNode.style.borderColor = "cyan";
                e.currentTarget.parentNode.style.boxShadow = "0 0 10px cyan";
                setBrand([
                    ...brand,
                    e.currentTarget.value
                ])
            break;

            case false:
                e.currentTarget.parentNode.style.borderColor = "transparent";
                e.currentTarget.parentNode.style.boxShadow = "";
                setBrand(
                    brand.filter((b) => b !== e.currentTarget.value)
                );
            break;
            
            default:    
            break;
        }
    }

    return(
        <>
            <div className="category-brand-select">
                {category === "laptop" && 
                    <div className="brand-box">
                        {laptop_brand.map((l) => {
                            return(
                                <label key={l} className='brand-item'>
                                <input type='checkbox' className='brand' onClick={(e) => {check(e)}} value={l}/>
                                <img src={require(`../resources/images/brand/${category}/${l}.png`)} alt="" />
                            </label>                                         
                            )
                        })}                       
                    </div> 
                }
                {category === "smartphone" && 
                    <div className="brand-box">
                         {phone_brand.map((l) => {
                            return(
                                <label key={l} className='brand-item'>
                                <input type='checkbox' className='brand' onClick={(e) => {check(e)}} value={l}/>
                                <img src={require(`../resources/images/brand/${category}/${l}.png`)} alt="" />
                            </label>                                         
                            )
                        })}          
                    </div> 
                }
                {category === "tablet" && 
                    <div className="brand-box">
                        {tablet_brand.map((l) => {
                            return(
                                <label key={l} className='brand-item'>
                                <input type='checkbox' className='brand' onClick={(e) => {check(e)}} value={l}/>
                                <img src={require(`../resources/images/brand/${category}/${l}.png`)} alt="" />
                            </label>                                         
                            )
                        })}          
                    </div> 
                }
            </div>  
        </>
    )
}



const StyledTextField = styled(TextField)({
    '& label': {
        color: 'white',
        fontWeight: 'bold'

      },
    '& label.Mui-focused': {
      color: 'white',
    },
    '& .MuiInput-underline:after': {
      borderBottomColor: '#B2BAC2',
    },
    '& .MuiOutlinedInput-root': {
        fontWeight: 'bold',
        color: 'white',
        padding: '3px 10px',
      '& fieldset': {
        borderColor: 'lightgrey',
      },
      '&:hover fieldset': {
        borderColor: 'white',
      },
      '&.Mui-focused fieldset': {
        borderColor: 'cyan',
      },
    },
  });

  const StyledSlider = styled(Slider)({
    '& span.MuiSlider-thumb ': {
        color: '#00ffff',
        '&:hover': {
            boxShadow: '0 0 0 8px #00ffff50',
        }
    },
    '& .MuiSlider-rail': {
        backgroundColor: 'white',
        opacity: '0.6'
    },
    '& .MuiSlider-track': {
        backgroundColor: '#00ffff'
    },
    '& .MuiSlider-valueLabel': {
        // transform : 'translateY(-100%) scale(1)',
        background : 'rgba(0, 0, 0, 0.7)',
        border: '1px solid lightgrey',

        '&:before': {
            borderBottom : '1px solid lightgrey',
            borderRight : '1px solid lightgrey',
        },
    },
    '& .MuiSlider-valueLabelLabel': {
        letterSpacing: '1px' ,
        color: 'white',
        fontWeight: 'bold'
    }
  })
