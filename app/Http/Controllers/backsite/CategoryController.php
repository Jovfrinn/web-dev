<?php
namespace App\Http\Controllers\backsite;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories = Categories::withCount('products')->get();
        return view('backsite.categories', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate(['name_categories' => 'required|string|max:100|unique:categories']);
        Categories::create($request->only('name_categories'));
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $request->validate(['name_categories' => 'required|string|max:100']);
        Categories::findOrFail($id)->update($request->only('name_categories'));
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id) {
        Categories::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
