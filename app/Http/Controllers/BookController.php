<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowLog;
use App\Models\QrDefinition;
use App\Models\Student;
use App\Models\StudentLog;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('manage-book')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'book_title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'qr_code' => ''
        ]);
        
        $QrDefinition = QrDefinition::create([
            'parent_id' => $book->id,
            'type' => "book",
        ]);
        // echo json_encode(Array('result' => true, 'book' => $book->id));
        // $image = QrCode::format('png')
        //          ->size(200)->errorCorrection('H')
        //          ->generate(json_encode(["type" => "book", "id" => $book->id]));
        $image = QrCode::format('png')
                 ->size(200)->errorCorrection('H')
                 ->generate(Crypt::encryptString($QrDefinition->id));
        $folder = '/images/qr-code/';
        $output_file = 'img-' . time() . '.png';
        Storage::disk('public')->put($folder . $output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png

        $book->update([
            'qr_code' => $output_file
        ]);
        
        echo json_encode(Array('result' => true, 'qr' => $output_file));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    public function borrow()
    {
        return view('borrow-book');
    }

    public function borrowAction(Request $request)
    {
        $related_borrowed_books = BorrowLog::where('book_id', $request->book_id)->orderBy("id", "DESC")->first();
        if(empty($related_borrowed_books) || $related_borrowed_books->is_returned == 1){
            BorrowLog::create([
                "book_id" => $request->book_id,
                "student_id" => $request->student_id,
                "is_returned" => 0
            ]);
            echo json_encode(Array('result' => true));
        }else{
            echo json_encode(Array('result' => false, 'message' => 'Book is already borrowed.'));
        }
    }

    public function return()
    {
        return view('return-book');
    }

    public function returnAction(Request $request)
    {
        $related_borrowed_books = BorrowLog::where('book_id', $request->book_id)->orderBy("id", "DESC")->first();
        if(empty($related_borrowed_books) || $related_borrowed_books->is_returned == 1){
            echo json_encode(Array('result' => false, 'message' => 'Book is not yet borrowed.'));
        }else{
            BorrowLog::create([
                "book_id" => $request->book_id,
                "student_id" => $related_borrowed_books->student_id,
                "is_returned" => 1
            ]);
            echo json_encode(Array('result' => true));
        }
    }

    public function getInfo(Request $request)
    {
        $decrypt= Crypt::decryptString($request->token);
        // echo json_encode(Array('result' => true, 'data' => $request->type));
        $QrDefinition = QrDefinition::where('id',$decrypt)->first();
        $info = "";
        if($QrDefinition->type == "book"){
            $info = $this->getBookInfo($QrDefinition->parent_id);
        }
        else if($QrDefinition->type == "student"){
            $info = $this->getStudentInfo($QrDefinition->parent_id);
        }
        
        if($info != ""){
            if($QrDefinition->type == $request->type){
                echo json_encode(Array('result' => true, 'data' => $info));
            }else{
                echo json_encode(Array('result' => false));
            }
            
        }else{
            echo json_encode(Array('result' => false));
        }
        
    }

    public function getBookInfo($book){
        $book_info = Book::where('id',$book)->first();
        return $book_info;
    }

    public function getStudentInfo($student){
        $student_info = Student::where('id',$student)->first();
        return $student_info;
    }

    public function viewLogs(Request $request){
        $all = false;
        $is_student = false;
        $is_book = false;
        if($request->book != 0 && isset($request->book)){
            $logs = BorrowLog::where("book_id", $request->book)->orderBy("id", "DESC")->paginate(20);
            $is_book = true;
        }elseif($request->student != 0 && isset($request->student)){
            $logs = BorrowLog::where("student_id", $request->student)->orderBy("id", "DESC")->paginate(20);
            $is_student = true;
        }else{
            $logs = BorrowLog::orderBy("id", "DESC")->paginate(20);
            $all = true;
        }
        // dd($logs);
        return view('book-logs',['logs' => $logs, 'all' => $all, 'is_student' => $is_student, 'is_book' => $is_book]);
    }

    public function export() 
    {
        $book_arr = [];

        $books = Book::get();

        foreach($books as $book){
            $book_arr[] = Array(
                $book->id, $book->book_title, $book->author, $book->isbn
            );
        }
          
        return Excel::download(new BooksExport($book_arr), 'book list ('. date("YmdHms") .').xlsx');
    }
}
