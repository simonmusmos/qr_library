<?php

namespace App\Http\Controllers;

use App\Models\QrDefinition;
use App\Models\Student;
use App\Models\StudentLog;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('manage-student')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::create([
            'student_name' => $request->name,
            'student_number' => $request->number,
            'qr_code' => ''
        ]);

        $QrDefinition = QrDefinition::create([
            'parent_id' => $student->id,
            'type' => "student",
        ]);   

        // $image = QrCode::format('png')
        //          ->size(200)->errorCorrection('H')
        //          ->generate(json_encode(["type" => "student", "id" => $student->id]));
        $image = QrCode::format('png')
                 ->size(200)->errorCorrection('H')
                 ->generate(Crypt::encryptString($QrDefinition->id));
        $folder = '/images/qr-code/';
        $output_file = 'img-' . time() . '.png';
        Storage::disk('public')->put($folder . $output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png

        $student->update([
            'qr_code' => $output_file
        ]);
        
        echo json_encode(Array('result' => true, 'qr' => $output_file));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $decrypt= Crypt::decryptString($request->token);
        // echo json_encode(Array('result' => true, 'data' => $request->type));
        $QrDefinition = QrDefinition::where('id',$decrypt)->first();
        $info = "";

        if($QrDefinition->type == "student"){
            $logs = StudentLog::where("student_id", $QrDefinition->parent_id)->get();
            $status = "logout";
            if($logs->count() == 0 || ($logs->count() % 2) == 0){
                $status = "login";
            }

            StudentLog::create([
                "student_id" => $QrDefinition->parent_id,
                "type" => $status
            ]);

            echo json_encode(Array('result' => true, "status" => $status));
        }else{
            echo json_encode(Array('result' => false, "message" => "Unindentified QR Code."));
        }
    }

    public function viewLogs(Request $request){

        if(isset($request->student) && $request->student != 0){
            $all = false;
            $logs = StudentLog::where("student_id", $request->student)->orderBy("id", "DESC")->paginate(20);
        }else{
            $all = true;
            $logs = StudentLog::orderBy("id", "DESC")->paginate(20);
        }

        
        return view('view-logs', ['logs' => $logs, 'all' => $all]);
    }
}
