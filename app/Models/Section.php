<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'name',
        'type',
        'path',
        'parent_id'
    ];

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Section', 'parent_id');
    }

    public function parent()
    {
        return $this->BelongsTo('App\Models\Section');
    }


}
