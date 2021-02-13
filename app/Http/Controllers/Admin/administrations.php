<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\administrationsDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\administration;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class administrations extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(administrationsDataTable $administrations)
            {
               return $administrations->render('admin.administrations.index',['title'=>trans('admin.administrations')]);
            }


            public  function  alladministrations(){
                $administrations=administration::with('publicAdmin')
                    ->where('deleted_at','=',null)
                    ->get() ;
                  return view('admin.administrations.alladministrations',['title'=>trans('admin.all'),'administrations'=>$administrations]);


            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.administrations.create',['title'=>trans('admin.create')]);
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
             'administration'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'administration'=>trans('admin.administration'),
             'publicAdmin_id'=>trans('admin.publicAdmin_id'),

              ]);

              administration::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('administrations'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $administrations =  administration::find($id);
                return view('admin.administrations.show',['title'=>trans('admin.show'),'administrations'=>$administrations]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $administrations =  administration::find($id);
                return view('admin.administrations.edit',['title'=>trans('admin.edit'),'administrations'=>$administrations]);
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
             'administration'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'administration'=>trans('admin.administration'),
             'publicAdmin_id'=>trans('admin.publicAdmin_id'),
                   ]);
              administration::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('administrations'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $administrations = administration::find($id);


               @$administrations->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$administrations = administration::find($id);

                    	@$administrations->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $administrations = administration::find($data);


                    @$administrations->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
