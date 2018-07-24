<?php

namespace CodePress\CodeTag\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Validation\Validator;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeUser\Models\User;

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
    private $validator;

    function getValidator()
    {
        return $this->validator;
    }

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable', 'codepress_categorizables');
    }
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'codepress_taggables');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function getCategoriesArrayAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }
    
    public function getTagsArrayAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }

}
