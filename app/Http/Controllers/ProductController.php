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
    }

    public function show (Product $product): Response
    {
        return Inertia::render('Products/show',compact('product'));
    }

    public function create(): Response
    {
        return Inertia::render('Product/create');
    }


    public function edit(Product $product): Response
    {
        return Inertia::render('Products/edit',compact('product'));
    }

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
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->back();
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'categoryId' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp'
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

        Category::query()->find($validated['category_id'])->products()->create([
            'name' => $product->name,
            'price'=>$product->price,
            'description' => $product->description,
            'image' => $product->image
        ]);

        return Redirect::route("product.index");
    }
}
