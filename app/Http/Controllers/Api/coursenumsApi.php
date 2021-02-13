<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\coursenum;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class coursenumsApi extends Controller
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
               "data"=>coursenum::orderBy('id','desc')->paginate(15)
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
                         'coursenum'=>'',
             'numdate'=>'',
             'numyear'=>'',
             'nummonth'=>'',
             'emp_id'=>'',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'coursenum'=>trans('admin.coursenum'),
             'numdate'=>trans('admin.numdate'),
             'numyear'=>trans('admin.numyear'),
             'nummonth'=>trans('admin.nummonth'),
             'emp_id'=>trans('admin.emp_id'),
        ]);
		
        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]); 
             }
        $data = request()->except(["_token"]);
        $create = coursenum::create($data); 

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
                $show =  coursenum::find($id);
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
             'coursenum'=>'',
             'numdate'=>'',
             'numyear'=>'',
             'nummonth'=>'',
             'emp_id'=>'',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'coursenum'=>trans('admin.coursenum'),
             'numdate'=>trans('admin.numdate'),
             'numyear'=>trans('admin.numyear'),
             'nummonth'=>trans('admin.nummonth'),
             'emp_id'=>trans('admin.emp_id'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]); 
             }
             $data = request()->except(["_token"]);
              coursenum::where('id',$id)->update($data);

              $coursenum = coursenum::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $coursenum
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
               $coursenums = coursenum::find($id);


               @$coursenums->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$coursenums = coursenum::find($id);

                    	@$coursenums->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $coursenums = coursenum::find($data);
 

                    @$coursenums->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }

            
}