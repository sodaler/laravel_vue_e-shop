<?php

namespace App\Http\Controllers\API\Product;


use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Routing\Controller;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        return new ProductResource($product);
    }
}
