<?php namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormInputToModelHelper
{
    protected $filterString;
    protected $model;
    protected $inputs;

    function __construct(Model $model, Request $request, $filterString = 'mo_')
    {
        $this->model = $model;
        $this->inputs = $request->input();
        $this->filterString = $filterString;
    }

    public function processModel()
    {
        $model = $this->model;
        $inputArray = $this->getFilteredInputArray($this->inputs);
        foreach($inputArray as $key => $value) {
            $model->$key = ($value !== '') ? $value : null;
        }
        return $model;
    }

    protected function getFilteredInputArray(array $inputs)
    {
        $filterString = $this->filterString;
        $filtered = array_filter($inputs, function ($key) use ($filterString) {
            return ( Str::startsWith($key, $filterString) );
        }, ARRAY_FILTER_USE_KEY);
        $returned = [];

        foreach($filtered as $key => $value) {
            $returned[substr($key, strlen($filterString))] =  $value;
        }

        return $returned;
    }


}