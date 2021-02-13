<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\task;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class tasksApi extends Controller
{

            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
               return response()->json([
               "status"=>true,
               "data"=>task::orderBy('id','desc')->paginate(15)
               ]);
            }


            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * Store a newly created resource in storage. Api
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
    public function store()
    {
        $rules = [
                         'task_name'=>'required',
             'task_desc'=>'',
             'days'=>'required|numeric',
             'status'=>'required',
             'task_rate'=>'numeric',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'task_name'=>trans('admin.task_name'),
             'task_desc'=>trans('admin.task_desc'),
             'days'=>trans('admin.days'),
             'status'=>trans('admin.status'),
             'task_rate'=>trans('admin.task_rate'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id;
        $create = task::create($data);

        return response()->json([
            "status"=>true,
            "message"=>trans('admin.added'),
            "data"=>$create
        ]);
    }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $show =  task::find($id);
                 return response()->json([
              "status"=>true,
              "data"=> $show
              ]);  ;
            }


            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id)
            {
                $rules = [
             'task_name'=>'required',
             'task_desc'=>'',
             'days'=>'required|numeric',
             'status'=>'required',
             'task_rate'=>'numeric',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'task_name'=>trans('admin.task_name'),
             'task_desc'=>trans('admin.task_desc'),
             'days'=>trans('admin.days'),
             'status'=>trans('admin.status'),
             'task_rate'=>trans('admin.task_rate'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id;
              task::  find($id)->update($data);

              $task = task::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $task
               ]);
            }

            /**
             * Baboon Script By [It V 1.2 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $tasks = task::find($id);


               @$tasks->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$tasks = task::find($id);

                    	@$tasks->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $tasks = task::find($data);


                    @$tasks->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
