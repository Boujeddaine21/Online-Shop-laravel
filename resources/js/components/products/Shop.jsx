import React, { useEffect, useState } from 'react'
import BeatLoader from "react-spinners/BeatLoader";
import ShowProducts from './ShowProducts';
import Cart from '../cart/Cart';

const Shop = () => {
    const root = document.getElementById('react-product-user');
    const categorieId = root.dataset.categorieId;

    const [loading, setLoading] = useState(false);
    const [products, setProducts] = useState([]);
    const [categorieName, setCategorieName] = useState('');
    const [errorMessage, setErrorMessage] = useState('');
    const [cart, setCart] = useState([]);
    const [isOpenCart, setIsOpenCart] = useState(false);

    // CSRF-Token für fetch-Requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Cart beim Mount von API laden
    useEffect(() => {
        const loadCart = async () => {
            try {
                const res = await fetch('/api/cart');
                if (res.ok) {
                    const data = await res.json();
                    if (data.cart && data.cart.length > 0) {
                        setCart(data.cart);
                        setIsOpenCart(true);
                    }
                }
            } catch (err) {
                console.error('Cart laden fehlgeschlagen:', err);
            }
        };
        loadCart();
    }, []);

    // Produkte laden
    useEffect(() => {
        const loadProducts = async () => {
            try {
                setLoading(true);
                const res = await fetch(`/shop/categorie/${categorieId}`);
                if (res.ok) {
                    const data = await res.json();
                    setProducts(data.products);
                    setCategorieName(data.name);
                } else {
                    setErrorMessage("Kategorie nicht gefunden");
                }
            } catch (err) {
                setErrorMessage("Netzwerkfehler");
            }
            setLoading(false);
        }
        loadProducts();
    }, [categorieId]);

    return (
        <>
            <div className="flex min-h-screen">
                <div className={`${isOpenCart ? "w-[70%]" : "w-full"} transition-all duration-300`}>
                    <h1 className="text-3xl font-bold text-gray-300 mb-6 ml-7">{categorieName}</h1>

                    {loading && <BeatLoader color="#ffffff" />}
                    {errorMessage && <p className="text-red-400 ml-7">{errorMessage}</p>}
                    {!loading && products && (
                        <ShowProducts
                            products={products}
                            setCart={setCart}
                            setIsOpenCart={setIsOpenCart}
                            csrfToken={csrfToken}
                        />
                    )}
                </div>

                {isOpenCart && (
                    <Cart
                        cart={cart}
                        setCart={setCart}
                        setIsOpenCart={setIsOpenCart}
                        csrfToken={csrfToken}
                    />
                )}
            </div>
        </>
    )
}

export default Shop
