<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\img;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class imgsApi extends Controller
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
               "data"=>img::orderBy('id','desc')->paginate(15)
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
                         'img'=>''.it()->image().'|nullable',
        ];
        $data = Validator::make(request()->all(),$rules,[],[
                         'img'=>trans('admin.img'),
        ]);

        if($data->fails()){
            return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
            ]);
             }
        $data = request()->except(["_token"]);
               if(request()->hasFile('img')){
              $data['img'] = it()->upload('img','imgs');
              }
        $create = img::create($data);

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
                $show =  img::find($id);
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
             'img'=>''.it()->image().'|nullable',

                         ];
             $data = Validator::make(request()->all(),$rules,[],[
             'img'=>trans('admin.img'),
                   ]);
             if($data->fails()){
             return response()->json([
               "status"=>false,"
               messages"=>$data->messages()
               ]);
             }
             $data = request()->except(["_token"]);
               if(request()->hasFile('img')){
              it()->delete(img::find($id)->img);
              $data['img'] = it()->upload('img','imgs');
               }
              img::  find($id)->update($data);

              $img = img::find($id);

              return response()->json([
               "status"=>true,
               "message"=>trans('admin.updated'),
               "data"=> $img
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
               $imgs = img::find($id);

               it()->delete($imgs->img);
               it()->delete('img',$id);

               @$imgs->delete();
               return response(["status"=>true,"message"=>trans('admin.deleted')]);
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$imgs = img::find($id);

                    	it()->delete($imgs->img);
                    	it()->delete('img',$id);
                    	@$imgs->delete();
                    }
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }else {
                    $imgs = img::find($data);

                    	it()->delete($imgs->img);
                    	it()->delete('img',$data);

                    @$imgs->delete();
                    return response(["status"=>true,"message"=>trans('admin.deleted')]);
                }
            }


}
