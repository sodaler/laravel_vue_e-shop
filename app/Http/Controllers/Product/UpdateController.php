<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        }

        if (isset($data['tags'])) {
            $tagIds = $data['tags'];
            unset($data['tags']);
        }

        if (isset($data['colors'])) {
            $colorIds = $data['colors'];
            unset($data['colors']);
        }

        if (isset($tagIds)) {
            $product->tags()->sync($tagIds);
        }

        if (isset($colorIds)) {
            $product->colors()->sync($colorIds);
        }

        $product->update($data);

        return view('product.show', compact('product'));
    }
}
