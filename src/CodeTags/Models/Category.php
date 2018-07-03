<?php

namespace CodePress\CodeCategory\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Category
 *
 * @author gabriel
 */
class Category extends Model
{

    use Sluggable;

    protected $table = "codepress_categories";
    protected $fillable = [
        'name', 'slug', 'active', 'parent_id'
    ];
    
    public function categorizable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'build_from' => 'name',
                'save_to' => 'slug',
                'unique' => true
            ]
        ];
    }

}
