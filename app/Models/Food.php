<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ["name", "slug", "image", "price", "description", "category_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class);
    }
}
