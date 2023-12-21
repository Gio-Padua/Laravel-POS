<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
    ];
  
    
    public function getAuthPassword()
    {
        return $this->accountPassword;
    }
    public function payment(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }
   
}
