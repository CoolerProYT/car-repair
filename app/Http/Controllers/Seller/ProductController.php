<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product(){
        return view('seller.product');
    }

    public function addProduct(){
        return view('seller.add_product');
    }

    public function editProduct($id){
        $product = Product::where([
            'id' => $id,
            'seller_id' => auth()->guard('seller')->user()->id
        ])->exists();

        if(!$product) return redirect()->route('seller.product');

        return view('seller.edit_product',[
            'id' => $id
        ]);
    }
}
