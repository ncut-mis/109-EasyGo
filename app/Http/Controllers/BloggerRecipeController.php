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
    return view('bloggers.recipes.create');
    }

    public function index()
    {
     return view('bloggers.recipes');
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
        $recipe_categories=RecipeCategory::orderBy('id','DESC')->get();//食譜類別

        $data = [
            'recipe' => $recipe,
            'recipe_categories'=>$recipe_categories
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
    public function update(Request $request, Recipe $recipe)
    {
        //食譜封面圖片
        if($request->hasFile('images')){
            $files=$request->file('images');
            //處理圖片上傳
            foreach ($files as$file){
                //自訂名稱
                $imageName=time().'.'.$file->getClientOriginalExtension();

                //儲存至陣列中
                $request['recipe_id']=$recipe->id;
                $request['picture']=$imageName;

                //儲存至指定目錄
                $file->move(\public_path('img/recipe'),$imageName);
                //存入DB
                RecipeImg::create([
                        'recipe_id' =>$recipe->id,
                        'picture' => $imageName
                    ]);
            }
        }

            $recipe->update([
                'name' => $request->name,
                'recipe_category_id' => $request->recipe_category_id,
                'status' => $request->status,
                'text' => $request->recipe_text,
            ]);


        return redirect()->back()->with('success', '食譜基本設定更新成功！');
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
