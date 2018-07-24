<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Description of Tag
 *
 * @author gabriel
 */
class Tag extends Model
{

    use SoftDeletes;
    use Sluggable;

    protected $table = "codepress_tags";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'slug'
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
        $validator->setRules(['name' => 'required|max:255']);
        $validator->setData($this->attributes);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function posts()
    {
        return $this->morphedByMany('CodePress\CodePosts\Models\Post', 'taggable', 'codepress_taggables');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
