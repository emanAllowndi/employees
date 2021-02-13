<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\departmentsDataTable;
use App\Model\emp;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Model\department;
use Validator;
use Set;
use Up;
use Form;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class departments extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(departmentsDataTable $departments)
            {
               return $departments->render('admin.departments.index',['title'=>trans('admin.departments')]);
            }
    public  function  alldepartments(){
        $departments=department::with('administration')
            ->where('deleted_at','=',null)
            ->get() ;

        return view('admin.departments.alldepartments',['title'=>trans('admin.all'),'departments'=>$departments]);


    }



    /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
               return view('admin.departments.create',['title'=>trans('admin.create')]);
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
             'department_name'=>'required|string',
             'department_desc'=>'',


              ];
              $data = $this->validate(request(),$rules,[],[
             'department_name'=>trans('admin.department_name'),
             'department_desc'=>trans('admin.department_desc'),
              'administration_id'=>trans('admin.administration_id'),


              ]);

              $data['admin_id'] = admin()->user()->id;
                $there=DB::table('departments')->where('deleted_at','=',null)->where('department_name','like',$request->department_name)->first();
                //dd($there);
                if(!empty($there)){
                    session()->flash('success','القسم موجودة مسبقاَ');
                    return redirect(aurl('departments'));

                }
                else{
                    department::create($data);

                    session()->flash('success',trans('admin.added'));
                    return redirect(aurl('departments'));
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
                $departments =  department::find($id);
                return view('admin.departments.show',['title'=>trans('admin.show'),'departments'=>$departments]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $departments =  department::find($id);
                return view('admin.departments.edit',['title'=>trans('admin.edit'),'departments'=>$departments]);
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

                    'department_name'=>'required|string',
             'department_desc'=>'',

                         ];
             $data = $this->validate(request(),$rules,[],[
             'department_name'=>trans('admin.department_name'),
             'department_desc'=>trans('admin.department_desc'),
             'administration_id'=>trans('admin.administration_id'),

             ]);
                $data['updating_reason']=$request->updating_reason;

                $data['admin_id'] = admin()->user()->id;
              department::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('departments'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $departments = department::find($id);


               @$departments->delete();
               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$departments = department::find($id);

                    	@$departments->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $departments = department::find($data);


                    @$departments->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }


}
