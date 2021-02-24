<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'name', 'category', 'price', 'tags'];
}
