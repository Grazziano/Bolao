<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 4;
    private $search = ['name', 'email'];
    private $model;

    // Construtor
    public function __construct(UserRepositoryInterface $model)
    {
      $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $columnList = ['id'=>'#', 'name'=>trans('bolao.name'), 'email'=>trans('bolao.email')];
      $page = trans('bolao.user_list');

      $search = "";
        if (isset($request->search)) {
          $search = $request->search;
          $list = $this->model->findWhereLike($this->search, $search, 'id', 'DESC');
        }else{
          $list = $this->model->paginate($this->paginate, 'id', 'DESC');
        }

        $routeName = $this->route;

        //session()->flash('msg', 'Olá alert!');
        //session()->flash('status', 'success'); // success error notification

        $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>'', 'title'=>trans('bolao.list', ['page' => $page])],
        ];

        return View('admin.'.$routeName.'.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = $this->route;
        $page = trans('bolao.user_list');
        $page_create = trans('bolao.user');

        $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>route($routeName.".index"), 'title'=>trans('bolao.list', ['page' => $page])],
          (object)['url'=>'', 'title'=>trans('bolao.create_crud', ['page'=>$page_create])],
        ];

        return View('admin.'.$routeName.'.create', compact('page', 'page_create', 'routeName', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();

      Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ])->validate();

      if ($this->model->create($data)) {
        session()->flash('msg', trans('bolao.record_added_successfully'));
        session()->flash('status', 'success'); // success error notification
        return redirect()->back();
      }else{
        session()->flash('msg', trans('bolao.error_adding_record'));
        session()->flash('status', 'error'); // success error notification
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      $routeName = $this->route;
      $register = $this->model->find($id);

      if ($register) {
        $page = trans('bolao.user_list');
        $page2 = trans('bolao.user');

        $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>route($routeName.".index"), 'title'=>trans('bolao.list', ['page' => $page])],
          (object)['url'=>'', 'title'=>trans('bolao.show_crud', ['page'=>$page2])],
        ];
        $delete = false;
        // Verifica se o usuário escolheu deletar
        if ($request->delete ?? false) {
          session()->flash('msg', trans('bolao.delete_this_record'));
          session()->flash('status', 'error'); // success error notification
          $delete = true;
        }

        return View('admin.'.$routeName.'.show', compact('register', 'page', 'page2', 'routeName', 'breadcrumb', 'delete'));
      }
      return redirect()->route($routeName.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $routeName = $this->route;
      $register = $this->model->find($id);

      if ($register) {
        $page = trans('bolao.user_list');
        $page2 = trans('bolao.user');

        $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>route($routeName.".index"), 'title'=>trans('bolao.list', ['page' => $page])],
          (object)['url'=>'', 'title'=>trans('bolao.edit_crud', ['page'=>$page2])],
        ];

        return View('admin.'.$routeName.'.edit', compact('register', 'page', 'page2', 'routeName', 'breadcrumb'));
      }
      return redirect()->route($routeName.'.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if (!$data['password']) {
          unset($data['password']); // Remove do array
        }

        Validator::make($data, [
          'name' => 'required|string|max:255',
          'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
          'password' => 'sometimes|required|string|min:6|confirmed',
        ])->validate();

        $ret = $this->model->update($data, $id);
        if ($this->model->update($data, $id)) {
          session()->flash('msg', trans('bolao.successfully_edited_record'));
          session()->flash('status', 'success'); // success error notification
          return redirect()->back();
        }else{
          session()->flash('msg', trans('bolao.error_editing_record'));
          session()->flash('status', 'notification'); // success error notification
          return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "Ok";
    }
}
