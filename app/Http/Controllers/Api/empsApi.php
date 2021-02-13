<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\emp;
use App\Model\task;

use App\Model\department;
use App\Model\job;


use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class empsApi extends Controller
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
               "data"=>emp::orderBy('id','desc')->paginate(15)
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
                         'emp_name'=>'required|string',
                         'second_name'=>'required|string',

                         'third_name'=>'required|string',

                         'last_name'=>'required|string',

             'salary'=>'required|numeric',
             'major'=>'',
             'qulification'=>'',
             'department_id'=>'required|numeric',
             'job_id'=>'required|numeric',
             'user_id'=>'required|numeric',

        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'emp_name'=>trans('admin.emp_name'),
                         'second_name'=>trans('admin.second_name'),

             'third_name'=>trans('admin.third_name'),

             'last_name'=>trans('admin.last_name'),
             'salary'=>trans('admin.salary'),
             'major'=>trans('admin.major'),
             'qulification'=>trans('admin.qulification'),
             'department_id'=>trans('admin.department_id'),
             'job_id'=>trans('admin.job_id'),
             'user_id'=>trans('admin.user_id'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id;
        $create = emp::create($data);

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
                $show =  emp::find($id);
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
             'emp_name'=>'required|string',
             'second_name'=>'required|string',

             'third_name'=>'required|string',

             'last_name'=>'required|string',
             'salary'=>'required|numeric',
             'major'=>'',
             'qulification'=>'',
             'department_id'=>'required|numeric',
             'job_id'=>'required|numeric',
             'user_id'=>'required|numeric',


                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'emp_name'=>trans('admin.emp_name'),
             'second_name'=>trans('admin.second_name'),

             'third_name'=>trans('admin.third_name'),

             'last_name'=>trans('admin.last_name'),
             'salary'=>trans('admin.salary'),
             'major'=>trans('admin.major'),
             'qulification'=>trans('admin.qulification'),
             'department_id'=>trans('admin.department_id'),
             'job_id'=>trans('admin.job_id'),
             'user_id'=>trans('admin.user_id'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
              $data['user_id'] = auth()->user()->id;
              emp::  find($id)->update($data);

              $emp = emp::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $emp
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
               $emps = emp::find($id);


               @$emps->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$emps = emp::find($id);

                    	@$emps->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $emps = emp::find($data);


                    @$emps->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
