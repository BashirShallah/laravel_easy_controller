<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait FilterTrait
{
    function filter($query)
    {
        $filter_fields = $this->filter_fields();

        $query = apply_filter($query, $filter_fields);

        return $query;
    }

    public function filter_fields()
    {
        return [];
    }
}
