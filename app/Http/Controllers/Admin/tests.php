<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\testsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\test;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class tests extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(testsDataTable $tests)
            {
               return $tests->render('admin.tests.index',['title'=>trans('admin.tests')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.tests.create',['title'=>trans('admin.create')]);
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
             'test_name'=>'',
             'department_id'=>'required|numeric',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'test_name'=>trans('admin.test_name'),
             'department_id'=>trans('admin.department_id'),

              ]);

              test::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('tests'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $tests =  test::find($id);
                return view('admin.tests.show',['title'=>trans('admin.show'),'tests'=>$tests]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $tests =  test::find($id);
                return view('admin.tests.edit',['title'=>trans('admin.edit'),'tests'=>$tests]);
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
             'test_name'=>'',
             'department_id'=>'required|numeric',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'test_name'=>trans('admin.test_name'),
             'department_id'=>trans('admin.department_id'),
                   ]);
              test::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('tests'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $tests = test::find($id);


               @$tests->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$tests = test::find($id);

                    	@$tests->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $tests = test::find($data);


                    @$tests->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
