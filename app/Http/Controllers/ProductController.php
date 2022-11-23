<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class ProductController extends Controller
{
    //
    public $Product;

    function addProduct(Request $req)
    {

        // return $req->file('file')->store('products');
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store(('products')); //file_path is column in our database
        $product->save();
        return $product;
        // return $req->input();
    }

    function list(Request $req)
    {
        return Product::all();
    }

    function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return ["result" => "product has been deleted"];
        }
        else{
            return ["result"=>"Opreation failed"];
        }
        // return $id;
    }
}
