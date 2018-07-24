<?php

namespace CodePress\CodeTag\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeTag\Models\Tag;

/**
 * Description of TagRepositoryEloquent
 *
 * @author gabriel
 */
class TagRepositoryEloquent extends AbstractRepository implements TagRepositoryInterface
{

    public function model()
    {
        return Tag::class;
    }
    
    public function getTagsAndCount(string $model)
    {
        return $this->model->withCount($model)->get();
    }    
}
