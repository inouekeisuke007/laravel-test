<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function createProduct($data)
    {
        $product = new Product;
        $product->company_id = $data['company_id'];
        $product->product_name = $data['product_name'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->comment = $data['comment'];

        if (isset($data['image_path'])) {
            $image = $data['image_path'];
            $imagePath = $image->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return $product;
    }
    
    public function getProduct($productId)
    {
        return $this->find($productId);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function updateProduct($id, $data)
    {
        $product = $this->findOrFail($id);

        $product->company_id = $data['company_id'];
        $product->product_name = $data['product_name'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->comment = $data['comment'];

        if (isset($data['image_path'])) {
            $image = $data['image_path'];
            $imagePath = $image->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return $product;
    }
}
