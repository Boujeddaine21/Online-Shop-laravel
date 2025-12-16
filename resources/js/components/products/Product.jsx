import React from 'react';
import toast, { Toaster } from 'react-hot-toast';

const Product = ({ product, setCart, setIsOpenCart }) => {
    return (
        <div className="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300
                p-4 cursor-pointer transform hover:-translate-y-1 w-full max-w-[220px] flex flex-col">

            <div className="w-full h-32 flex items-center justify-center bg-gray-50 rounded-md overflow-hidden">
                <img
                    src={`/images/${product.image}`}
                    alt={product.name}
                    className="object-contain h-full"
                />
            </div>
            <h2 className="mt-3 text-sm font-semibold text-gray-800 truncate">
                {product.name}
            </h2>
            <div className="flex flex-col mt-1 flex-1">
                <p className="text-xs text-gray-600 line-clamp-2 flex-1">
                    {product.description || '\u00A0'}
                </p>
                <span className="text-lg font-bold text-teal-600 mt-3">
                    {product.price} €
                </span>
                <button className="mt-2 w-full bg-teal-600 hover:bg-teal-700 text-white py-1.5 text-sm rounded-md font-medium transition"
                    onClick={() => {
                        toast.success('Product added to your Cart');
                        setCart(prev => [...prev, {...product, cartQty: 1}]);
                        setIsOpenCart(true)
                    }}>Add to Cart
                </button>
            </div>
        </div>

    );
};

export default Product;
