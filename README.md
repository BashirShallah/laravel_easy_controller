# Laravel Easy Controller 1.0

Build resources & api controllers in fast, easy and fully customizable way.

# Contents
- [Features](#features)
- [Installation](#installation)
- [API Controller](#api-controller)
- [Multi Page Crud](#multi-page-crud)
- [Hooks](#hooks)

# Features
### index features
- filter
- Query Hook
- pagination
- limit
- transform row
- export to excel (current page or all results).

### forms features
- validation
- change the data before store
- redirect
- after save hooks

### delete features
- redirect
- after save hooks

# Installation

composer require bashirsh/laravel_easy_controller

## ApiController

to create new API Controller we need to extend the class `ApiController`, 

app/Http/Controllers/Api/UsersController.php

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
}
```

This class will create a full resource controller with the methods:

* index
* show
* store
* update
* delete

then we need to add the resource to the routes.

routes/api.php
```
...
Route::apiResource('users', 'UsersController');
...
```

## CrudController

to create new controller we need to extend the class `CrudController`, 


app/Http/Controllers/UsersController.php

```
use bashirsh\laravel_easy_controller\CrudController;

class UsersController extends CrudController {
    protected $viewPath = 'admin.users';
    protected $model = '\App\Models\User';
    protected $resource = 'admin.users';
}
```

routes/web.php
```
...
Route::resource('users', 'UsersController');
Route::get('users/excel', 'UsersController@excel');
...
```

This class will create a full resource controller with the methods:

* index
* show
* add
* store
* edit
* update
* delete
* export to excel

then we need to add the resource to the routes, and create view files.

## Hooks
The package contain a lot of hooks which help you to customize any thing in the controllers, you can see them here: [Hooks](src/Hooks).

### Index Hooks
#### Index Query Hook
The package will handle pagination limit and filter out of the box, and we can change the query ex: adding conditions or using eager load.

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    function indexQueryHook($query){
        $query->where('user_type', 'admin');
        return $query;
    }
}
```

#### Define filters
we define our allowed filters by defining.

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    public function filter_fields(){
        return [
            [
                // field equal to name by default
                // and the default condition is '='
                'name'=>'id'
            ],
            [
                'name'=>'name',
                'field'=>'name',
                'cond'=>'like'
            ]
        ];
    }
}
```

#### Transform Row
```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';

    public function index_transformer($item){
        $item->new_value = 'test';
        $item->other_value = 'test 2';
        
        return $item;
    }
}
```

### Forms Hooks

#### define validation rules

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    public function add_rules(){
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];
    }

    public function edit_rules($item){
        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($item->id),
            ],
        ];
    }
}
```
#### change the data before store

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    protected function prepare_data_to_add($data)
    {
        $data->created_by = Auth::ID();    
        return $data;
    }

    protected function prepare_data_to_update($data)
    {
        $data->updated_by = Auth::ID();
        return $data;
    }
}
```

#### redirect
you can define redirect_url to redirect after save, update or delete

and you can customize using these methods
- add_redirect_url
- edit_redirect_url
- destroy_redirect_url

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    /**
     * $item: the affected object
     */
    protected function redirect_url($item)
    {
        return route('users.index');
    }
    
    protected function add_redirect_url($item)
    {
        return route('users.show', [$item->id]);
    }

    protected function edit_redirect_url($item)
    {
        return route('users.show', [$item->id]);
    }

    protected function destroy_redirect_url($item)
    {
        return route('users.index');
    }
}
```

#### After save hook

```
use bashirsh\laravel_easy_controller\ApiController;

class UsersController extends ApiController {
    protected $model = '\App\Models\User';
    
    // used for both save and update
    protected function afterSaveHook($item, $request)
    {
        // do whatever you want
    }
    
    protected function afterUpdateHook($item, $request)
    {
        // do whatever you want
    }

    protected function afterStoreHook($item, $request)
    {
        // do whatever you want
    }
}
```
