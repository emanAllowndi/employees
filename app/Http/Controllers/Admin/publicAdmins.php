<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\publicAdminsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Model\publicAdmin;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class publicAdmins extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(publicAdminsDataTable $publicadmins)
            {
               return $publicadmins->render('admin.publicadmins.index',['title'=>trans('admin.publicadmins')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.publicadmins.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store(request $request)
            {
              $rules = [
             'publicAdmin'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'publicAdmin'=>trans('admin.publicAdmin'),
             'sector_id'=>trans('admin.sector_id'),

              ]);



                $there=DB::table('public_admins')->where('deleted_at','=',null)->where('publicAdmin','like',$request->publicAdmin)->first();
                //dd($there);
                if(!empty($there)){
                    session()->flash('success','الادارة العامة موجودة مسبقاَ');
                    return redirect(aurl('publicadmins'));

                }
                else{
                    publicAdmin::create($data);

                    session()->flash('success',trans('admin.added'));
                    return redirect(aurl('publicadmins'));
                }


            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $publicadmins =  publicAdmin::find($id);
                return view('admin.publicadmins.show',['title'=>trans('admin.show'),'publicadmins'=>$publicadmins]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $publicadmins =  publicAdmin::find($id);
                return view('admin.publicadmins.edit',['title'=>trans('admin.edit'),'publicadmins'=>$publicadmins]);
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
             'publicAdmin'=>'',
                    'updating_reason'=>'required',


                ];
             $data = $this->validate(request(),$rules,[],[
             'publicAdmin'=>trans('admin.publicAdmin'),
             'sector_id'=>trans('admin.sector_id'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                publicAdmin::find($id)->update($data);

                session()->flash('success',trans('admin.updated'));
              return redirect(aurl('publicadmins'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $publicadmins = publicAdmin::find($id);


               @$publicadmins->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$publicadmins = publicAdmin::find($id);

                    	@$publicadmins->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $publicadmins = publicAdmin::find($data);


                    @$publicadmins->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
