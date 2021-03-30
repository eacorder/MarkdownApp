<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Document::orderBy('created_at','DESC')->get();
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
        $newDocument = new Document;
        $newDocument->title = $request->doc['title'];
        $newDocument->author = $request->doc['author'];
        $newDocument->content = $request->doc['content'];
        $newDocument->tags = $request->doc['tags'];
        $newDocument->save();

        return $newDocument;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $existingDoc = Document::find( $id );
        if($existingDoc){ 
            return $existingDoc;
        }

        return "Document not found";        
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
        $existingDoc = Document::find( $id );
        if($existingDoc){ 
            $existingDoc->title = $request->doc['title'] ? $request->doc['title'] : $existingDoc->title  ;
            $existingDoc->author = $request->doc['author'] ? $request->doc['author'] : $existingDoc->author  ;
            $existingDoc->content = $request->doc['content'] ? $request->doc['content'] : $existingDoc->content  ; 
            $existingDoc->tags = $request->doc['tags'] ? $request->doc['tags'] : $existingDoc->tags  ;
            $existingDoc->save();
            return $existingDoc;
        }

        return "Document not found";
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
        $existingDoc = Document::find( $id );
        if($existingDoc){
            $existingDoc->delete();
            return "Document successfully deleted";
        }
        return "Document not found";
    }
}
