<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\empsDataTable;
use App\Model\behavior;
use App\Model\training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Model\emp;
use App\Model\task;
use App\Model\department;
use App\Model\attendance;
use App\Model\user;
use App\Model\per;
use App\Model\holiday;
use App\Model\officialHoliday;
use App\Model\rating;
use App\Model\audit;
use PDF;









use Laratrust\Models\LaratrustPermission;
use Laratrust\Traits\LaratrustUserTrait;
use Laratrust\Models\LaratrustRole;



use Validator;
use Set;
use Up;
use Form;


// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.2 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.2 | https://it.phpanonymous.com]
class emps extends Controller
{

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(empsDataTable $emps)
            {//يستدعي كل بيانات الموظفين عادي جدا وفي الفيو تروح تستدعي الحقول عن طريق المتغير الي اسمه
                //$emps ... emps->اسم الحقل
               // dd(auth()->guard('admin')->id());

                        session_start();


                return $emps->render('admin.emps.index',['title'=>trans('admin.emps'),'emps'=>$emps,]);

            }

    public function details($emp_id)
    {

      $emps=emp::find($emp_id);

        return view('admin.emps.details',['title'=>trans('admin.emps'),'emps'=>$emps,]);

    }

    public function names()
    {
        $allemps = DB::table('emps')->get();
        foreach ($allemps as $allemp) {
            $myvalue = $allemp->emp_name;
            $arr = explode(' ', trim($myvalue));
            // echo $arr[0]; // will print Test
            emp::where('id', $allemp->id)
                ->update(['emp_name' => $arr[0], 'second_name' => $arr[1], 'third_name' => $arr[2], 'last_name' => $arr[3]]);
        }
echo 'mdj';


    }


