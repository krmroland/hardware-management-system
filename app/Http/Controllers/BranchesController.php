<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::getSummary();

        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Branch::create($request->validate(['name' => 'required|unique:branches']));

        flash('Branch added successfully');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Branch $branch
     *
     * @return \Illuminate\Http\Response
     */
    public function show($branch)
    {
        $branch = Branch::getDataById($branch);

        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Branch $branch
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Branch              $branch
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Branch $branch
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
    }
}
