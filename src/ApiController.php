<?php

namespace bashirsh\laravel_easy_controller;

class ApiController extends RepositoryController
{
    public function output_index($output)
    {
        return $output['data'];
    }

    public function output_view($output)
    {
        return [
            'data' => $output['item']
        ];
    }

    public function output_update($item)
    {
        return [
            'status' => 'success',
            'msg' => 'Updated successfully!',
        ];
    }

    public function output_store($item)
    {
        return [
            'status' => 'success',
            'msg' => 'Added successfully!',
            'id' => $item->id
        ];
    }

    public function output_destroy($item)
    {
        return [
            'status' => 'success',
            'msg' => 'Deleted successfully!',
        ];
    }
}
