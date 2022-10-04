<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();
        return Inertia::render('Categories/index',compact('categories'));
    }//excellent

    public function show (Category $category): Response
    {
        return Inertia::render('Categories/show',compact('category'));
    }//excellent

    public function create(): Response
    {
        return Inertia::render('Categories/create');
    }//excellent

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        Category::query()->create($validated);
        return redirect()->back();
    }//excellent

    public function edit(Category $category): Response
    {
        return Inertia::render('Categories/edit',compact('category'));
    }//excellent

    public function update (Category $category, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        $category->fill($validated);
        $category->save();

        return redirect()->back();
    }//excellent

    public function destroy(Category $category): RedirectResponse
    {
        //what happens with the products in this category?
        $category->delete();
        return redirect()->back();
    }
}
