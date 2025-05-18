<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'phone'];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_company');
    }
}
