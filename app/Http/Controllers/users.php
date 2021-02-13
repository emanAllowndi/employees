<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\DataTables\usersDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\user;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class users extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(usersDataTable $users)
            {
               return $users->render('admin.users.index',['title'=>trans('admin.users')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.users.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store()
            {
              $rules = [
             'first_name'=>'string',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'first_name'=>trans('admin.first_name'),

              ]);

              user::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('users'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $users =  user::find($id);
                return view('admin.users.show',['title'=>trans('admin.show'),'users'=>$users]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $users =  user::find($id);
                return view('admin.users.edit',['title'=>trans('admin.edit'),'users'=>$users]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [
             'first_name'=>'string',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'first_name'=>trans('admin.first_name'),
                   ]);
              user::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('users'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $users = user::find($id);


               @$users->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$users = user::find($id);

                    	@$users->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $users = user::find($data);


                    @$users->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
