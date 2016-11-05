<?php namespace App\Keen\Transformers;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractTransformer
{
    protected $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getOriginalModel()
    {
        return $this->model;
    }

    abstract function transform();

}