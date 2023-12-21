<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        "employee_id", "quantity", "total_price",
        "total_received", "change", "payment_type", "payment_status"
    ];
    
    public function menus()
    {
        return $this->belongsToMany(Food::class);
    }

   
    public function employee()
    {
        return $this->belongsTo(employee::class);
    }
}
