<?php

namespace bashirsh\laravel_easy_controller;

use bashirsh\laravel_easy_controller\Hooks\RedirectTrait;

class CrudController extends RepositoryController
{

    use RedirectTrait;

    protected $viewPath;
    protected $resource = 'admin.categories';

    /* forms start */
    public function output_index($output)
    {
        request()->flash();

        return view($this->viewPath . '.index')
            ->with($output);
    }

    public function output_view($output)
    {
        if (request()->ajax()) {
            return $output;
        }
        return view($this->viewPath . '.show')
            ->with($output);
    }

    public function create($id = null)
    {
        return view($this->viewPath . '.create');
    }

    public function edit($id)
    {
        $model = $this->model;
        $item = $model::find($id);
        return view($this->viewPath . '.edit')->with(compact('item'));
    }

    public function output_update($item)
    {
        Helpers::flash('Updated successfully!');
        return redirect($this->edit_redirect_url($item));
    }

    public function output_store($item)
    {
        Helpers::flash('Added successfully!');
        return redirect($this->add_redirect_url($item));
    }

    public function output_destroy($item)
    {
        Helpers::flash('Deleted successfully!');
        return redirect($this->destroy_redirect_url($item));
    }
}
