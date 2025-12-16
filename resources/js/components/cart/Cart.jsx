import { useState } from "react";
import CartItem from "./CartItem";

const Cart = ({ cart, setCart, setIsOpenCart }) => {
    const total = cart.reduce(
        (sum, item) => sum + item.cartQty * item.price,
        0
    );
    const updateTotal = (index, newQty) => {
        const newCart = [...cart];
        newCart[index].cartQty = newQty;
        setCart(newCart);

        const sum = newCart.reduce((acc, item) => acc + (item.cartQty || 0) * item.price, 0);
        setTotal(sum.toFixed(2));
    };
    return (
        <div className="w-[30%] mt-21 self-start">
            <div className="bg-white rounded-xl text-black shadow-xl p-4 min-h-[100px] flex flex-col">
                <h2 className="text-xl font-bold mb-2 text-center">Warenkorb</h2>
                {cart.length === 0 ? (
                    <>
                        <p className="text-gray-600 text-center text-sm">Noch nichts im Warenkorb.</p>
                        {setIsOpenCart(false)}
                    </>
                ) : (
                    <ul className="space-y-3">
                        {cart.map((item, i) => <CartItem key={i}
                            item={item}
                            setCart={setCart}
                            cart={cart}
                            i={i}
                            updateTotal={updateTotal} />)
                        }
                    </ul>
                )}
                <div className="mt-20 pt-3 border-t flex justify-between items-center">
                    <p className="font-semibold">Sum : </p>
                    <span className="mr-12 font-semibold">{total.toFixed(2)} €</span>
                </div>
                <div className="mt-5 pt-3 border-t">
                    <button className="w-full bg-green-600 text-white py-2 rounded-lg">Pay</button>
                </div>
            </div>
        </div>
    )
}

export default Cart
