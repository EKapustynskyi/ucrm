<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Http\Request;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Doc::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doc = new \App\Models\Doc();
        $doc->docs_hash = $request->docs_hash;
        $doc->docs_name = $request->docs_name;
        $doc->abstract = $request->abstract;
        $doc->docs_path = $request->docs_path;
        // var_dump($doc);
        // die;

        $doc->save();

        return response()->json(['status' => 'created', 'doc_id' => $doc->docs_id], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Doc::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doc $doc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Doc $doc)
    public function update(Request $request, $id)
    {
        $doc = Doc::findOrFail($id);
        $doc->update($request->all());
        return response()->json($doc);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Doc $doc)
    public function destroy($id)
    {
        Doc::destroy($id);
        return response()->json(null, 204);
    }
}
