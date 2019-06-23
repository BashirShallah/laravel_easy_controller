<?php

namespace bashirsh\laravel_easy_controller\Hooks;

use Illuminate\Http\Request;

trait SaveDataTrait
{
    protected function prepare_data_to_add($data)
    {
        return $data;
    }

    protected function prepare_data_to_update($data)
    {
        return $data;
    }

    protected function get_data($form_type = 'add', Request $request)
    {
        return $request->all();
    }
}
