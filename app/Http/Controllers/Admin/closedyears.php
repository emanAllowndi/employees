<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\closedyearsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Model\closedyear;
use Validator;

use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class closedyears extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(closedyearsDataTable $closedyears)
            {
               return $closedyears->render('admin.closedyears.index',['title'=>trans('admin.closedyears')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.closedyears.create',['title'=>trans('admin.create')]);
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
             'closedyear'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'closedyear'=>trans('admin.closedyear'),

              ]);

              closedyear::create($data);

              session()->flash('success','تم اغلاق السنة بنجاح');
              return redirect(aurl('closedyears'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $closedyears =  closedyear::find($id);
                return view('admin.closedyears.show',['title'=>trans('admin.show'),'closedyears'=>$closedyears]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $closedyears =  closedyear::find($id);
                return view('admin.closedyears.edit',['title'=>trans('admin.edit'),'closedyears'=>$closedyears]);
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
                    'updating_reason'=>'required',

                    'closedyear'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'closedyear'=>trans('admin.closedyear'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                closedyear::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('closedyears'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $closedyears = closedyear::find($id);


               @$closedyears->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$closedyears = closedyear::find($id);

                    	@$closedyears->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $closedyears = closedyear::find($data);


                    @$closedyears->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
