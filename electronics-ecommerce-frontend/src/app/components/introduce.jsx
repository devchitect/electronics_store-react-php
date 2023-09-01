import '../../styles/introduce.scss';

export default function Introduce(){
    return (
        <>
            <div className="introduce">
                <div className='introduce-content'>
                    <div className="introduce-icon bi bi-rocket-takeoff"></div>
                    <div>
                        <h5>Free Shipping</h5>
                        <h6>For all order over $300</h6>
                    </div>
                </div>
                <div className='introduce-content'>
                    <div className="introduce-icon bi bi-lightning"></div>
                    <div>
                        <h5>Special Offers</h5>
                        <h6>Discount up to 50%</h6>
                    </div>
                </div>
                <div className='introduce-content'>
                    <div className="introduce-icon bi bi-shield-check"></div>
                    <div>
                        <h5>100% Secure</h5>
                        <h6>Secure Payments</h6>
                    </div>
                </div>
                <div className='introduce-content'>
                    <div className="introduce-icon bi bi-stopwatch"></div>
                    <div>
                        <h5>Quality Support</h5>
                        <h6>Anytime anywhere</h6>
                    </div>
                </div>
            </div>
        </>
    )
}