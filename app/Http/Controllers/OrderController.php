<?php
namespace App\Http\Controllers;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    public function index() {
        $orders = Checkout::with(['checkoutDetails.product.images'])
            ->where('user_id', Auth::id())
            ->latest()->paginate(10);
        return view('fronsite.orders', compact('orders'));
    }

    public function show($id) {
        $order = Checkout::with(['checkoutDetails.product.images'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('fronsite.order-detail', compact('order'));
    }
}
