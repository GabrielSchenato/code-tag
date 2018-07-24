<?php

namespace CodePress\CodeTag\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CodePress\CodeTag\Models\Tag;

/**
 * Description of Post
 *
 * @author gabriel
 */
class Post extends Model
{
    const STATE_PUBLISHED = 1;
    const STATE_DRAFT = 2;

    use Sluggable, SoftDeletes;

    protected $table = "codepress_posts";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'image', 'content', 'slug'
    ];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'codepress_taggables');
    }

}
