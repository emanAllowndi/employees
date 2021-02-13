<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\holidayPalance;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holidayPalancesApi extends Controller
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
               "data"=>holidayPalance::orderBy('id','desc')->paginate(15)
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
                         'holidayPalance'=>'numeric',
             'emp_id'=>'required|numeric',
             'holidaytype_id'=>'required|numeric',
             'note'=>'',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'holidayPalance'=>trans('admin.holidayPalance'),
             'emp_id'=>trans('admin.emp_id'),
             'holidaytype_id'=>trans('admin.holidaytype_id'),
             'note'=>trans('admin.note'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
        $create = holidayPalance::create($data);

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
                $show =  holidayPalance::find($id);
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
             'holidayPalance'=>'numeric',
             'emp_id'=>'required|numeric',
             'holidaytype_id'=>'required|numeric',
             'note'=>'',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'holidayPalance'=>trans('admin.holidayPalance'),
             'emp_id'=>trans('admin.emp_id'),
             'holidaytype_id'=>trans('admin.holidaytype_id'),
             'note'=>trans('admin.note'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
              holidayPalance::  find($id)->update($data);

              $holidayPalance = holidayPalance::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $holidayPalance
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
               $holidaypalances = holidayPalance::find($id);


               @$holidaypalances->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$holidaypalances = holidayPalance::find($id);

                    	@$holidaypalances->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $holidaypalances = holidayPalance::find($data);


                    @$holidaypalances->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
