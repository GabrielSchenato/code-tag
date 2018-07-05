<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;

/**
 * Description of Category
 *
 * @author gabriel
 */
class Tag extends Model
{

    protected $table = "codepress_tags";
    protected $fillable = [
        'name'
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

    public function taggable()
    {
        return $this->morphTo();
    }

}