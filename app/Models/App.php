<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;


class App extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'name',
        'version',
        'icon',
        'is_app',
        'package_name',
        'publisher',
        'publisher_url',
        'description',
        'category_id',
        'is_chosen_by_editor'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
