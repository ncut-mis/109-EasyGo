<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\RecipeImg;
use App\Models\Ingredient;
use App\Models\Member;
use App\Models\User;
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
        $recipes=Recipe::orderBy('id','DESC')->get();

        $rsp_recipes = array();

        foreach ($recipes as $recipe)
        {
            $recipe_imgs=RecipeImg::where('recipe_id','=',$recipe->id)->get();

            $recipe->picture = $recipe_imgs[0]->picture;

            array_push($rsp_recipes, $recipe);
        }

        $data=[
            'recipes'=>$rsp_recipes
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
    public function recipe(Request $request)
    {
        $id = $request->input('id');

        $recipe=Recipe::where('id','=',$id)->get();
        $recipe_imgs=RecipeImg::where('recipe_id','=',$id)->get();
        $ingredients=Ingredient::where('recipe_id','=',$id)->get();

        $all_comments=Comment::where('recipe_id','=',$id)->get();

        $rsp_comments = array();

        foreach ($all_comments as $comment)
        {
            $member_info=Member::where('id','=',$comment->member_id)->get();
            $user_info=User::where('id','=',$member_info[0]->user_id)->get();

            $comment->nickname = $member_info[0]->nickname;
            $comment->fullname = $user_info[0]->name;

            array_push($rsp_comments, $comment);
        }

        $data=[
            'recipe'=>$recipe,

            'recipe_img'=>$recipe_imgs,
            'ingredients'=>$ingredients,
            'comments'=>$rsp_comments,
        ];

        //print_r($data);

        return view('recipe.recipe', $data);
    }

    public function leave_message(Request $request)
    {
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
