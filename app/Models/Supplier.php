<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'email', 'phone'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'supplier_company');
    }
}
