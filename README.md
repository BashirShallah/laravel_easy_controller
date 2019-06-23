# Laravel Easy Controller 1.0

# Contents
###[Easy Controllers](#easy-controllers) 
- [Multi Page Crud](#multi-page-crud)
- [API Controller](#api-controller)

to create new controller we need to extend the class `CrudController`, 

```
class Users extends CrudController {
    protected $viewPath = 'admin.users';
    protected $model = '\App\Models\User';
    protected $resource = 'admin.users';
}
```

to create new API Controller we need to extend the class `ApiController`, 

```
class Users extends CrudController {
    protected $viewPath = 'admin.users';
    protected $model = '\App\Models\User';
    protected $resource = 'admin.users';
}
```
