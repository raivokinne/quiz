<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hystory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'point_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}
