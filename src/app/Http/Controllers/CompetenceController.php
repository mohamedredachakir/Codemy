<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences = Competence::all();
        return view('competences.index', compact('competences'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('competences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'code' => 'required|integer',
            'label' => 'required'
        ]);

        $competence = Competence::create($validate);
        if($competence){
            return redirect()->route('competences.index')->with('success', 'competence created!!');
        }else { return "error! register competence failed!";}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $competence = Competence::with(['sprints'])->find($id);
        return view('competences.show',compact('competence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->isAdmin()){
        return redirect()->route('/')
            ->with('error','No access');
        }

        $competence = Competence::with(['sprints'])->find($id);
        return view('competences.edit', compact('competence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->isAdmin()){
        return redirect()->route('/')
            ->with('error','No access');
        }

        $competence = Competence::find($id);
        $validate = $request->validate([
            'code' => 'required|integer',
            'label' => 'required'
        ]);
        $competence->update($validate);
        return redirect()->route('competences.index')->with('success', 'competence updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->isAdmin()){
        return redirect()->route('/')
            ->with('error','No access');
        }

        Competence::find($id)->delete();
        return redirect()->route('competences.index')->with('success', 'competence deleted!!');
    }
}
