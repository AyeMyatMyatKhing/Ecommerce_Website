<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductListResource;

class ProductController extends Controller
{
    public function index()
    {
        // $perPage = request('per_page' , 10);
        // $search = request('search' , '');
        // $sortField = request('sort_field' , 'created_at');
        // $sortDirection = request('sort_direction' , 'desc');

        // $query = Product::where('title' , 'like' , "%{$search}%")
        //         ->orderBy($sortField , $sortDirection)->paginate($perPage);
        $query = Product::all();
        
        return  ProductListResource::collection($query);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        
        $image = $request->image ?? null;
        if($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }
        $product = Product::create($data);
        return response()->json(['data' => $product]);
    }

    public function update(ProductRequest $request , Product $product)
    {
        $data = $request->all();
        $data['updated_by'] = $request->user()->id;
        $image = $data['image'] ?? null;
        if($image) {
            $filePath = $image->store('images' , 'public');
            $data['image'] = $filePath;
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            if($product->image) {
                Storage::delete('public/' . $product->image);
            }
        }

        $updatedProduct = $product->update($data);
        return response()->json(['data'=>$updatedProduct]);
    }

    public function destory(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'product delete successfully']);
    }

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }

}
