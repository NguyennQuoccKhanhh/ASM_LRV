<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use Illuminate\Http\Request;

class CatelogueController extends Controller
{
    const PATH_VIEW = 'admin.compoents.catelogues.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catelogue::query()->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Catelogue::query()->create($request->all());

        return redirect()->route('admin.compoents.catelogues.index')->with('success', 'Catelogue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Catelogue::query()->findOrFail($id);
        $model->update($request->all());

        return redirect()->route('admin.compoents.catelogues.index');
        // return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catelogue = Catelogue::findOrFail($id);
        $catelogue->delete();
        return back();
    }

    public function trash_can(){
        $deletedCatelogues = Catelogue::onlyTrashed()->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('deletedCatelogues'));
    }

    public function restore($id){
        $catelogue = Catelogue::withTrashed()->findOrFail($id);
        $catelogue->restore();
        return redirect()->route('admin.compoents.catelogues.index');
    }

}
