<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ratingsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\rating;
use App\Model\task;

use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class ratings extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ratingsDataTable $ratings)
            {
               return $ratings->render('admin.ratings.index',['title'=>trans('admin.ratings')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create($task_id)
            {


                $task =  task::find($task_id);

               return view('admin.ratings.create',['title'=>trans('admin.create'),'task'=>$task]);

            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store($task_id ,Request $request)
            {
              $rules = [
             'rating'=>'required|numeric',
             //'task_id'=>'required|numeric',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'rating'=>trans('admin.rating'),
             'task_id'=>trans('admin.task_id'),

              ]);
              $task =  task::find($task_id);

              $data['admin_id'] = admin()->user()->id;
              $data['task_id'] = $task_id;

              rating::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('ratings'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $ratings =  rating::find($id);
                return view('admin.ratings.show',['title'=>trans('admin.show'),'ratings'=>$ratings]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $ratings =  rating::find($id);
                return view('admin.ratings.edit',['title'=>trans('admin.edit'),'ratings'=>$ratings]);
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
             'rating'=>'required|numeric',
             'task_id'=>'required|numeric',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'rating'=>trans('admin.rating'),
             'task_id'=>trans('admin.task_id'),
                   ]);
              $data['admin_id'] = admin()->user()->id;
              rating::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('ratings'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $ratings = rating::find($id);


               @$ratings->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$ratings = rating::find($id);

                    	@$ratings->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $ratings = rating::find($data);


                    @$ratings->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
