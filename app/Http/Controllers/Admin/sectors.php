<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\sectorsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\sector;
use Illuminate\Support\Facades\DB;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class sectors extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(sectorsDataTable $sectors)
            {
               return $sectors->render('admin.sectors.index',['title'=>trans('admin.sectors')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.sectors.create',['title'=>trans('admin.create')]);
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
             'sector'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'sector'=>trans('admin.sector'),

              ]);

              sector::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('sectors'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $sectors =  sector::find($id);
                return view('admin.sectors.show',['title'=>trans('admin.show'),'sectors'=>$sectors]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $sectors =  sector::find($id);
                return view('admin.sectors.edit',['title'=>trans('admin.edit'),'sectors'=>$sectors]);
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
             'sector'=>'',
            'updating_reason'=>'required',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'sector'=>trans('admin.sector'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                sector::find($id)->update($data);
                //sector::  find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('sectors'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $sectors = sector::find($id);


               @$sectors->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$sectors = sector::find($id);

                    	@$sectors->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $sectors = sector::find($data);


                    @$sectors->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
