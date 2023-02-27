<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'icon_path'
    ];


    public function apps()
    {
        return $this->hasMany(App::class);
    }
}
