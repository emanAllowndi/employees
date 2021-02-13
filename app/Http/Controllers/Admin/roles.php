<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Model\Role;
use App\Model\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class roles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles=role::with('permissions')->get();
        return view('admin.roles.index',['title'=>trans('admin.all'),'roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.roles.create',['title'=>trans('admin.create')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $rules = ([


        ]);
        $data = $this->validate(request(),$rules,[],[

           'permissions'=>trans('admin.permissions'),

        ]);


        $data['display_name']=$request->role;
        $data['name']=$request->role;
        $data['description']=$request->role_desc;

        $there=DB::table('roles')->where('name','like',$request->role)->first();
        //dd($there);
        if(!empty($there)){
            session()->flash('error','الدور موجود مسبقاً');
            return redirect(aurl('roles'));

        }
        else{
            $role=Role::create($data);
            $role->syncPermissions($request->permissions);


            session()->flash('success',trans('admin.added'));
            return redirect(aurl('roles'));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles =  role::find($id);
        return view('admin.roles.show',['title'=>trans('admin.show'),'roles'=>$roles]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles =  role::find($id);
        return view('admin.roles.edit',['title'=>trans('admin.edit'),'roles'=>$roles]);

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

        $rules = ([


        ]);
        $data = $this->validate(request(),$rules,[],[

            'permissions'=>trans('admin.permissions'),

        ]);


        $data['display_name']=$request->role;
        $data['name']=$request->role;
        $data['description']=$request->role_desc;


        //dd($rr);
        Role::find($id)->update($data);
        $rr=Role::find($id);
        $rr->syncPermissions($request->permissions);



            session()->flash('success',trans('admin.added'));
            return redirect(aurl('roles'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = role::find($id);


        @$roles->delete();
        session()->flash('success',trans('admin.deleted'));
        return back();
    }

}
