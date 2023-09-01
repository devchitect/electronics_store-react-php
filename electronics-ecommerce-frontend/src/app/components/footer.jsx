import logo from '../../resources/images/logo.png'
import '../../styles/footer.scss'
import {Link} from 'react-router-dom'

export default function Footer(){
    return (
        <footer className='footer'>
            <div className='footer-wrapper'>
                <div className='footer-top'>
                    <div className='footer-intro'>
                        <div className='footer-intro-upper'>
                            <div className='footer-logo'>
                                <img src={logo} alt="" />
                            </div>
                            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                        </div>
                        <div className='footer-intro-lower'>
                            <div className='bi bi-headset'></div>
                            <div>
                                <span>Support</span>
                                <a href="tel:0123456789">0123 456 789</a>
                            </div>    
                        </div>
                    </div>

                    <div className='footer-etc'>
                        <div className='footer-link'>
                            <h5>Links</h5>
                            <ul>
                                <li>
                                    <Link className='link'>About us</Link>
                                </li>
                                <li>
                                    <Link className='link'>Blog</Link>
                                </li>
                                <li>
                                    <Link className='link'>Policy</Link>
                                </li>
                                <li>
                                    <Link className='link'>Career</Link>
                                </li>
                            </ul>
                        </div>
                        <div className='footer-service'>
                            <h5>Customer Service</h5>
                            <ul>
                                <li>
                                    <Link className='link'>Payments</Link>
                                </li>
                                <li>
                                    <Link className='link'>Shipping</Link>
                                </li>
                                <li>
                                    <Link className='link'>Order Tracking</Link>
                                </li>
                            </ul>
                        </div>
                        <div className='footer-newsletter'>
                            <h5>Newsletter</h5>
                            <h6>Register to get update on promotion and news.</h6>
                            <form action="">
                                <div className='subscribe-box'>
                                    <input type="text" placeholder="Your email" required/>
                                    <div className='subscribe-btn-box'>
                                        <button className='subscribe-btn'>Subscribe</button>
                                    </div>
                                </div>
                            <h6>By subscribing, you accept our <Link className='link'>prolicy</Link>.</h6>
                            </form>
                        </div>
                    </div>
                </div>
                    
                <div className='footer-bot'>
                    <div>&copy; 2023 by Devchitect.</div>
                    <div className='footer-payment'>
                        <img src={require('../../resources/images/payment/mastercard.png')} alt="" />
                        <img src={require('../../resources/images/payment/paypal.png')} alt="" />
                        <img src={require('../../resources/images/payment/visa.png')} alt="" />
                        <img src={require('../../resources/images/payment/stripe.png')} alt="" />
                    </div>
                    <div className='footer-social'>
                        <a href="/" className='bi bi-facebook'></a>
                        <a href="/" className='bi bi-messenger'></a>
                        <a href="/" className='bi bi-instagram'></a>
                    </div>
                </div>
            </div>          
        </footer>
    )
}