<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $desc
 * @property string $img_path
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'name', 'desc', 'img_path'];
}
