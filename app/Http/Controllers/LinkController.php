<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Http\Requests\LinkRequest;

class LinkController extends Controller
{

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::where('user_id', $this->auth->user()->id)->get();
        return view('links.index')->with('links', $links);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request)
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
        //
    }
}
