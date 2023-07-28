<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;
    protected $table = 'price';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $primaryKey =  'price_id';

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'price_id');
    }

    public function product_log(): BelongsTo
    {
        return $this->belongsTo(ProductLog::class, 'price_id');
    }
}
