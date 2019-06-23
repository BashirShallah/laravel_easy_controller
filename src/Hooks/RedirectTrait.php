<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait RedirectTrait
{
    protected function add_redirect_url($item)
    {
        return $this->redirect_url($this->resource . '.index');
    }

    /**
     * $item: the affected object
     */
    protected function redirect_url($item)
    {
        return route($this->resource . '.index');
    }

    protected function edit_redirect_url($item)
    {
        return $this->redirect_url($this->resource . '.index');
    }

    protected function destroy_redirect_url($item)
    {
        return route($this->resource . '.index');
    }
}
