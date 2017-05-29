<?php

namespace App\Http\Controllers;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\PostRepository;
use Illuminate\Http\Respons;
use Illuminate\Support\Facades\Auth;
class FormController extends BaseController {
 
     // 对应的模型
     protected $model;
     
     //对应的控制器名(映射视图)
     protected $controller;

     //实例名
     protected $container;

     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function __construct() {
          $this->middleware('auth');
          $this->controller = $this->model;

     }

     //使用容器注入的方法
     public function index()
     {
          //过滤不属于自己拥有的分类，比如不列出角色为root的用户
          $builder = $this->container->orderBy('id', 'desc');
          $models = $builder->paginate(10);
          return View::make($this->controller.'/index', array('models' => $models));
     }

    public function show(PostRepository $post,$id)
    {
        return view($this->controller.'/show', [$this->controller => $this->container->findOrFail($id)]);
     }

     public function create(PostRepository $post) 
     {

          if(Auth::user()->can('create',$post)) {
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