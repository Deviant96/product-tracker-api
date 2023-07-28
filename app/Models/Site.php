<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;
    protected $table = 'site';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $primaryKey =  'site_id';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'site_id');
    }
}
