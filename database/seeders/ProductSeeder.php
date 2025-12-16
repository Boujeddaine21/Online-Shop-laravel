<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Categorie;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $categorie = Categorie::factory(4)->create();

        $products = Product::factory(100)->create();

        Order::factory(20)->create()->each(function ($order) use ($products) {
            // zufällige Anzahl Produkte auswählen
            $randomProducts = $products->random(rand(1, 5));

            $summe = 0;

            foreach ($randomProducts as $product) {
                $price = $product->price;
                $quantity = rand(1, 4);
                $total = $price * $quantity;

                $order->product()->attach($product->id, [
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $total
                ]);

                $summe += $total;
            }
            $order->update([
                'total' => $summe
            ]);
        });

        $users = User::has('order')->get();

        foreach ($users as $user) {

            $cart = Cart::create([
                'user_id' => $user->id,
                'session_id' => Str::uuid(),
            ]);

            $cartProducts = $products->random(rand(1, 5));

            foreach ($cartProducts as $product) {
                $cart->product()->attach($product->id, [
                    'quantity' => fake()->numberBetween(1, 4),
                ]);
            }
        }

    }
}
