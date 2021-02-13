<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\user;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class usersApi extends Controller
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
               "data"=>user::orderBy('id','desc')->paginate(15)
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
                         'first_name'=>'required|string',
             'middel_name'=>'required|string',
             'last_name'=>'required|string',
             'email'=>'required',
             'password'=>'required|confirmed',
             ''=>'',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'first_name'=>trans('admin.first_name'),
             'middel_name'=>trans('admin.middel_name'),
             'last_name'=>trans('admin.last_name'),
             'email'=>trans('admin.email'),
             'password'=>trans('admin.password'),
             ''=>trans('admin.'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
        $create = user::create($data);

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
                $show =  user::find($id);
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
             'first_name'=>'required|string',
             'middel_name'=>'required|string',
             'last_name'=>'required|string',
             'email'=>'required',
             'password'=>'required',
             ''=>'',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'first_name'=>trans('admin.first_name'),
             'middel_name'=>trans('admin.middel_name'),
             'last_name'=>trans('admin.last_name'),
             'email'=>trans('admin.email'),
             'password'=>trans('admin.password'),
             ''=>trans('admin.'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
              user::  find($id)->update($data);

              $user = user::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $user
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
               $users = user::find($id);


               @$users->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
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
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $users = user::find($data);


                    @$users->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
