<?php

namespace App\Http\Controllers\API\Product;


use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }
}
