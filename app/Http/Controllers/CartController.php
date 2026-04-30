<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * GET /api/cart – Cart des eingeloggten Users laden
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $products = $cart->products()->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $product->quantity,
                'cartQty' => $product->pivot->quantity,
            ];
        });

        return response()->json(['cart' => $products]);
    }

    /**
     * POST /api/cart/add – Produkt zum Cart hinzufügen
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ], [
            'session_id' => session()->getId(),
        ]);

        $product = Product::findOrFail($request->product_id);

        // Prüfe ob Produkt schon im Cart
        $existing = $cart->products()->where('product_id', $product->id)->first();

        if ($existing) {
            // Menge erhöhen
            $newQty = $existing->pivot->quantity + 1;
            if ($newQty > $product->quantity) {
                return response()->json(['error' => 'Nicht genug auf Lager'], 422);
            }
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $newQty]);
        } else {
            if ($product->quantity < 1) {
                return response()->json(['error' => 'Produkt nicht verfügbar'], 422);
            }
            $cart->products()->attach($product->id, ['quantity' => 1]);
        }

        return response()->json(['success' => true, 'message' => 'Produkt hinzugefügt']);
    }

    /**
     * PATCH /api/cart/update/{product} – Menge ändern
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart nicht gefunden'], 404);
        }

        if ($request->quantity > $product->quantity) {
            return response()->json(['error' => 'Nicht genug auf Lager'], 422);
        }

        $cart->products()->updateExistingPivot($product->id, [
            'quantity' => $request->quantity,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * DELETE /api/cart/remove/{product} – Produkt entfernen
     */
    public function remove(Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if ($cart) {
            $cart->products()->detach($product->id);
        }

        return response()->json(['success' => true]);
    }

    /**
     * POST /api/cart/checkout – Bestellung erstellen
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:paypal,creditcard,bank_transfer',
            'shipping_street' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->products()->count() === 0) {
            return response()->json(['error' => 'Cart ist leer'], 422);
        }

        try {
            DB::beginTransaction();

            $cartProducts = $cart->products()->get();
            $orderTotal = 0;

            // Lagerbestand prüfen
            foreach ($cartProducts as $product) {
                if ($product->pivot->quantity > $product->quantity) {
                    DB::rollBack();
                    return response()->json([
                        'error' => "Nicht genug '{$product->name}' auf Lager"
                    ], 422);
                }
                $orderTotal += $product->pivot->quantity * $product->price;
            }

            // Order erstellen
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total' => $orderTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_street' => $request->shipping_street,
                'shipping_city' => $request->shipping_city,
                'shipping_zip' => $request->shipping_zip,
                'shipping_country' => $request->shipping_country,
            ]);

            // Order-Products hinzufügen + Lagerbestand reduzieren
            foreach ($cartProducts as $product) {
                $qty = $product->pivot->quantity;
                $lineTotal = $qty * $product->price;

                $order->product()->attach($product->id, [
                    'price' => $product->price,
                    'quantity' => $qty,
                    'total' => $lineTotal,
                ]);

                // Lagerbestand reduzieren
                $product->decrement('quantity', $qty);
            }

            // Cart leeren
            $cart->products()->detach();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Bestellung erfolgreich erstellt!',
                'order_number' => $order->order_number,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Bestellung fehlgeschlagen: ' . $e->getMessage()], 500);
        }
    }
}
