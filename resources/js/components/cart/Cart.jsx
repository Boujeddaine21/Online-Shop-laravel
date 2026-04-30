import { useState } from "react";
import CartItem from "./CartItem";
import toast from "react-hot-toast";

const Cart = ({ cart, setCart, setIsOpenCart, csrfToken }) => {
    const [showCheckout, setShowCheckout] = useState(false);
    const [paymentMethod, setPaymentMethod] = useState('paypal');
    const [checkoutLoading, setCheckoutLoading] = useState(false);
    const [orderSuccess, setOrderSuccess] = useState(null);

    const total = cart.reduce(
        (sum, item) => sum + item.cartQty * item.price,
        0
    );

    // Cart leeren wenn leer
    if (cart.length === 0) {
        setIsOpenCart(false);
        return null;
    }

    const handleCheckout = async () => {
        setCheckoutLoading(true);
        try {
            const res = await fetch('/api/cart/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ payment_method: paymentMethod }),
            });

            const data = await res.json();

            if (res.ok) {
                setOrderSuccess(data.order_number);
                toast.success('Bestellung erfolgreich!');
            } else {
                toast.error(data.error || 'Bestellung fehlgeschlagen');
                setShowCheckout(false);
            }
        } catch (err) {
            toast.error('Netzwerkfehler');
            setShowCheckout(false);
        }
        setCheckoutLoading(false);
    };

    const closeSuccess = () => {
        setOrderSuccess(null);
        setShowCheckout(false);
        setCart([]);
        setIsOpenCart(false);
    };

    const paymentMethods = [
        { value: 'paypal', label: 'PayPal', icon: '💳' },
        { value: 'creditcard', label: 'Kreditkarte', icon: '💳' },
        { value: 'bank_transfer', label: 'Überweisung', icon: '🏦' },
    ];

    return (
        <div className="w-[30%] mt-21 self-start">
            <div className="bg-white rounded-xl text-black shadow-xl p-4 min-h-[100px] flex flex-col">
                <h2 className="text-xl font-bold mb-2 text-center">🛒 Warenkorb</h2>
                <ul className="space-y-3">
                    {cart.map((item, i) => (
                        <CartItem
                            key={item.id}
                            item={item}
                            setCart={setCart}
                            cart={cart}
                            i={i}
                            csrfToken={csrfToken}
                        />
                    ))}
                </ul>
                <div className="mt-6 pt-3 border-t flex justify-between items-center">
                    <p className="font-semibold">Summe:</p>
                    <span className="mr-4 font-bold text-lg text-teal-700">{total.toFixed(2)} €</span>
                </div>
                <div className="mt-4 pt-3 border-t">
                    <button
                        className="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 hover:cursor-pointer transition font-semibold"
                        onClick={() => setShowCheckout(true)}
                    >
                        Zur Kasse
                    </button>
                </div>
            </div>

            {/* Checkout Modal */}
            {showCheckout && (
                <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                    <div className="bg-white rounded-xl p-6 max-w-md w-full shadow-2xl">

                        {/* Erfolg */}
                        {orderSuccess ? (
                            <div className="text-center">
                                <div className="text-5xl mb-4">✅</div>
                                <h3 className="text-xl font-bold mb-2 text-green-700">Bestellung erfolgreich!</h3>
                                <p className="text-gray-600 mb-1">Deine Bestellnummer:</p>
                                <p className="font-mono font-bold text-lg mb-6">{orderSuccess}</p>
                                <button
                                    className="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 hover:cursor-pointer transition"
                                    onClick={closeSuccess}
                                >
                                    OK
                                </button>
                            </div>
                        ) : (
                            <>
                                <h3 className="text-xl font-bold mb-4 text-center">Bestellung bestätigen</h3>

                                {/* Produkte */}
                                <div className="space-y-2 mb-4 max-h-40 overflow-y-auto">
                                    {cart.map((item, i) => (
                                        <div key={i} className="flex justify-between text-sm">
                                            <span>{item.name} × {item.cartQty}</span>
                                            <span className="font-medium">{(item.cartQty * item.price).toFixed(2)} €</span>
                                        </div>
                                    ))}
                                </div>

                                <div className="border-t pt-3 flex justify-between font-bold text-lg">
                                    <span>Gesamt:</span>
                                    <span className="text-teal-700">{total.toFixed(2)} €</span>
                                </div>

                                {/* Zahlungsmethode */}
                                <div className="mt-4">
                                    <p className="font-semibold text-sm mb-2">Zahlungsmethode:</p>
                                    <div className="space-y-2">
                                        {paymentMethods.map(pm => (
                                            <label
                                                key={pm.value}
                                                className={`flex items-center gap-3 p-3 rounded-lg border-2 cursor-pointer transition ${
                                                    paymentMethod === pm.value
                                                        ? 'border-teal-500 bg-teal-50'
                                                        : 'border-gray-200 hover:border-gray-300'
                                                }`}
                                            >
                                                <input
                                                    type="radio"
                                                    name="payment"
                                                    value={pm.value}
                                                    checked={paymentMethod === pm.value}
                                                    onChange={(e) => setPaymentMethod(e.target.value)}
                                                    className="accent-teal-600"
                                                />
                                                <span>{pm.icon}</span>
                                                <span className="font-medium">{pm.label}</span>
                                            </label>
                                        ))}
                                    </div>
                                </div>

                                {/* Buttons */}
                                <div className="flex gap-3 mt-6">
                                    <button
                                        className="flex-1 bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 hover:cursor-pointer transition"
                                        onClick={() => setShowCheckout(false)}
                                        disabled={checkoutLoading}
                                    >
                                        Abbrechen
                                    </button>
                                    <button
                                        className="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 hover:cursor-pointer transition font-semibold disabled:opacity-50"
                                        onClick={handleCheckout}
                                        disabled={checkoutLoading}
                                    >
                                        {checkoutLoading ? 'Wird verarbeitet...' : 'Jetzt bestellen'}
                                    </button>
                                </div>
                            </>
                        )}
                    </div>
                </div>
            )}
        </div>
    );
};

export default Cart;
