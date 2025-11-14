<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','description', 'qty', 'image','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id');
    }

    public function scopeFilterByName($query, $name)
    {
        return $query->when($name, fn($q) => $q->where('name', 'like', '%' . $name . '%'));
    }

    public function scopeFilterByQtyMin($query, $qty)
    {
        return $query->when($qty, fn($q) => $q->where('qty', '>=', $qty));
    }

    public function scopeFilterByPriceMin($query, $price)
    {
        return $query->when($price, fn($q) => $q->where('price', '>=', $price));
    }

    public function scopeFilterByPriceMax($query, $price)
    {
        return $query->when($price, fn($q) => $q->where('price', '<=', $price));
    }

    public function scopeFilterByCategory($query, $category_id)
    {
        return $query->when($category_id, fn($q) => $q->where('category_id', $category_id));
    }

    public function scopeSortByName($query, $order)
    {
        return $query->when($order, fn($q) => $q->orderBy('name', $order));
    }

    public function scopeSortByPrice($query, $order)
    {
        return $query->when($order, fn($q) => $q->orderBy('price', $order));
    }

    public function scopeSortByQty($query, $order)
    {
        return $query->when($order, fn($q) => $q->orderBy('qty', $order));
    }

    public function scopeSortByCreatedAt($query, $order)
    {
        return $query->when($order, fn($q) => $q->orderBy('created_at', $order));
    }
}
