import Product from './Product';

const ShowProducts = ({ products, setCart, setIsOpenCart, csrfToken }) => {
    if (!products || products.length === 0) {
        return (
            <div className="text-center text-gray-600 p-10 text-xl">
                Keine Produkte gefunden.
            </div>
        );
    }

    return (
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 p-6">
            {products.map(product => (
                <Product
                    key={product.id}
                    product={product}
                    setCart={setCart}
                    setIsOpenCart={setIsOpenCart}
                    csrfToken={csrfToken}
                />
            ))}
        </div>
    );
};

export default ShowProducts;
