<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $primaryKey =  'stock_id';
}
