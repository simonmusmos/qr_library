<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $image = QrCode::format('png')
                 ->size(200)->errorCorrection('H')
                 ->generate(json_encode(["type" => "book", "id" => $book->id]));
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
}
