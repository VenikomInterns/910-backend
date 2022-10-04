<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;


class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        return Inertia::render('Products/index',compact('products'));
    }// loading all ? what if we have thousands of products

    public function show (Product $product): Response
    {
        return Inertia::render('Products/show',compact('product'));
    } // showing without the image?

    public function create(): Response
    {
        //should we send all categories here?
        return Inertia::render('Product/create');
    }// ok 


    public function edit(Product $product): Response
    {
        return Inertia::render('Products/edit',compact('product'));
    }//ok, should we send all categories here?

    public function update (Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price'=>'required',
            'description'=>'required'
        ]);
        $product->fill($validated);
        $product->save();

        return redirect()->back();
    }// ok Doesnt have ability to chnage category

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->back();
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'categoryId' => 'required', // what if user provides string or non existing category
            'name' => 'required',
            'price' => 'required', // what if user provides string 
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp' //good
        ]);

        unset($validated['image']);

        $product = new Product($validated);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filename = "app\public\images" . $filename;
            $img = Image::make($image)->resize(300, 300)->stream();
            Storage::put($filename, $img);
            $product->image = $filename;
        }
        //what if category is null?  since  category_id doesnt exist in $validated
        //why not ->save($product) but you are copying all the fields again
        Category::query()->find($validated['category_id'])->products()->create([
            'name' => $product->name,
            'price'=>$product->price,
            'description' => $product->description,
            'image' => $product->image
        ]);

        return Redirect::route("product.index");
    }
}
