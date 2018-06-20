<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$recipes = Recipe::all();
        //$recipes = Recipe::orderBy('title', desc)->get();

        $recipes = Recipe::orderBy('created_at', 'desc')->paginate(10);
        return view('recipes.index')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999' //max size 1999, cuz Apache servers might reject anaything bigger
        ]);

        // Handle image
        if($request->hasFile('cover_img')) {
            // Get filename eith extensions
            $fileNameWithExt = $request->file('cover_img')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_img')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Publish recipe
        $recipe = new Recipe;
        $recipe->title = $request->input('title');
        $recipe->body = $request->input('body');
        $recipe->user_id = auth()->user()->id;
        $recipe->cover_img = $fileNameToStore;
        $recipe->save();

        return redirect('/recipes')->with('success', 'Recipe Published');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.edit')->with('recipe', $recipe);
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
        // Publish recipe
        $recipe = Recipe::find($id);
        $recipe->title = $request->input('title');
        $recipe->body = $request->input('body');
        $recipe->save();

        return redirect('/recipes')->with('success', 'Recipe Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe-> delete();
        return redirect('/recipes')->with('success', 'Recipe Removed');
    }
}
