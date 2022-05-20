<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::whereNotNull('id');

        //Searching
        $keyword = $request->search;
        if($keyword) {
            $students = $students->where("name", "like", "%$keyword%")
                    ->orWhere("dob", "like", "%$keyword%")
                    ->orWhere("email", "like", "%$keyword%")
                    ->orWhere("nrc", "like", "%$keyword%")
                    ->orWhere("course", "like", "%$keyword%");
                    
        }

        //Filter

        $name_filter = $request->name;
        $dob_filter = $request->dob;
        $email_filter = $request->email;
        $nrc_filter = $request->nrc;
        $course_filters = $request->course ? explode(',', $request->course) : '';
        if($name_filter) {
            $students = $students->where("name", "like", "%$name_filter%");
        }
        if($dob_filter) {
            $students = $students->whereDate("dob", $dob_filter);
        }
        if($email_filter) {
            
            $students = $students->where("email", "like", "%$email_filter%");
        }
        if($nrc_filter) {
            
            $students = $students->where("nrc", "like", "%$nrc_filter%");
        }
        if($course_filters) {
            
            foreach($course_filters as $course_filter) {
                $students = $students->where("course", "like", "%$course_filter%");
            }
            
        }

        // dd($students);


        // Sorting
        if($request->name_sort) {
            $students = $students->orderBy('name', $request->name_sort);
        }

        if($request->dob_sort) {
            $students = $students->orderBy('dob', $request->dob_sort);
        }

        if($request->email_sort) {
            $students = $students->orderBy('email', $request->email_sort);
        }

        if($request->nrc_sort) {
            $students = $students->orderBy('nrc', $request->nrc_sort);
        }

        if($request->course_sort) {
            $students = $students->orderBy('course', $request->course_sort);
        }        

        $students = $students->get(); 
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except('_token');
        $name = $request->name;
        $dob = $request->dob;
        $email = $request->email;
        $nrc_first = $request->nrc[0];
        $nrc_second = $request->nrc[1];
        $nrc_third = $request->nrc[2];
        $nrc = $nrc_first."/".$nrc_second.$nrc_third;  
        $data['nrc'] = $nrc;
        
        $data['course'] = json_encode($request->course);
        // dd($data);

        $students = DB::table('students')->insert($data);
        // dd($students);
        return redirect('/student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
