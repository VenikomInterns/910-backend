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
    }

    public function show (Category $category): Response
    {
        return Inertia::render('Categories/show',compact('category'));
    }

    public function create(): Response
    {
        return Inertia::render('Categories/create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        Category::query()->create($validated);
        return redirect()->back();
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Categories/edit',compact('category'));
    }

    public function update (Category $category, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        $category->fill($validated);
        $category->save();

        return redirect()->back();
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->back();
    }
}
