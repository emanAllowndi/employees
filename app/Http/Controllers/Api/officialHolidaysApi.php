<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\officialHoliday;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class officialHolidaysApi extends Controller
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
               "data"=>officialHoliday::orderBy('id','desc')->paginate(15)
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
                         'holiday_name'=>'required',
             'official_holidays_days'=>'required|numeric',
             'holiday_month'=>'date',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'holiday_name'=>trans('admin.holiday_name'),
             'official_holidays_days'=>trans('admin.official_holidays_days'),
             'holiday_month'=>trans('admin.holiday_month'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
        $create = officialHoliday::create($data);

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
                $show =  officialHoliday::find($id);
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
             'holiday_name'=>'required',
             'official_holidays_days'=>'required|numeric',
             'holiday_month'=>'date',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'holiday_name'=>trans('admin.holiday_name'),
             'official_holidays_days'=>trans('admin.official_holidays_days'),
             'holiday_month'=>trans('admin.holiday_month'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
              officialHoliday::  find($id)->update($data);

              $officialHoliday = officialHoliday::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $officialHoliday
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
               $officialholidays = officialHoliday::find($id);


               @$officialholidays->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$officialholidays = officialHoliday::find($id);

                    	@$officialholidays->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $officialholidays = officialHoliday::find($data);


                    @$officialholidays->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
