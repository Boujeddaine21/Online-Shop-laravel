import React from 'react';
import ReactDOM from 'react-dom/client';
import Shop from './products/Shop';
import toast, { Toaster } from 'react-hot-toast';


if (document.getElementById('react-product-user')) {
    const Index = ReactDOM.createRoot(document.getElementById("react-product-user"));

    Index.render(
        <React.StrictMode>
            <Toaster position="top-right" reverseOrder={true}/>
            <Shop />
        </React.StrictMode>
    )
}
