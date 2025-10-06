<?php

namespace App\Http\Controllers;

use App\Models\resourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $resourses = Resourse::latest()->where('user_id', $user_id)->paginate(10); 
        return view('resourses.index', compact('resourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resourses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $user_id = Auth::id();
        Resourse::create([
            'name' => $request['name'],
            'user_id' => $user_id,
        ]);
        return redirect()->route('resourses.index')->with('success', 'Создан ресурс!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resourse $resourse)
    {
        return view('resourses.show', compact('resourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(resourse $resourse)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, resourse $resourse)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resourse $resourse)
    {
        $resourse->delete();

        return redirect()->route('resourses.index')->with('success', 'Ресурс удален!');
    }
}
