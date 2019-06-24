<?php

namespace bashirsh\laravel_easy_controller\Hooks;

use bashirsh\laravel_easy_controller\Helpers;

trait FilterTrait
{
    function filter($query)
    {
        $filter_fields = $this->filter_fields();

        $query = Helpers::apply_filter($query, $filter_fields);

        return $query;
    }

    public function filter_fields()
    {
        return [];
    }
}
