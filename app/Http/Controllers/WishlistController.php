<?php
namespace App\Http\Controllers;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller {
    public function index() {
        $wishlists = Wishlist::with('product.images')
            ->where('user_id', Auth::id())->latest()->get();
        return view('fronsite.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request, $productId) {
        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)->first();
        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed', 'message' => 'Dihapus dari wishlist']);
        } else {
            Wishlist::create(['user_id' => Auth::id(), 'product_id' => $productId]);
            return response()->json(['status' => 'added', 'message' => 'Ditambahkan ke wishlist']);
        }
    }

    public function destroy($id) {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari wishlist');
    }
}