    public function performance(Request $request){
        $year = session()->get('year');

        $tasks=  DB::table('tasks')->where('deleted_at','=',null)->where('tyear','=',$year)->get();

        $allemps=DB::table('emps')->where('deleted_at','=',null)->get();
       // $tasks= task::all();
        $holidays=  DB::table('holidaies')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        //$holidays=holiday::all();
        $officialHolidays=  DB::table('official_holidaies')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        //$officialHolidays=officialHoliday::all();
        $pers=  DB::table('pers')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        // $pers= per::all();
        $user =  user::all();

        if ($request->isMethod('post'))
        {
            $from_date = Carbon::parse($request->input('from_date'));
            $to_date   = Carbon::parse($request->input('to_date'));
            $emp_name=$request->input('id');
            $publicAdmin=$request->input('publicAdmin');
            $administration=$request->input('administration');
            $users=$request->input('first_name');
            $sector=$request->input('sector');
            $department=$request->input('department_name');
          // dd($department);

            if ($request->has('filter'))
            {
                if(isset($emp_name) && empty($request->from_date) ){
                    $attendances=  DB::table('attendances')->where('deleted_at','=',null)->where('emp_id','=',$emp_name)->where('ayear','=',$year)->get();
                    return view('admin.emps.performance',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                   'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);
                }
                elseif(isset($emp_name) && isset( $request->from_date)  ){

                    $attendances=  DB::table('attendances')->where('deleted_at','=',null)->where('emp_id','=',$emp_name)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
                    return view('admin.emps.performance',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                        'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

                }


                $attendances=  DB::table('attendances')->where('deleted_at','=',null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
                return view('admin.emps.printperformance',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                    'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);            }
        }
        else{

            $attendances=  DB::table('attendances')->where('deleted_at','=',null)->where('ayear','=',$year)->get();


            return view('admin.emps.performance',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);
  }


    }

    public function printshow(Request $request, $id){



        $emps=emp::find($id);
        $tasks= emp::find($id)->tasks;

        $holidays= emp::find($id)->holidays;
        $officialHolidays=new officialHoliday;
        $ratings=new rating;

        // dd($holidays);
        $pers= emp::find($id)->pers;
        $attendances=emp::find($id)->attendances;

        $per= emp::find($id);
        $user =  user::find(auth()->guard('admin')->id());



        return view('admin.emps.printshow',['title'=>trans('admin.show'),'emps'=>$emps,'tasks'=>$tasks,'holidays'=>$holidays,'pers'=>$pers,'user'=>$user,'per'=>$per,'attendances'=>$attendances,'officialHolidays'=>$officialHolidays,'ratings'=>$ratings]);
          }







    public function audits (){
       // $audits=  DB::table('audits')->where('created_at','=',$year)->get();

       $audits = audit::all();
            //dd($audit->id);




        return view('admin.audits',['audits'=>$audits]);


    }



            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create(emp $emps,user $user)
            {// عند انشاء موظف يتم الانشاء من الارافل كولكتف في الفيو
               return view('admin.emps.create',['title'=>trans('admin.create'),'emps'=>$emps]);
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function store(user $user,request $request)
            {
                $rules =[
             'emp_name'=>'required|string',
             'second_name'=>'required|string',

             'third_name'=>'',

             'last_name'=>'',


                    'major'=>'',
             'qulification'=>'',
             'department_id'=>'',
             'job_id'=>'',
             'user_id'=>'',
              'photo_profile'=>''.it()->image().'|nullable',




                   ];
              $data = $this->validate(request(),$rules,[],[
             'emp_name'=>trans('admin.emp_name'),
             'second_name'=>trans('admin.second_name'),

             'third_name'=>trans('admin.third_name'),

             'last_name'=>trans('admin.last_name'),


                  'major'=>trans('admin.major'),
             'qulification'=>trans('admin.qulification'),
             //'department_id'=>trans('admin.department_id'),
             'job_id'=>trans('admin.job_id'),
             'user_id'=>trans('admin.user_id'),
                  'photo_profile'=>trans('admin.photo_profile'),
                  'cv'=>trans('admin.cv'),
                  'contract'=>trans('admin.contract'),
                  'fingerprint'=>trans('admin.fingerprint'),
                  'account_num'=>trans('admin.account_num'),
                  'work_nature'=>trans('admin.work_nature'),
                  'level'=>trans('admin.level'),
                  'transportation'=>trans('admin.transportation'),
                  'activity'=>trans('admin.activity'),
                  'degree'=>trans('admin.degree'),



              ]);
if(isset($request->department_id)) {
    $data['department_id'] = $request->department_id;

    $administration_id = DB::table('departments')->select('administration_id')->where('deleted_at', '=', null)->where('id', '=', $request->department_id)->first();
    $publicadmin_id = DB::table('administrations')->where('deleted_at', '=', null)->where('id', '=', $administration_id->administration_id)->first();
    $sector_id = DB::table('public_admins')->where('deleted_at', '=', null)->where('id', '=', $publicadmin_id->publicAdmin_id)->first();
    //dd($sector_id->sector_id);
    $data['administration_id'] = $administration_id->administration_id;
    $data['publicadmin_id'] = $publicadmin_id->publicAdmin_id;
    $data['sector_id'] = $sector_id->sector_id;
}




                $data['gender'] = $request->gender;
                $data['salary'] = $request->salary;
                $data['motivation'] = $request->motivation;
                $data['status'] = $request->status;
                $data['start_date'] = $request->start_date;
                $data['phone_number'] = $request->phone_num;
                $data['emergency_number'] = $request->emergency_number;
                $data['emergency_person'] = $request->emergency_person;
                $data['email'] = $request->email;
                $data['social'] = $request->social;
                $data['nationality'] = $request->nationality;
                $data['snn'] = $request->snn;
                $data['passport'] = $request->passport;
                $data['birth_date'] = $request->bitrthdate;
                $data['birth_place'] = $request->bitrthplace;
                $data['sons'] = $request->sons;
                $data['employment_number'] = $request->employment_number;
                if(request()->hasFile('photo_profile')){
                    $data['photo_profile'] = it()->upload('photo_profile','emps');
                }

                emp::create($data);


    $data['admin_id'] = admin()->user()->id;





          //  $user->users->sync($user);



              session()->flash('success',trans('admin.added'));
              return redirect(aurl('emps'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            { $year = session()->get('year');
                $emps=emp::find($id);
                $behaviors=  behavior::with('emp')->where('deleted_at','=',null)->where('emp_id','=',$id)->where('beyear','=',$year)->get();
                $trainings=  training::with('emp')->where('deleted_at','=',null)->where('emp_id','=',$id)->where('trayear','=',$year)->get();

                $tasks=  DB::table('tasks')->where('deleted_at','=',null)->where('emp_id','=',$id)->where('tyear','=',$year)->get();

                $holidays=  DB::table('holidaies')->where('deleted_at','=',null)->where('emp_id','=',$id)->where('hyear','=',$year)->get();

                $officialHolidays=  DB::table('official_holidaies')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

                $pers=  DB::table('pers')->where('deleted_at','=',null)->where('emp_id','=',$id)->where('pyear','=',$year)->get();


                $holiday_palances= DB::table('holiday_palances')->where('emp_id','=',$id)->where('deleted_at','=',null)->where('palyear','=',$year)->get();

                $ratings=new rating;


                $attendances= DB::table('attendances')->where('emp_id','=',$id)->where('deleted_at','=',null)->where('ayear','=',$year)->get();


                $per= emp::find($id);
                $user =  user::find(auth()->guard('admin')->id());



              return view('admin.emps.show',['title'=>trans('admin.show'),'holiday_palances'=>$holiday_palances,
                  'emps'=>$emps,'tasks'=>$tasks,'holidays'=>$holidays,'pers'=>$pers,'user'=>$user,'per'=>$per,
                  'attendances'=>$attendances,'officialHolidays'=>$officialHolidays,'ratings'=>$ratings
              ,'behaviors'=>$behaviors,'trainings'=>$trainings]);
            }



            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $emps =  emp::find($id);
                return view('admin.emps.edit',['title'=>trans('admin.edit'),'emps'=>$emps]);
            }


            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function update($id,Request $request)
            {
                $rules =[
                    'emp_name'=>'required|string',
                    'second_name'=>'required|string',

                    'third_name'=>'',

                    'last_name'=>'',




                    'major'=>'',
                    'qulification'=>'',
                    'department_id'=>'',
                    'job_id'=>'',
                    'user_id'=>'',
                    'photo_profile'=>''.it()->image().'|nullable',




                ];
                $data = $this->validate(request(),$rules,[],[
                    'emp_name'=>trans('admin.emp_name'),
                    'second_name'=>trans('admin.second_name'),

                    'third_name'=>trans('admin.third_name'),

                    'last_name'=>trans('admin.last_name'),

                    'motivation'=>trans('admin.motivation'),

                    'major'=>trans('admin.major'),
                    'qulification'=>trans('admin.qulification'),
                    //'department_id'=>trans('admin.department_id'),
                    'job_id'=>trans('admin.job_id'),
                    'user_id'=>trans('admin.user_id'),
                    'photo_profile'=>trans('admin.photo_profile'),
                    'cv'=>trans('admin.cv'),
                    'contract'=>trans('admin.contract'),
                    'fingerprint'=>trans('admin.fingerprint'),
                    'account_num'=>trans('admin.account_num'),
                    'work_nature'=>trans('admin.work_nature'),
                    'level'=>trans('admin.level'),
                    'transportation'=>trans('admin.transportation'),
                    'activity'=>trans('admin.activity'),
                    'degree'=>trans('admin.degree'),



                ]);

                $data['updating_reason']=$request->updating_reason;

                $data['admin_id'] = admin()->user()->id;

				if(isset($request->department_id)) {
    $data['department_id'] = $request->department_id;

    $administration_id = DB::table('departments')->select('administration_id')->where('deleted_at', '=', null)->where('id', '=', $request->department_id)->first();
    $publicadmin_id = DB::table('administrations')->where('deleted_at', '=', null)->where('id', '=', $administration_id->administration_id)->first();
    $sector_id = DB::table('public_admins')->where('deleted_at', '=', null)->where('id', '=', $publicadmin_id->publicAdmin_id)->first();
    //dd($sector_id->sector_id);
    $data['administration_id'] = $administration_id->administration_id;
    $data['publicadmin_id'] = $publicadmin_id->publicAdmin_id;
    $data['sector_id'] = $sector_id->sector_id;
}

                $data['gender'] = $request->gender;
                $data['salary'] = $request->salary;
                $data['status'] = $request->status;
                $data['start_date'] = $request->start_date;
                $data['phone_number'] = $request->phone_num;
                $data['emergency_number'] = $request->emergency_number;
                $data['emergency_person'] = $request->emergency_person;
                $data['email'] = $request->email;
                $data['social'] = $request->social;
                $data['nationality'] = $request->nationality;
                $data['snn'] = $request->snn;
                $data['passport'] = $request->passport;
                $data['birth_date'] = $request->bitrthdate;
                $data['birth_place'] = $request->bitrthplace;
                $data['sons'] = $request->sons;
                $data['employment_number'] = $request->employment_number;
                if(request()->hasFile('photo_profile')){
                    $data['photo_profile'] = it()->upload('photo_profile','emps');
                }



                emp::find($id)->update($data);

              session()->flash('success',trans('admin.updated'));
              return redirect(aurl('emps'));
            }

            /**
             * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $emps = emp::find($id);


               @$emps->delete();


               session()->flash('success',trans('admin.deleted'));
               return back();
            }



 			public function multi_delete(Request $r)
            {
                $data = $r->input('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    	$emps = emp::find($id);

                    	@$emps->delete();
                    }
                    session()->flash('success', trans('admin.deleted'));
                   return back();
                }else {
                    $emps = emp::find($data);


                    @$emps->delete();
                    session()->flash('success', trans('admin.deleted'));
                    return back();
                }
            }






}
