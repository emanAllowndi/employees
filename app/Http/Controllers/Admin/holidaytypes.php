<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\holidaytypesDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Model\holidaytype;
use App\Model\holiday;

use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class holidaytypes extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(holidaytypesDataTable $holidaytypes)
            {
               return $holidaytypes->render('admin.holidaytypes.index',['title'=>trans('admin.holidaytypes')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.holidaytypes.create',['title'=>trans('admin.create')]);
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
             'holidaytype'=>'required',
                  'type_days'=>'numeric',


              ];
              $data = $this->validate(request(),$rules,[],[
             'holidaytype'=>trans('admin.holidaytype'),
                  'type_days'=>trans('admin.type_days'),


              ]);

              holidaytype::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('holidaytypes'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $holidaytypes =  holidaytype::find($id);
                return view('admin.holidaytypes.show',['title'=>trans('admin.show'),'holidaytypes'=>$holidaytypes]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $holidaytypes =  holidaytype::find($id);
                return view('admin.holidaytypes.edit',['title'=>trans('admin.edit'),'holidaytypes'=>$holidaytypes]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id,Request $request)
            {
                $rules = [
             'holidaytype'=>'required',
                             'type_days'=>'numeric',
                    'updating_reason'=>'required',


                         ];
             $data = $this->validate(request(),$rules,[],[
             'holidaytype'=>trans('admin.holidaytype'),
                 'type_days'=>trans('admin.type_days'),

             ]);
                $data['updating_reason']=$request->updating_reason;

                holidaytype::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('holidaytypes'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $holidaytypes = holidaytype::find($id);


               @$holidaytypes->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$holidaytypes = holidaytype::find($id);

                    	@$holidaytypes->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $holidaytypes = holidaytype::find($data);


                    @$holidaytypes->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
