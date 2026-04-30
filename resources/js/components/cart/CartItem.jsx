import React from 'react'
import toast from 'react-hot-toast'

const CartItem = ({ item, setCart, cart, i, csrfToken }) => {
    const removeFromCart = async () => {
        try {
            await fetch(`/api/cart/remove/${item.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            });
            setCart(cart.filter((_, idx) => idx !== i));
        } catch (err) {
            toast.error('Fehler beim Entfernen');
        }
    };

    const updateQty = async (newQty) => {
        try {
            const res = await fetch(`/api/cart/update/${item.id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quantity: newQty }),
            });

            if (res.ok) {
                setCart(prev =>
                    prev.map((p, index) =>
                        index === i ? { ...p, cartQty: newQty } : p
                    )
                );
            } else {
                const data = await res.json();
                toast.error(data.error || 'Fehler');
            }
        } catch (err) {
            toast.error('Netzwerkfehler');
        }
    };

    const incrementQty = () => updateQty(item.cartQty + 1);
    const decrementQty = () => {
        if (item.cartQty > 1) updateQty(item.cartQty - 1);
    };

    return (
        <li className="p-2 rounded bg-gray-100 shadow flex justify-between items-center">
            <span className="font-semibold text-sm">{item.name}</span>
            <div className='flex items-center gap-4'>
                <div className="flex items-center gap-2 w-24 justify-center">
                    <button onClick={decrementQty} className="px-2 bg-gray-300 rounded hover:bg-gray-400 hover:cursor-pointer">-</button>
                    <span className="px-2">{item.cartQty}</span>
                    <button onClick={incrementQty} className="px-2 bg-gray-300 rounded hover:bg-gray-400 hover:cursor-pointer">+</button>
                </div>
                <span className="font-semibold w-20 text-right">{(item.cartQty * item.price).toFixed(2)} €</span>
                <button onClick={removeFromCart} className="text-red-600 font-bold ml-2 hover:cursor-pointer">✕</button>
            </div>
        </li>
    )
}
export default CartItem
