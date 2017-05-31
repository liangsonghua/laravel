<?php

namespace App\Http\Controllers;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use App\Repositories\PostRepository;
use App\Policies\Post;
use Illuminate\Http\Respons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class FormController extends BaseController {
 
     
     //对应的控制器名(映射视图)
     protected $controller;

     //实例名
     protected $container;

     //
     //正在操作的资源实体，比如一篇文章或一个项目,不需要和数据库打交道
     protected $post;

     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function __construct() {
          $this->middleware('auth');
          $action = Route::current()->getActionName();
          $params = Route::current()->parameters();
          list($class, $method) = explode('@', $action);
          $this->post = new Post($class,$method,$params);
     }

     //使用容器注入的方法
     public function index()
     {
          //过滤不属于自己拥有的分类，比如不列出角色为root的用户
          $builder = $this->container->orderBy('id', 'desc');
          $models = $builder->paginate(10);
          return View::make($this->controller.'/index', array('models' => $models));
     }

    public function show($id)
    {
        return view($this->controller.'/show', [$this->controller => $this->container->findOrFail($id)]);
     }

     public function create() 
     {
          if(Auth::user()->can('create',$this->post)) {
            return View::make($this->controller.'/create');
          } else {
             return response('您没有权限，请联系管理员', 200)
                  ->header('Content-Type', 'text/plain');
          }

     }

     public function store(Request $Request) 
     {
          $this->container->fill($Request->all());
          $this->container->save();
          return redirect()->action($this->controller.'Controller@index');
     }

      public function edit($id)
     {
          $model = $this->container->find($id);
          return View::make($this->controller.'/edit', compact('model'));
     }
 
     public function update(Request $Request,$id)
     {
          $model = $this->container->find($id);
          $model->fill($Request->all());
          $model->save();
          return redirect()->action($this->controller.'Controller@index');
     }
 
     public function destroy($id)
     {
          $$this->container->destroy($id); 
          return redirect()->action($this->controller.'Controller@index');
     }

}