<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Http\Requests\LinkRequest;
use Illuminate\View\View;
use App\Helpers\KeyGenerator;
use Carbon\Carbon;

class ShortLinkController extends Controller
{

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
        $this->generator = new KeyGenerator();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $links = ShortLink::where('user_id', $this->auth->user()->id)
            ->latest()
            ->get();
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

        $validated = $request->validated();

        ShortLink::create([
            'url' => $validated['url'],
            'short_url'=> $this->generator->generateRandom(),
            'user_id'=> $this->auth->user()->id,
            'expiry_at' => Carbon::now()->addDays()
         ]);

        return redirect()->route('links.index')->with('success', 'Short link created successfully.');
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
    public function edit(ShortLink $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LinkRequest $request, int $id)
    {
        $validated = $request->validated();

        $link = ShortLink::where('id', $id)->update([
            'url' => $validated['url'], 
            'expiry_at' => Carbon::now()->addDays(), 
            'short_url'=> $this->generator->generateRandom()
        ]);

        return redirect()->route('links.index')->with('success', 'Short link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortLink $link)
    {
        $user = $this->auth->user();
        if ($user && $user->id == $link->user_id) {
            $link->delete();
        }
        return redirect()->route('links.index')
        ->with('success', 'Link deleted successfully.');
    }
}
