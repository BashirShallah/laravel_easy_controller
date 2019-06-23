<?php

namespace bashirsh\laravel_easy_controller\Hooks;

trait IndexTrait
{
    function createQuery($model)
    {
        $query = $model::query();
        $query = $this->filter($query);
        if (method_exists($this, 'indexQueryHook')) {
            $query = $this->indexQueryHook($query);
        }
        return $query;
    }

    protected function formatIndexData($items)
    {
        if (method_exists($this, 'index_transformer')) {
            $items->getCollection()->transform(array($this, 'index_transformer'));
        }

        return $items;
    }
}
