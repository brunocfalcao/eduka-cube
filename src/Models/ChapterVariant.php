<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterVariant extends Model
{
    // use HasFactory, SoftDeletes;
    protected $table = 'chapter_variant';

    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(Variant::class,'id','variant_id');
    }
}
