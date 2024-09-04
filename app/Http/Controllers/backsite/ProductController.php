<?php

namespace App\Http\Controllers\backsite;

use App\Http\Controllers\Controller;
use App\Models\ImagesProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'asc')->with('images')->get();

        $data['products'] = $product;

        return view('backsite.product', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

       $data_product = Product::create([
        'name_product' => $request->name_product,
        'description_product' => $request->description_product,
        'price' => $request->price,
        'stock' => $request->stock,
        'category_id' => $request->category_id,
       ]);

            
       if($request->hasFile('image')) {
        $isFirstImage = true;
           foreach($request->file('image') as $image){
               $filename = $image->getClientOriginalName();
                $image->move(public_path('assets/img'), $filename);
                ImagesProduct::create([
                    'imageName' => $filename,
                    'is_thumb' => $isFirstImage ? 1 : 0,
                    'id_product' => $data_product->id,
                ]);
                $isFirstImage = false;
            }
            }
        
        return redirect()->route('get.product.backsite')->with('success', 'Produk berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $data['product'] = $product;
        /*
            select * from role where id = 6
        */

        return view('backsite.edit-product', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name_product' => 'required|string|max:255',
        //     'description_product' => 'required|string',
        //     'price' => 'required|numeric',
        //     'stock' => 'required|integer',
        //     'category_id' => 'required|integer',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $product = Product::findOrFail($id);
        // dd($request->hasFile('image'));

        // Update data product
        $product->update([
            'name_product' =>$request->name_product,
            'description_product'=>$request->description_product,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'category_id'=>$request->category_id
        ]);

        if($request->hasFile('image')){
            // dd($product->images);
            foreach($product->images as $image){
            if($image->id_product == $id){
                $oldImagePath = public_path('assets/img'. $image->imageName);
                if(file_exists($oldImagePath)){
                    unLink($oldImagePath);
                }
                $image->delete();
            }}
            $isFirstImage = true;
            foreach ($request->file('image') as $image){
                // dd('kontol semua');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('assets/img'), $filename);
            ImagesProduct::create([
                'imageName' => $filename,
                    'is_thumb' => $isFirstImage ? 1 : 0,
                    'id_product' => $product->id,
            ]);
            $isFirstImage = false;
        }
        }
             return redirect()->route('get.product.backsite')->with('success', 'Produk Berhasil di Update');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        foreach($product->images as $image){
            if($image->id_product == $id){
                $oldImagePath = public_path('assets/img'. $image->imageName);
                if(file_exists($oldImagePath)){
                    unLink($oldImagePath);
                }
                $image->delete();
            }}

        $product->delete();
        return redirect()->route('get.product.backsite')->with('success', 'Berita delete succesfully');
    }
}
