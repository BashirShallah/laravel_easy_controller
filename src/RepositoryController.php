<?php

namespace bashirsh\laravel_easy_controller;

use App\Http\Controllers\Controller;
use bashirsh\laravel_easy_controller\Hooks\{AfterSaveTrait,
    FilterTrait,
    IndexTrait,
    OptionsTrait,
    OutputTrait,
    SaveDataTrait,
    ValidationTrait,
    ExcelTrait};
use Illuminate\Http\Request;

abstract class RepositoryController extends Controller
{

    use AfterSaveTrait,
        FilterTrait,
        IndexTrait,
        OptionsTrait,
        OutputTrait,
        SaveDataTrait,
        ValidationTrait,
        ExcelTrait;

    protected $model;

    /* forms start */
    public function index($id = null)
    {
        $model = $this->model;
        $query = $this->createQuery($model);
        $limit = request('limit', 15);
        $orderBy = request('order_by', 'id');
        $order = request('order', 'asc');
        $query->orderBy($orderBy, $order);
        $data = $this->formatIndexData($query->paginate($limit));
        $output = compact('data');
        return $this->output_index($output);
    }

    public function show($id, $sub_id = null)
    {
        $model = $this->model;
        $item = $model::find($id);
        return $this->output_view(compact('item'));
    }

    public function destroy($id)
    {
        $model = $this->model;
        $item = $model::find($id);

        if (!$this->can_destroy_item($item)) {
            throw new \Exception('لا يمكن حذف هذا العنصر', 'can_not_delete');
        }

        $item->delete();

        return $this->output_destroy($item);
    }

    public function update($id, Request $request)
    {

        /* INPUT */
        $model = $this->model;
        $item = $model::find($id);

        $this->edit_validate($request, $item);

        $data = $this->get_data('edit', $request);
        $data = $this->prepare_data_to_update($data);

        $data = $this->handle_upload($data, $request);

        $item->update($data);
        $this->afterUpdateHook($item, $request);

        return $this->output_update($item);
    }

    public function handle_upload($data, Request $request)
    {
        foreach ($this->upload() as $name => $folder) {
            if ($request->hasFile($name)) {
                $path = $request->$name->store("storage/" . $folder);
                $data[$name] = str_replace("public/", "", $path);
            }
        }
        return $data;
    }

    /* forms end */

    protected function upload()
    {
        return [];
    }

    public function store(Request $request)
    {
        $model = $this->model;

        $this->add_validate($request);

        $data = $request->all();
        $data = $this->prepare_data_to_add($data);
        $data = $this->handle_upload($data, $request);

        $item = new $model($data);
        $item->save();

        $this->afterStoreHook($item, $request);

        return $this->output_store($item);
    }

}
