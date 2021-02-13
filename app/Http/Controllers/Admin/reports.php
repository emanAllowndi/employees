<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\empsDataTable;
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
class reports extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    { $year = session()->get('year');

        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();

            $from_date = Carbon::parse($request->input('from_date'));
            $to_date = Carbon::parse($request->input('to_date'));

                if (empty($request->from_date)) {

                    $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
                    return view('admin.reports.index',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                        'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

                  }
                else{
                    $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
                    return view('admin.reports.index', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                        'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

                }
  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emp(Request $request)
    {
        $year = session()->get('year');

        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();


        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));
        $emp_name=$request->get('emp_name');

        if (empty($request->from_date) && (empty($emp_name)) ) {
            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.emp',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date) && (isset($emp_name))){
           //dd($emp_name);
            $attendances=  attendance::with('emp')->where('emp_id','=',$emp_name)->where('deleted_at','=',null)->where('ayear','=',$year)->get();

            return view('admin.reports.emp',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{
            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('emp_id','=',$emp_name)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.emp', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dep(Request $request)
    {
        $year = session()->get('year');

        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();


        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $dep=$request->get('dep');

        if (empty($request->from_date) && empty($dep)) {

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.dep',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date)  && isset($dep)){

            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('department_id','=',$dep)->get();

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.dep',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{

            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('department_id','=',$dep)->get();

            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.dep', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request)
    {
        $year = session()->get('year');



        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();

        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));
        $admin=$request->get('admin');

        if (empty($request->from_date) && empty($admin)) {
            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.admin',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date) && isset($admin)){
            // dd($emp_name);
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('administration_id','=',$admin)->get();

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.admin',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('administration_id','=',$admin)->get();

            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.admin', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function public(Request $request)
    {
        $year = session()->get('year');


        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();

        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));
        $publicadmin=$request->get('publicadmin');

        if (empty($request->from_date) && empty($publicadmin)) {
            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.public',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date) && isset($publicadmin)){

            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('publicadmin_id','=',$publicadmin)->get();

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.public',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{

            $allemps=emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('publicadmin_id','=',$publicadmin)->get();

            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.public', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sector(Request $request)
    {
        $year = session()->get('year');


        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();

        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));
        $sector=$request->get('sector');

        if (empty($request->from_date) && empty($sector)) {
            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.sector',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date) && isset($sector)){
            // dd($emp_name);
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('sector_id','=',$sector)->get();

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.sector',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('sector_id','=',$sector)->get();

            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.sector', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $year = session()->get('year');


        $tasks=  task::with('emp')->where('deleted_at','=',null)->where('tyear','=',$year)->get();


        $allemps = emp::with('department','administration','publicAdmin','user','job','sector')
            ->where('deleted_at','=',null)
            ->get();


        $holidays= holiday::with('emp','holidaytype')->where('deleted_at','=',null)->where('hyear','=',$year)->get();

        $officialHolidays= officialHoliday::with('attendance')->where('deleted_at','=',null)->where('oyear','=',$year)->get();

        $pers=  per::with('emp')->where('deleted_at','=',null)->where('pyear','=',$year)->get();

        $user =  user::all();


        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));
        $user=$request->get('user');

        if (empty($request->from_date) && empty($user)) {
            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.user',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        elseif(empty($request->from_date) && isset($user)){
            // dd($emp_name);
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('user_id','=',$user)->get();

            $attendances=  attendance::with('emp')->where('deleted_at','=',null)->where('ayear','=',$year)->get();
            return view('admin.reports.user',['title'=>trans('admin.show'),'tasks'=>$tasks,'attendances'=>$attendances,'allemps'=>$allemps,'holidays'=>$holidays,
                'officialHolidays'=>$officialHolidays,'pers'=>$pers,'user'=>$user]);

        }
        else{
            $allemps= emp::with('department','administration','publicAdmin','user','job','sector')->where('deleted_at','=',null)->where('user_id','=',$user)->get();

            $attendances = attendance::with('emp')->where('deleted_at', '=', null)->where('ayear','=',$year)->whereBetween('adate', [$from_date, $to_date])->get();
            return view('admin.reports.user', ['title' => trans('admin.show'), 'tasks' => $tasks, 'attendances' => $attendances, 'allemps' => $allemps, 'holidays' => $holidays,
                'officialHolidays' => $officialHolidays, 'pers' => $pers, 'user' => $user]);

        }

    }

}
