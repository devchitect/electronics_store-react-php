
import "../../styles/breadcrumb.scss"

import { useLocation, Link } from "react-router-dom";

export default function BreadCrumb(){
    const location = useLocation();
    
    let currentLink = '';
    const crumbs = location.pathname.split("/")
                            .filter((crumb) => crumb !== '')
                            .map((crumb) => {
                                currentLink += `/${crumb}`
                                return(
                                    <div className="crumb" key={crumb}>
                                        <Link to={currentLink} className="link">
                                            {crumb === 'cart' && <span>My </span>}
                                            {crumb.charAt(0).toUpperCase() + crumb.slice(1)}
                                        </Link>
                                    </div>
                                )
                            })

    return (
        <>
            <div className="breadcrumb">
                {crumbs}
            </div>
        </>
    )
}

