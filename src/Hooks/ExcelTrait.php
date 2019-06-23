<?php

namespace bashirsh\laravel_easy_controller\Hooks;

use Illuminate\Database\Eloquent\Collection;

trait ExcelTrait
{
    public function excel()
    {
        $all = @$_GET['all'];

        $model = $this->model;
        $query = $this->createQuery($model);
        if ($all) {
            $results = $query->get();
        } else {
            $results = $query->paginate();
        }

        foreach ($results as $key => $result) {
            $fields = $this->_sortField($result);
            if ($key == 0) {
                $keys = array_keys($fields);
                $data[] = $keys;
            }
            $data[] = $fields;

        }

        return (new Collection($data))->downloadExcel('data.xlsx');
    }
}
