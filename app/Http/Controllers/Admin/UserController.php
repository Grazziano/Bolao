<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    private $route = 'users';
    private $page;
    private $paginate = 4;
    private $search = ['name', 'email'];
    private $model;

    // Construtor
    public function __construct(UserRepositoryInterface $model)
    {
      $this->page = trans('bolao.user_list');
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

      $search = "";
        if (isset($request->search)) {
          $search = $request->search;
          $list = $this->model->findWhereLike($this->search, $search, 'id', 'DESC');
        }else{
          $list = $this->model->paginate($this->paginate, 'id', 'DESC');
        }

        $page = $this->page;

        $routeName = $this->route;

        // $request->session()->flash('msg', 'Olá alert!');
        // $request->session()->flash('status', 'success'); // success error notification

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
