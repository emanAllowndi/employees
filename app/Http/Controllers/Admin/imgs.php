<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\imgsDataTable;
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
class imgs extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(imgsDataTable $imgs)
            {
               return $imgs->render('admin.imgs.index',['title'=>trans('admin.imgs')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.imgs.create',['title'=>trans('admin.create')]);
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
             'img'=>''.it()->image().'|nullable',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'img'=>trans('admin.img'),

              ]);

               if(request()->hasFile('img')){
              $data['img'] = it()->upload('img','imgs');
              }
              img::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('imgs'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $imgs =  img::find($id);
                return view('admin.imgs.show',['title'=>trans('admin.show'),'imgs'=>$imgs]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $imgs =  img::find($id);
                return view('admin.imgs.edit',['title'=>trans('admin.edit'),'imgs'=>$imgs]);
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
             'img'=>''.it()->image().'|nullable',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'img'=>trans('admin.img'),
                   ]);
               if(request()->hasFile('img')){
              it()->delete(img::find($id)->img);
              $data['img'] = it()->upload('img','imgs');
               }
              img::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('imgs'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
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
               session()->flash('success',trans('admin.deleted'));
               return back();
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
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $imgs = img::find($data);

                    	it()->delete($imgs->img);
                    	it()->delete('img',$data);

                    @$imgs->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
