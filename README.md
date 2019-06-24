# Laravel Easy Controller 1.0

Build resources & api controllers in fast, easy and fully customizable way.

# Contents
- [Installation](#installation)
- [API Controller](#api-controller)
- [Multi Page Crud](#multi-page-crud)
- [Hooks](#hooks)

# Installation

composer require bashirsh/laravel_easy_controller

## ApiController

to create new API Controller we need to extend the class `ApiController`, 

```
use bashirsh\laravel_easy_controller\ApiController;

class Users extends ApiController {
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

## CrudController

to create new controller we need to extend the class `CrudController`, 

```
use bashirsh\laravel_easy_controller\CrudController;

class Users extends CrudController {
    protected $viewPath = 'admin.users';
    protected $model = '\App\Models\User';
    protected $resource = 'admin.users';
}
```

This class will create a full resource controller with the methods:

* index
* show
* add
* store
* edit
* update
* delete

then we need to add the resource to the routes, and create view files.

## Hooks
The package contain a lot of hooks which help you to customize any thing in the controllers, you can see them here: [Hooks](src/Hooks).
