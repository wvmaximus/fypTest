<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testlistingsmodel extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false)
        {
            $query->where('tags','like', '%'.request('tag').'%');
            //filter by tag laravel from scratch 2022 4+ hour - 26th april - at 1:57 min
        }
        if($filters['search'] ?? false)
        {
            $query->where('title','like', '%'.request('search').'%')
            ->orWhere('description','like', '%'.request('search').'%')
            ->orWhere('tags','like', '%'.request('search').'%');;
            //filter by tag laravel from scratch 2022 4+ hour - 26th april - at 1:57 min
        }
    }
}
