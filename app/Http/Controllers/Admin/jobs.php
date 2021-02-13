<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\jobsDataTable;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Model\job;
use App\Charts\SampleChart;

use Illuminate\Support\Facades\DB;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class jobs extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(jobsDataTable $jobs)
            {
               return $jobs->render('admin.jobs.index',['title'=>trans('admin.jobs')]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.jobs.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {
              $rules = [
             'job_name'=>'required',
             'job_desc'=>'',

                   ];
              $data = $this->validate(request(),$rules,[],[
             'job_name'=>trans('admin.job_name'),
             'job_desc'=>trans('admin.job_desc'),

              ]);

              $data['admin_id'] = admin()->user()->id;
              $there=DB::table('jobs')->where('deleted_at','=',null)->where('job_name','like',$request->job_name)->first();
              //dd($there);
                if(!empty($there)){
                    session()->flash('success','الوظيفة موجودة مسبقاَ');
                    return redirect(aurl('jobs'));

                }
                else{
                    job::create($data);

                    session()->flash('success',trans('admin.added'));
                    return redirect(aurl('jobs'));
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
                $jobs =  job::find($id);


                return view('admin.jobs.show',['title'=>trans('admin.show'),'jobs'=>$jobs]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
               // dd($id);
                $jobs=DB::table('jobs')->where('id','=',$id)->first();

                //$jobs =  job::find($id)->first();
                return view('admin.jobs.edit',['title'=>trans('admin.edit'),'jobs'=>$jobs]);
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
             'job_name'=>'required',
             'job_desc'=>'',
                    'updating_reason'=>'required',


                ];
             $data = $this->validate(request(),$rules,[],[
             'job_name'=>trans('admin.job_name'),
             'job_desc'=>trans('admin.job_desc'),
                   ]);
                $data['updating_reason']=$request->updating_reason;

                $data['admin_id'] = admin()->user()->id;
              job::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('jobs'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\RedirectResponse
             */
            public function destroy($id)
            {
               $jobs = job::find($id);


               @$jobs->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$jobs = job::find($id);

                    	@$jobs->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $jobs = job::find($data);


                    @$jobs->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
