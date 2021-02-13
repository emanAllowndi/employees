<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\coursenumsDataTable;
use App\Model\emp;
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
class coursenums extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(coursenumsDataTable $coursenums)
            {
               return $coursenums->render('admin.coursenums.index',['title'=>trans('admin.coursenums')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $emps=emp::all();

                return view('admin.coursenums.create',['title'=>trans('admin.create'),'emps'=>$emps]);
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
             'coursenum'=>'',
             'numdate'=>'',
             'numyear'=>'',
             'nummonth'=>'',
             'emp_id'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'coursenum'=>trans('admin.coursenum'),
             'numdate'=>trans('admin.numdate'),
             'numyear'=>trans('admin.numyear'),
             'nummonth'=>trans('admin.nummonth'),
             'emp_id'=>trans('admin.emp_id'),

              ]);

              coursenum::create($data);

              session()->flash('success',trans('admin.added'));
              return redirect(aurl('coursenums'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $coursenums =  coursenum::find($id);
                return view('admin.coursenums.show',['title'=>trans('admin.show'),'coursenums'=>$coursenums]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $coursenums =  coursenum::find($id);
                return view('admin.coursenums.edit',['title'=>trans('admin.edit'),'coursenums'=>$coursenums]);
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
             'coursenum'=>'',
             'numdate'=>'',
             'numyear'=>'',
             'nummonth'=>'',
             'emp_id'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'coursenum'=>trans('admin.coursenum'),
             'numdate'=>trans('admin.numdate'),
             'numyear'=>trans('admin.numyear'),
             'nummonth'=>trans('admin.nummonth'),
             'emp_id'=>trans('admin.emp_id'),
                   ]);
              coursenum::where('id',$id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('coursenums'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $coursenums = coursenum::find($id);


               @$coursenums->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
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
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $coursenums = coursenum::find($data);


                    @$coursenums->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
