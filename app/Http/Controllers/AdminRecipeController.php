<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRecipeController extends Controller
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

        return view('admins.recipes.index',$data);
    }

    //下架食譜
    public function stop(Recipe $recipe)
    {
        $recipe->update(['status'=>0]);
        return redirect()->route('admins.recipes.index');
    }
    //上架食譜
    public function launch(Recipe $recipe)
    {
        $recipe->update(['status'=>1]);
        return redirect()->route('admins.recipes.index');
    }

    //寫食譜頁面(基本)
    public function create()
    {
        $recipe_categories=RecipeCategory::orderBy('id','DESC')->get();//食譜類別

        $data = [
            'recipe_categories'=>$recipe_categories
        ];
        return view('admins.recipes.create',$data);
    }
    //儲存食譜基本資料
    public function store(Request $request)
    {
        //驗證資料
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:255'],
            'recipe_category_id' => ['required'],
        ], [
            'name.required' => '請輸入食譜名稱!',
            'text.required' => '請填寫食譜簡介!',
            'recipe_category_id.required' => '請選擇食譜類別!',
        ]);

        //目前使用者
        $user=Auth::user();

        //儲存至DB
        $recipe = new Recipe;
        $recipe->user_id = $user->id;
        $recipe->recipe_category_id = $request->recipe_category_id;
        $recipe->status = $request->status;
        $recipe->name = $request->name;
        $recipe->text = $request->text;
        $recipe->save();

        $recipeId = $recipe->id;
        session(['previousRecipeId' => $recipeId]);
        $data=['recipeId' =>$recipeId];

        //dd($data);
        //將新增的食譜id傳到下一頁
        return redirect()->route('admins.recipes.add',$data);
        // 如果資料驗證失敗，自動回傳錯誤訊息並返回上一頁
        return back()->withErrors($validator)->withInput();

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
