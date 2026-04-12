<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all(); // This is the way of copying the static products of ProductController

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|\Illuminate\Http\RedirectResponse // We are getting the ID from the URL
    {
        $viewData = [];
        try {
            $product = Product::findOrFail($id); // IDs start from 0 in real life, thats why we remove 1 to the current ID
            $viewData['title'] = $product['name'].' - Online Store';
            $viewData['subtitle'] = $product['name'].' - Product information';
            $viewData['product'] = $product;

            return view('product.show')->with('viewData', $viewData);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }

    }

    public function create(): View
    {
        $viewData = []; // to be sent to the view
        $viewData['title'] = 'Create product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse// Inject a request object from the petition made
    {
        $request->validate([ // Validate the request
            'name' => 'required',
            'price' => 'required | gt:0',
        ]);

        Product::create($request->only(['name', 'price']));

        return redirect()->route('product.success', ['name' => $request->input('name')]);
    }

    public function success(string $name): View
    {
        $viewData = [];
        $viewData['title'] = 'Success';
        $viewData['subtitle'] = 'Success creating the item '.$name;

        return view('product.success')->with('viewData', $viewData);
    }
}
