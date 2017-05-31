**使用方法：**

所有的控制器继承App\Http\Controllers\FormController.php，同时在构造器时注入所操作的Model模型

如

	 public function __construct(ProjectRepository $project)
	 {
          $this->controller = 'project';
          $this->container = $project;
          parent::__construct();
 	}   
 
 在App\Http\Controllers\FormController.php中使用builder完成CRUD功能，同时实例化了一个Post对象(正在操作的资源实体，比如一篇文章或一个项目,不需要和数据库打交道)，该post主要为权限授权服务。
 
** 完整代码**
     
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

     public function index()
     {
        
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
	
**授权策略**

	<?php

	namespace App\Policies;

	use App\Repositories\UsersRepository;
	// use App\Repositories\PostRepository;
	use App\Policies\Post;
	use Illuminate\Auth\Access\HandlesAuthorization;
	class PostPolicy
	{
    	use HandlesAuthorization;

    /**
     * Determine whether the user can show the view.
     */
    public function show(UsersRepository $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(UsersRepository $user,Post $post)
    {
        // return $user->role==='root';
        return true;
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(UsersRepository $user, Post $post)
    {
        return $user->role==='root';
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(UsersRepository $user, Post $post)
    {
        return $user->role==='root';
    }
	}
同时别忘了在App\ProvidersAuthServiceProvider中添加应用的策略映射

	protected $policies = [
		******
        Post::class =>PostPolicy::class,
    ];
