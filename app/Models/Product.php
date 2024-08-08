<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug;

//    protected $connection = "variationDb";
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function prices()
    {
        return $this->hasMany(ProductVariantPrice::class);
    }
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function productVariationOptions()
    {
        return $this->belongsToMany(Product::class, 'product_variation_price', 'product_id', 'variation_option_id')
            ->withPivot(['variant_id','variation_option_id', 'price', 'stock', 'sku']);
    }


    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


}
