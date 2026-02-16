<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

class ProductController extends Controller
{
    public static $products = [
        ["id"=>"1", "name"=>"TV", "description"=>"Best TV", "price"=>1200],
        ["id"=>"2", "name"=>"iPhone", "description"=>"Best iPhone", "price"=>1600],
        ["id"=>"3", "name"=>"Chromecast", "description"=>"Best Chromecast", "price"=>10],
        ["id"=>"4", "name"=>"Glasses", "description"=>"Best Glasses" , "price"=>100]
    ];


    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] =  "List of products";
        $viewData["products"] = ProductController::$products; // This is the way of copying the static products of ProductController
        return view('product.index')->with("viewData", $viewData);
    }


    public function show(string $id) : View | \Illuminate\Http\RedirectResponse // We are getting the ID from the URL
    {
        $viewData = [];
        try {
            $product = ProductController::$products[$id-1]; // IDs start from 0 in real life, thats why we remove 1 to the current ID
            $viewData["title"] = $product["name"]." - Online Store";
            $viewData["subtitle"] =  $product["name"]." - Product information";
            $viewData["product"] = $product;
            return view('product.show')->with("viewData", $viewData);
        }
        catch (Exception $e)
        {
            return redirect()->route('home.index');
        }
        
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData["title"] = "Create product";


        return view('product.create')->with("viewData",$viewData);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse// Inject a request object from the petition made
    {
        $request->validate([ // Validate the request
            "name" => "required",
            "price" => "required | gt:0"
        ]);
         // dd($request->all()); // Dump and die. Print the content and stop the execution

        //here will be the code to call the model and save it to the database

        return redirect()->route("product.success" , ['name'=> $request->input("name")] ); 
    }

    public function success(string $name): View
    {
        $viewData = [];
        $viewData["title"] = "Success";
        $viewData["subtitle"] =  "Success creating the item " . $name;
        return view('product.success')->with('viewData' , $viewData);
    }

}


