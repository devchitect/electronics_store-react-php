import "../../styles/nav.scss";
import { Link } from "react-router-dom";

export default function SimpleNav(){
    return (
        <>
            <div className="simple-nav">
                <div className="simple-nav-links">
                    <Link className="simple-nav-link" to="/home">Home</Link>
                    <Link to='/order-tracking' className="simple-nav-link">Order Tracking</Link>
                </div>  
                <div className="phone-wrap">
                    <Link className="phone" href="phone:012345678910"><i className="bi bi-telephone-forward-fill"></i> Hotline: 012345678910</Link>
                </div>
                <div className="email-wrap">
                    <Link className="email" href="mail:devchitect@gmail.com"><i className="bi bi-envelope-at"></i> dzungnguyen@devchitect.tech</Link>
                </div>
            </div>
        </>
    )
}