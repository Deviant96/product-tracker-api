<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductLog extends Model
{
    use HasFactory;
    protected $table = 'product_log';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $primaryKey =  'product_log_id';

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function price(): HasMany
    {
        return $this->hasMany(Price::class, 'product_id');
    }
}
