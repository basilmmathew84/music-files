<?php

namespace App\Http\Controllers;
use App\Models\TutorEnquiry;
use DataTables;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Str;



class TutorEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data  = DB::table('tutor_enquiries')
            ->join('countries', 'tutor_enquiries.country_id', '=', 'countries.id')
            ->select(['tutor_enquiries.*','countries.name AS country_name',DB::raw('CONCAT(countries.code," ",tutor_enquiries.phone) as phone')])
            ->get();
           

           $datatable =  DataTables::of($data)
               ->filter(function ($instance) use ($request) {
                   if ($request->has('keyword') && $request->get('keyword')) {
                       $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains(Str::lower($row['phone'] . $row['email'] . $row['name'] ), Str::lower($request->get('keyword'))) ? true : false;
                       });
                   }
                  
               })
               ->addIndexColumn()
               ->addColumn('action', function ($tutor) {
                   return view('tutor_enquiry.datatable', compact('tutor'));
               })
               ->rawColumns(['action'])
               ->make(true);
           //dd($datatable);
           return $datatable;
       }

       $tutor = TutorEnquiry::paginate(25);
       return view('tutor_enquiry.index', compact('tutor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutor = DB::table('tutor_enquiries')->where('tutor_enquiries.id',$id)
        ->leftJoin('countries', 'tutor_enquiries.country_id', '=', 'countries.id')
        ->select(['tutor_enquiries.*','countries.name AS country_name','tutor_enquiries.dob',DB::raw('DATE_FORMAT(tutor_enquiries.dob, "%d-%m-%y") as dob'),DB::raw('CONCAT(countries.code," ",tutor_enquiries.phone) as phone')])
        ->first();
       // 
       
        $tutor->teaching_stream=($tutor->teaching_stream)?$tutor->teaching_stream:'-';
        $tutor->educational_qualification=($tutor->educational_qualification)?$tutor->educational_qualification:'-';
        $tutor->teaching_experience=($tutor->teaching_experience)?$tutor->teaching_experience:'-';
        $tutor->performance_experience=($tutor->performance_experience)?$tutor->performance_experience:'-';
        $tutor->other_details=($tutor->other_details)?$tutor->other_details:'-';
            

        return view('tutor_enquiry.show', compact('tutor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}