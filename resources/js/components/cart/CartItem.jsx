import React, { useState } from 'react'

const CartItem = ({ item, setCart, cart, i, updateTotal }) => {
    //const [quantity, setQuantity] = useState(1);
    const removeFromCart = (index) => {
        setCart(cart.filter((_, i) => i !== index));
        updateTotal(i, quantity);
    };

    const incrementQty = () => {
        setCart(prev =>
            prev.map((p, index) =>
                index === i
                    ? { ...p, cartQty: p.cartQty + 1 }
                    : p
            )
        );
    };

    const decrementQty = () => {
        if (item.cartQty > 1) {
            setCart(prev =>
                prev.map((p, index) =>
                    index === i
                        ? { ...p, cartQty: p.cartQty - 1 }
                        : p
                )
            );
        }
    };

    return (
        <li className="p-2 rounded bg-gray-100 shadow flex justify-between items-center">
            <span className="font-semibold">{item.name}</span>
            <div className='flex items-center gap-4'>
                <div className="flex items-center gap-2 w-24 justify-center">
                    <button onClick={decrementQty} className="px-2 bg-gray-300 rounded hover:bg-gray-400 hover:cursor-pointer">-</button>
                    <span className="px-2">{item.cartQty}</span>
                    <button onClick={incrementQty} className="px-2 bg-gray-300 rounded hover:bg-gray-400 hover:cursor-pointer">+</button>
                </div>
                <span className="font-semibold w-20 text-right">{(item.cartQty * item.price).toFixed(2)} €</span>
                <button onClick={() => removeFromCart(i)} className="text-red-600 font-bold ml-2 hover:cursor-pointer">✕</button>
            </div>
        </li>

    )
}
export default CartItem
