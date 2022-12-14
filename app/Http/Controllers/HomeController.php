<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Models\User;
use App\Models\TutorClass;
use App\Models\Classes;
use App\Models\Sms;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Sets the language.
     *
     */
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id     = Auth::user()->id;
        $user   = Auth::user();

        /*
         *
         * Tutor begins
         */
        $isAdmin            =   $user->hasRole('admin');
        $isSuperAdmin       =   $user->hasRole('super-admin');
        $isTutor            =   $user->hasRole('tutor');
        $isStudent          =   $user->hasRole('student');
        
        $noRole=0;

        if ($isTutor) {
            $noRole=1;

            $students       =   User::with('student')
                ->LeftJoin('students', 'students.user_id', '=', 'users.id');
            $students       =   $students->where('tutor_students.tutor_id', $id)
                //->Join('tutors', 'tutors.user_id', '=', 'users.id')
                ->Join('tutor_students', 'tutor_students.tutor_id', '=', 'users.id');
            $students       =   $students->count();
            
            $studentInfo    =   DB::table('students')
                ->Join('users', 'students.user_id', '=', 'users.id')
                ->Join('tutor_students', 'tutor_students.user_id', '=', 'users.id')
                ->where('tutor_students.tutor_id', $id)
                ->leftJoin('courses', 'students.course_id', '=', 'courses.id')
                ->select(['users.*','users.name as tutor_name','students.display_name', 'courses.course'])
                ->limit(10)
                ->orderBy('users.created_at', 'desc')
                ->get();
          
            $tutorClass =   TutorClass::leftJoin('users', 'classes.student_user_id', '=', 'users.id')
                ->LeftJoin('students', 'students.user_id', '=', 'classes.student_user_id');
            $tutorClass =   $tutorClass->select(['classes.*', 'students.display_name', 'users.name', DB::raw('DATE_FORMAT(classes.date, "%d-%b-%Y") as date')]);
            $tutorClass =   $tutorClass->where('tutor_user_id', $id);
            $tutorClass =   $tutorClass->limit(10)->orderBy('users.created_at', 'desc')->get();

            $sms        =   DB::table('sms')
                ->select('sms.*', 'students.display_name', 'users.name', DB::raw('DATE_FORMAT(sms.sent_on, "%d-%b-%Y %h:%i:%s") as sent_on'))
                ->leftjoin('users', 'users.id', '=', 'sms.from_user_id')
                ->LeftJoin('students', 'students.user_id', '=', 'sms.from_user_id');
            $sms        =   $sms->where('to_user_id', $id);
            $sms        =   $sms->limit(10)->orderby('sent_on', 'desc')->get();
            
            return view('dashboard.tutor', compact('students', 'studentInfo', 'tutorClass', 'sms'));
        }
        /* Tutor ends
         *
         *
         */



        /*
          * Student begins   
          *
          */


        if ($isStudent) {
            $noRole=1;

            $classes        =   DB::table('classes')->where('classes.student_user_id', $id);
            $classes        =   $classes->count();

            $feesDue        =   DB::table('classes')
                                        ->select("currencies.code",DB::raw('sum(class_fee) as class_fee'))
                                        ->Join('currencies', 'classes.currency_id', '=', 'currencies.id')
                                        ->where('classes.student_user_id', $id)
                                        ->where("is_paid","0")
                                        ->groupBy("currency_id");
            $feesDue        =   $feesDue->get();

            $credits        =    User::with('student')
                ->Join('students', 'students.user_id', '=', 'users.id')
                ->where('students.user_id', $id)
                ->sum('credits');

            $tutorClass     =   TutorClass::leftJoin('users', 'classes.student_user_id', '=', 'users.id');
            $tutorClass     =   $tutorClass->select(['classes.*', 'users.name', DB::raw('DATE_FORMAT(classes.date, "%d-%b-%Y") as date')]);
            $tutorClass     =   $tutorClass->where('student_user_id', $id);
            $tutorClass     =   $tutorClass->limit(10)->orderBy('users.created_at', 'desc')->get();

            $paymentHistoryHis =    User::with('student')
            ->Join('payment_histories', 'payment_histories.student_user_id', '=', 'users.id')
            ->where('payment_histories.student_user_id', $id)
            ->select('payment_histories.amount','payment_histories.no_of_classes','payment_histories.status',DB::raw('DATE_FORMAT(payment_histories.payment_date, "%d-%b-%Y %h:%i:%s") as payment_date'),
            'payment_histories.created_at as created_at');

            $paymentHistory = User::with('student')
            ->Join('students', 'students.user_id', '=', 'users.id')
            ->where('students.user_id', $id)
            ->select('students.regfee as amount',DB::raw("'-' as no_of_classes"),DB::raw("'paid' as status"),
                    DB::raw('DATE_FORMAT(students.regfee_date, "%d-%b-%Y %h:%i:%s") as payment_date'),
                    'students.regfee_date as created_at'
                    )
            ->union($paymentHistoryHis)
            ->orderby('created_at', 'desc')
            ->limit(10)
            ->get();


            $sms            =   DB::table('sms')
                ->select('sms.*', 'users.name', 'tutors.display_name', DB::raw('DATE_FORMAT(sms.sent_on, "%d-%b-%Y %h:%i:%s") as sent_on'))
                ->leftjoin('users', 'users.id', '=', 'sms.from_user_id')
                ->LeftJoin('tutors', 'tutors.user_id', '=', 'sms.from_user_id');
            $sms            =   $sms->where('to_user_id', $id);
            $sms            =   $sms->limit(10)->orderby('sent_on', 'desc')->get();


            return view('dashboard.student', compact('classes', 'feesDue', 'credits', 'paymentHistory', 'tutorClass', 'sms'));
        }

        /* Student ends
         *
         *
         */



        /*
          * Admin begins   
          *
          */
        if ($isAdmin || $isSuperAdmin) {

            $noRole=1;

            $feesDue        =   DB::table('classes')->select("currencies.code",DB::raw('sum(class_fee) as class_fee'))
                                    ->Join('currencies', 'classes.currency_id', '=', 'currencies.id')
                                    ->where("is_paid",'0')->groupBy("currency_id");
            $feesDue        =   $feesDue->get();
           
            $credits        =    User::with('student')
                ->Join('students', 'students.user_id', '=', 'users.id')
                ->sum('credits');

            $students       =   User::with('student')
                ->Join('students', 'students.user_id', '=', 'users.id')
                ->where('user_type_id', 4)
                ->where("is_active",'1');
            //$students       =   $students->Join('tutors', 'tutors.user_id', '=', 'users.id')
            //->Join('tutor_students', 'tutor_students.tutor_id', '=', 'users.id');
            $students       =   $students->count();

            $classes        =   DB::table('classes');
            $classes        =   $classes->count();

            $studentInfo    =   DB::table('users')
                ->join('countries', 'users.country_id', '=', 'countries.id')
                ->LeftJoin('students', 'students.user_id', '=', 'users.id')
                ->LeftJoin('tutors', 'tutors.user_id', '=', 'users.id')
                ->LeftJoin('tutor_students', 'tutor_students.user_id', '=', 'users.id')
                ->leftJoin('courses', 'students.course_id', '=', 'courses.id')
                ->select(['users.*','users.name as tutor_name' ,'students.display_name', 'courses.course', 'countries.name AS country_name', DB::raw('CONCAT(countries.phone_code," ",users.phone) as phone')])
                ->limit(10)
                ->where("users.is_active",'1')
                ->where("users.user_type_id",'4')
                ->orderBy('users.id', 'desc')
                ->get();
            

            $sms            =   DB::table('sms')
                ->select('sms.*', 'users.name', 'students.display_name as student_displayname', 'tutors.display_name as tutor_displayname', DB::raw('DATE_FORMAT(sms.sent_on, "%d-%b-%Y %h:%i:%s") as sent_on'))
                ->leftjoin('users', 'users.id', '=', 'sms.from_user_id')
                ->LeftJoin('students', 'students.user_id', '=', 'sms.from_user_id')
                ->LeftJoin('tutors', 'tutors.user_id', '=', 'sms.from_user_id')
                ->orderBy('sms.id','desc');
            $sms            =   $sms->where('to_user_id', $id);
            $sms            =   $sms->limit(10)->orderby('sent_on', 'desc')->get();

            
            $tutorClass     =   TutorClass::leftJoin('users as student_user', 'student_user.id', '=', 'classes.student_user_id')
                ->leftjoin('users as tutor_user', 'tutor_user.id', '=', 'classes.tutor_user_id')
                ->leftjoin('students', 'students.user_id', '=', 'classes.student_user_id')
                ->leftjoin('tutors', 'tutors.user_id', '=', 'classes.tutor_user_id')
                ->leftjoin('courses', 'courses.id', '=', 'students.course_id')
                ->select(['classes.*', 'student_user.name as student_name', 'tutor_user.name as tutor_name', 'students.display_name as student_displayname', 'tutors.display_name as tutor_displayname', 'courses.course', DB::raw('DATE_FORMAT(classes.date, "%d-%b-%Y") as date')])
                ->limit(10)->orderBy('classes.created_at', 'desc')->get();
            foreach ($tutorClass as $class) {

                $class->tutor_displayname = $class->tutor_displayname . "(" . $class->tutor_name . ")";
                $class->student_displayname = $class->student_displayname . "(" . $class->student_name . ")";
            }
            //echo $tutorClass;exit;
            return view('dashboard.admin', compact('classes', 'feesDue', 'credits', 'students', 'studentInfo', 'sms', 'tutorClass'));
        }

        /*
          * Admin ends   
          *
          */

        /*
           *
           * Default
           */

           if($noRole==0)
           {
            $currency_id                =   DB::table('students')->select('currency_id')->where('user_id',$id) ->get()->first();
            $registration_fee_type      =   DB::table('students')->select('registration_fee_type')->where('user_id',$id) ->get()->first();
            $currency_code              =   DB::table('currencies')->select('code')->where('id',$currency_id->currency_id) ->get()->first();
            $student_currency           =   $currency_code->code;
            $registration_fee_type      =   $registration_fee_type->registration_fee_type;
            if($registration_fee_type == 'Free'){
                $fee_pay                =   0;
            }else{
                $fee_query              =   DB::table('settings')->select('value')->where('id',4) ->get()->first();
                $fee_pay                =   @$fee_query->value;
            }
            return view('home', compact('student_currency','fee_pay','registration_fee_type'));
          
           }
        return view('home');
    }
    
}
