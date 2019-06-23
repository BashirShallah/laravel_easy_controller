<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait OutputTrait
{
    abstract public function output_index($output);

    abstract public function output_view($output);

    abstract public function output_update($item);

    abstract public function output_store($item);

    abstract public function output_destroy($item);
}
