<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;

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
    
    public function taggable()
    {
        return $this->morphTo();
    }

}
