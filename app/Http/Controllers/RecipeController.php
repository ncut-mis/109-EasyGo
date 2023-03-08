<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::orderBy('id','DESC')->get();//取得資料庫中的欄位值，以陣列的方式

        $data=[
            'recipes'=>$recipes
        ];
        return view('blog.new',$data);
    }
    public function china()
    {
        return view('blog.china');
    }
    public function western()
    {
        return view('blog.western');
    }
    public function japan()
    {
        return view('blog.japan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }
    public function recipe(Recipe $recipe)
    {

        $recipe_imgs=RecipeImg::where('recipe_id','=',$recipe->id)->get();
        $data=[
            'recipe'=>$recipe,
            'recipte_img'=>$recipe_imgs,


        ];
        return view('recipe.recipe', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFields(Request $request)
    {
        $html = view('partials.input-field')->render();
        return response()->json(['html' => $html]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
