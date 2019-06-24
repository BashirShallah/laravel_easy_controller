<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait AfterSaveTrait
{
    protected function afterSaveHook($item, $request)
    {

    }

    protected function afterUpdateHook($item, $request)
    {
        $this->afterSaveHook($item, $request);
    }

    protected function afterStoreHook($item, $request)
    {
        $this->afterSaveHook($item, $request);
    }
}
