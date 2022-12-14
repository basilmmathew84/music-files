<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\Course;
use App\Models\Currency;
use App\Models\Student;
use App\Models\Settings;
use Illuminate\Http\Request;
use Exception;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;


class StudentsRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   
    }

    
    /**
     * Show the form for creating a new student.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $nationalities  = Country::pluck('name', 'id')->all();
        $courses        = Course::pluck('course', 'id')->all();
        $currency       = Currency::select(['symbol','code', 'id'])->get();
        return view('students_reg.create', compact('nationalities','courses','currency'));
    }

    /**
     * Store a new student in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       
        $data = $this->getData($request);

         //Check Whatsapp number Duplication
         $user_whatsapp = User::where('phone', '=', $request->whatsapp_number)
         ->orWhere('whatsapp_number', '=', $request->whatsapp_number)->first();

        if($user_whatsapp)
        $check_whatsapp=1;
        else
        $check_whatsapp=0;

        if($check_whatsapp==1)
        {
            return redirect()->back()->withInput()->withErrors("Whatsapp Number Already Exist");
        }
        
        $data['whatsapp_number']          = $request->whatsapp_number;
        $data['password']       = Hash::make($data['password']); //Encrypting password
        $data['country_id']     = $data['country']; //country
        $data['state']          = $request->state;
        $data['address']        = $request->address;
        if($data['dob'])    
            $data['dob']            = Carbon::createFromFormat('d-m-Y',$request->dob)->format('Y-m-d');        
        $data['user_type_id']   = 4;
        $data['is_active']      =  $request->status?$request->status:0; 
        if ($request->hasFile('profile_image')) {

            $profile_image_path = $request->file('profile_image')->store('students/profile');
            $data['profile_image'] =  $profile_image_path;
        }
        User::create($data);
        
        $newuser = User::where('email', '=', $data['email'])->where('user_type_id', 4)->first()->toArray();
        $student['user_id']        =  $newuser['id'];
        $student['display_name']        =$request->name;
        $student['country_id']     =  $data['country'];
        $student['mode_of_remittance']     =  $request['remittance'];
        $student['course_id']      =  $request->course;
       // $student['currency_id']    =  $request->currency;
        $student['class_fee']      =  0;
        $student['is_registered']  =  0;
        //$student['is_active']      =  0;
        Student::create($student);

        $details = [
            'subject' =>    config('adminlte.title').' Registration',
            'content' =>    __('adminlte::adminlte.thankyou_registration'),
            'details' =>    'Student details below',
            'name'    =>    $request->name,
            'email'   =>    $data['email'],
            'phone'   =>    $request->whatsapp_number,
            'login'   =>    false
        ];
        \Mail::to($data['email'])->send(new \App\Mail\StudentRegistrationMail($details));

        $adminInfo =   Settings::find(2);

        $details = [
            'subject' =>    config('adminlte.title').' Registration',
            'content' =>    __('adminlte::adminlte.thankyou_registration_admin'),
            'details' =>    'Student details below',
            'name'    =>    $request->name,
            'email'   =>    $data['email'],
            'phone'   =>    $request->whatsapp_number,
            'login'   =>    false
        ];

        \Mail::to($adminInfo['value'])->send(new \App\Mail\StudentRegistrationMail($details));


        return Redirect::to('thankyou')->with('success_message',"Registration Successful");;

    }


    /**
     * Show the form for creating a new student.
     *
     * @return Illuminate\View\View
     */
    public function thankyou()
    {
        $nationalities  = Country::pluck('name', 'id')->all();
        $courses        = Course::pluck('course', 'id')->all();
        $currency       = Currency::select(['symbol','code', 'id'])->get();
        

        return view('thankyou.thankyou', compact('nationalities','courses','currency'));
    }
 
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request, $id = 0)
    {

        $rules = [
            'name' => 'required|string|min:1|max:255',
            'remittance'=>'required',
            'email' => [
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique('users')->where(function ($query) {
                }),
            ],
            'phone' => [
                
                Rule::unique('users')->where(function ($query) {
                }),
            ],
            'password' => 'string|min:8|max:255',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'country' => 'nullable',
            'profile_image' => 'nullable|mimes:jpg,jpeg,png|max:5120',
        
        ];

        //Validating unique for update ignoring the same record
        if ($id) {
            $rules = array_merge($rules,[
                'email' => [
                    'regex:/(.+)@(.+)\.(.+)/i',
                    Rule::unique('users')->ignore($id)->where(function ($query) {
                    }),
                ],
                'phone' => [
                  //  'digits:10',
                    Rule::unique('users')->ignore($id)->where(function ($query) {
                    }),
                ],
                'password' => 'nullable|string|min:8g|max:255',
            ]);
        }
        
        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }
}
