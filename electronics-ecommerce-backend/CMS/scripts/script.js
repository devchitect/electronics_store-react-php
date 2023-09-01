
//Navbar toggle
//toggle for products
const productToggle = document.querySelector(".product-dropdown-btn");
const productIcon = document.querySelector(".product-dropdown-icon");
const productDropdown = document.querySelector(".product-dropdown");

productToggle.addEventListener("click",function(){

    if (productDropdown.style.maxHeight){
        productDropdown.style.maxHeight = null;
        productIcon.classList.replace("bi-caret-down-fill","bi-caret-right-fill");
      } else {
        productDropdown.style.maxHeight = productDropdown.scrollHeight + "px";
        productIcon.classList.replace("bi-caret-right-fill","bi-caret-down-fill");
      } 

})

//toggle for customers

const customerToggle = document.querySelector(".customer-dropdown-btn");
const customerIcon = document.querySelector(".customer-dropdown-icon");
const customerDropdown = document.querySelector(".customer-dropdown");

customerToggle.addEventListener("click",function(){
   
    if (customerDropdown.style.maxHeight){
        customerDropdown.style.maxHeight = null;
        customerIcon.classList.replace("bi-caret-down-fill","bi-caret-right-fill");
      } else {
        customerDropdown.style.maxHeight = customerDropdown.scrollHeight + "px";
        customerIcon.classList.replace("bi-caret-right-fill","bi-caret-down-fill");
      } 
})
