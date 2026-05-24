<?php
namespace App\Http\Controllers\backsite;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index(Request $request) {
        $query = Checkout::with(['user', 'checkoutDetails.product']);
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }
        $orders = $query->latest()->paginate(15);
        return view('backsite.orders', compact('orders'));
    }

    public function show($id) {
        $order = Checkout::with(['user', 'checkoutDetails.product.images'])->findOrFail($id);
        return view('backsite.order-detail', compact('order'));
    }

    public function updateStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);
        $order = Checkout::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
