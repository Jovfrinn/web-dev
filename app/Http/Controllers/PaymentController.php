<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\shopping_cart;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
\Midtrans\Config::$serverKey = config('midtrans.serverKey');
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
    }

    public function createSnapToken()
    {
        $user = Auth::user();
        $checkout = Checkout::all()->last();

        $cartItems = shopping_cart::where('user_id', $user->id)->with(['product','product.images'])->get();
        $grossAmount = $checkout->grand_total;


    
        $itemDetails = []; 
        
        foreach ($cartItems as $item) {
            $itemDetails[] = [
                'id' => $item->product->id,
                'price' =>(int) $item->product->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name_product,
            ];
        }
        $params = [

            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $grossAmount
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        // dd($params);
            $snapToken = \Midtrans\Snap::getSnapToken($params);


          
            return response()->json([
                'token' => $snapToken,
                'name' => $user
            ]);
    }
}
