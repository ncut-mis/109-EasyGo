<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeImg;
use App\Models\RecipeStep;
use App\Models\Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloggerRecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recipes()
    {
//        return view('bloggers.recipes.create');
    }

    public function index()
    {
//        return view('bloggers.recipes');
    }

    //下架食譜
    public function stop(Recipe $recipe)
    {
        $recipe->update(['status'=>0]);
        return redirect()->route('members.recipes');
    }
    //上架食譜
    public function launch(Recipe $recipe)
    {
        $recipe->update(['status'=>1]);
        return redirect()->route('members.recipes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bloggers.recipes.create');
    }

    public function create2()
    {
        return view('bloggers.recipes.create2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function edit(Recipe $recipe)
    {
        $recipe_imgs=RecipeImg::where('recipe_id','=',$recipe->id)->get();//圖片
        $recipe_categories=RecipeCategory::orderBy('id','DESC')->get();//食譜類別
        $recipe_ingredients=Ingredient::where('recipe_id','=',$recipe->id)->get();//食材
        $recipe_steps=RecipeStep::where('recipe_id','=',$recipe->id)->get();//步驟
        $data = [
            'recipe' => $recipe,
            'recipe_imgs'=>$recipe_imgs,
//            'suggests'=>$suggests,
            'recipe_ingredients'=>$recipe_ingredients,
            'recipe_categories'=>$recipe_categories,
            'recipe_steps'=>$recipe_steps,
        ];
        return view('bloggers.recipes.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
