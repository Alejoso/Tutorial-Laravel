<?php
namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::all();
        $cartProducts = [];
        $cartProductData = $request->session()->get('cart_product_data'); // We get the products stored in session stored in the key cart_product_data

        if ($cartProductData) {
            foreach (array_keys($cartProductData) as $key) { //array_keys gets only the keys on the array (As simple as it gets...)
                if (isset($products[$key])) { // isset is a secure way of looking if that key exists on the product array
                    $cartProducts[$key] = $products[$key]; // This is a dictionary with the keys of products, and the products as their value
                }
            }
        }

        $viewData = [];
        $viewData['products'] = $products;
        $viewData['cartProducts'] = $cartProducts;

        return view('cart.index')->with('viewData', $viewData);
    }
    public function add(string $id, Request $request): RedirectResponse
    {
        $cartProductData = $request->session()->get('cart_product_data');
        $cartProductData[$id] = $id; // Array of key and value as the same, like this: ['12' => '12', '50' => '50']
        $request->session()->put('cart_product_data', $cartProductData); // Put a product on the cart_product_data key
        
        return back();
    }
    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_product_data'); // Erease all the data from that key

        return back();
    }
}