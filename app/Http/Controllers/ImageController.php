<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;

class ImageController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        $images = Image::all();
        return Inertia::render('Image/index', compact('images', 'products'));
    }

    public function show(Image $image): Response
    {
        return Inertia::render('Image/Show', compact('image'));
    }

    public function create(): Response
    {
        $products = Product::all();
        return Inertia::render('Image/Create', compact('products'));
    }

    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp',
            'product_id' => 'required',
        ]);

//
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/', $name);

        }
        $image = new Image();
        $image->name = $name;
        $image->url = 'http://127.0.0.1:5173/storage/app/public/images/%27.$name';
        $image->product_id = $validated['productId'];
        $image->save();

        return redirect('images');

    }

    public function destroy(Image $image): RedirectResponse
    {
        $path = storage_path() . '/app/public/images/' . $image->name;
        if (File::exists($path)) {
            File::delete($path);
        }
        $image->delete();
        return redirect()->back();
    }
}

