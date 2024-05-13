<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; 

use Illuminate\Validation\ValidationException;


class ProductController extends Controller
{
    
    public function index()
    {
        try {
            // $products = Product::all();
            $products = Product::where('user_id', Auth::id())->get();
            return view('product', compact('products'));
        } catch (ValidationException $e) {
            $products = [];
            return view('product', compact('products'));
        }
    }

    public function createpage()
    {
        return view('createproduct');
    }
    public function editpage()
    {
        return view('editprduct');
    }

    public function create(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_amount' => 'required|numeric|min:0',
            ]);

            $product = new Product;
            $product->user_id =  Auth::id();
            $product->product_name = $validatedData['product_name'];
            $product->product_amount = $validatedData['product_amount'];
            $product->save();

            return redirect()->route('productspages');
        } catch (ValidationException $e) {
            return back()->with('alert', true)->with('message', 'Please enter your product name and amount or invalid format');
        }
    }

    public function edit($id)
    {
        try {

            $productdata = Product::where('product_id', $id)->first();

            return view('editproduct', compact('productdata'));
        } catch (ValidationException $e) {
            return back()->with('alert', true)->with('message', 'Error while editing product');
        }
    }
    public function update(Request $request, Product $product)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_amount' => 'required|numeric|min:0',
            ]);
            $product->update($validatedData);
            return redirect()->route('productspages');
        } catch (ValidationException $e) {
            return back()->with('alert', true)->with('message', 'Error while update product');
        }
    }

    public function destroy($id)
    {
        try {

            $product = Product::find($id);

            if ($product) {
                $product->delete(); // Soft delete the product
                return redirect()->route('productspages');
            } else {
                return back()->with('alert', true)->with('message', 'Product not found');
            }
        } catch (ValidationException $e) {
            return back()->with('alert', true)->with('message', 'Error while delete product');
        }
    }
}
