<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories= Category::query()
            ->with('product','image')
            ->paginate(10);

        return JsonResource::collection($categories);
    }

}
