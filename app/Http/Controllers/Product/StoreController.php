<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $productImages = $data['product_images'];
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        $tagIds = $data['tags'];
        $colorIds = $data['colors'];
        unset($data['tags'], $data['colors'], $data['product_images']);

        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);

        foreach ($tagIds as $tagId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagId
            ]);
        }

        foreach ($colorIds as $colorId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorId
            ]);
        }

        foreach ($productImages as $productImage) {
            $currentImagesCount = ProductImage::where('product_id', $product->id)->count();

            if ($currentImagesCount > 3) continue;
            $filePath = Storage::disk('public')->put('/images', $productImage);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('product.index');
    }
}
