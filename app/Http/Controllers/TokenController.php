<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tokens = auth()->user()->tokens()
            ->paginate(5);
        return view('tokens.list',[
            'tokens' => $tokens,
        ]);
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
        $attributes = $request->validate([
           'title' => 'required|min:3|max:255'
        ]);

        $token = auth()->user()->createToken($attributes['title']);

        return back()->with([
           'success' => __('Your token has been created'),
           'token' => $token->plainTextToken,
        ]);


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
    public function destroy($token)
    {
       auth()->user()->tokens()->where('id', $token)->delete();

       return back()->with('success', __('Token has been revoked'));
    }
}
