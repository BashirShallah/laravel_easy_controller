<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait OptionsTrait
{
    protected function can_destroy_item($item)
    {
        return true;
    }
}
