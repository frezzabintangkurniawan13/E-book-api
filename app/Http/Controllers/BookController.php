<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::get();

        return response()->json([
            'status' => 200,
            'data' => $book
        ], 200);
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
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'date_of_issue' => $request->date_of_issue
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Data berhasil disimpan.',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if($book) {
            return response()->json([
                'status' => 200,
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ID '. $id .' tidak ditemukan.'
            ], 404);
        }
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
        $book = Book::find($id);
        
        if($book) {
            $book->update([
                'title' => $request->title ? $request->title : $book->title,
                'description' => $request->description ? $request->description : $book->description,
                'author' => $request->author ? $request->author : $book->author,
                'publisher' => $request->publisher ? $request->publisher : $book->publisher,
                'date_of_issue' => $request->date_of_issue ? $request->date_of_issue : $book->date_of_issue
            ]);

            return response()->json([
                'status' => 203,
                'message' => 'Data berhasil diubah.',
                'data' => $book
            ], 203);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ID '. $id .' tidak ditemukan.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if($book) {
            $book->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil dihapus.',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ID '. $id .' tidak ditemukan.'
            ], 404);
        }
    }
}