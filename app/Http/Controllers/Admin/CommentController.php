<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     const PATH_VIEW = 'admin.compoents.comments.';
    public function index()
    {

        $data = Comment::with('post', 'user')->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        return back();
    }

    public function trash_can(){
        $deletedComments = Comment::onlyTrashed()->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('deletedComments'));
    }

    public function restore($id){
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->restore();
        return redirect()->route('admin.compoents.comments.index');
    }
}
