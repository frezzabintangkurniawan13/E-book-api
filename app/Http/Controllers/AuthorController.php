<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::get();

        return response()->json([
            'status' => 200,
            'data' => $author
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
        $author = Author::create([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'place_of_birth' => $request->place_of_birth,
            'gender' => $request->gender,
            'email' => $request->email,
            'hp' => $request->hp
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Data berhasil disimpan.',
            'data' => $author
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
        $author = Author::find($id);

        if($author) {
            return response()->json([
                'status' => 200,
                'data' => $author
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
        $author = Author::find($id);
        
        if($author) {
            $author->update([
                'name' => $request->name ? $request->name : $author->name,
                'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : $author->date_of_birth,
                'place_of_birth' => $request->place_of_birth ? $request->place_of_birth : $author->place_of_birth,
                'gender' => $request->gender ? $request->gender : $author->gender,
                'email' => $request->email ? $request->email : $author->email,
                'hp' => $request->hp ? $request->hp : $author->hp
            ]);

            return response()->json([
                'status' => 203,
                'message' => 'Data berhasil diubah.',
                'data' => $author
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
        $author = Author::find($id);

        if($author) {
            $author->delete();

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