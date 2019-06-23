<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait ValidationTrait
{
    protected function add_validate($request)
    {
        $this->validate($request, $this->add_rules());
    }

    public function add_rules()
    {
        return $this->rules();
    }

    protected function rules()
    {
        return [];
    }

    protected function edit_validate($request, $item)
    {
        $this->validate($request, $this->edit_rules($item));
    }

    public function edit_rules($item)
    {
        return $this->rules();
    }
}
