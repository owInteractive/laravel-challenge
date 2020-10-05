import React, { useEffect } from 'react'
import './NorFound.scss';
import { useHistory } from "react-router-dom";
import {
    Link,
} from 'react-router-dom';

const Notfound = props => {
    let history = useHistory();

    return (
        <div className='not-found'>
            <p>404</p>
            {!props.isLoggedIn ? <Link to="/signin">Go to sign in page</Link> : <Link to="/events">Go to events page</Link>}
        </div>
    );
};



export default Notfound;
