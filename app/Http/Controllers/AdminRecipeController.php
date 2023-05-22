<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeFilm;
use App\Models\RecipeImg;
use App\Models\RecipeStep;
use App\Models\Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function destroy(Recipe $recipe)
    {
        // 刪除暫存檔案
        $files = Storage::disk('local')->allFiles('livewire-tmp');
        foreach ($files as $file) {
            Storage::disk('local')->delete($file);
        }
        //與食譜相關資料表有=>收藏、留言、食材(含建議)、食譜影片、圖片、步驟(含圖片)

        //刪除收藏
        Collect::destroy($recipe->id);

        //刪除留言(父子)
        $childComments= Comment::where('recipe_id', '=', $recipe->id)->where('comment_id', '!=',null)->get();//該食譜all子留言
        foreach ($childComments as $childComment) {
            //dd($childComments);
            $childComment->delete(); //删除子留言

            $mainComments=Comment::where('recipe_id', '=', $recipe->id)->where('comment_id', '=',null)->get();//該食譜all主留言
            foreach ($mainComments as $mainComment) {
                //dd($mainComments);
                $mainComment->delete(); //删除主留言
            }
        }

        //刪除食材(先刪建議在刪食材)
        $ingredients=Ingredient::where('recipe_id', '=', $recipe->id)->get();//該食譜all食材
        foreach ($ingredients as $ingredient) {
            $suggests = Suggest::where('ingredient_id', '=',$ingredient->id)->get();//該食譜之建議
            foreach ($suggests as $suggest) {
                //dd($suggests);
                $suggest->delete(); //删除建議
            }
            $ingredient->delete();//刪除食材
        }

        //刪除食譜圖片、影片
        $images = RecipeImg::where('recipe_id', '=', $recipe->id)->get();
        foreach ($images as $image) {
            //dd($images);
            if ($image) {
                //刪除public下的圖片
                $path = public_path('img/recipe/' . $image->picture);
                if (file_exists($path)) {
                    unlink($path);
                }
                //刪除DB資料
                $image->delete();
            }
        }

        $videos = RecipeFilm::where('recipe_id', '=', $recipe->id)->get();
        foreach ($videos as $video) {
            //dd($videos);
            if ($video) {
                //刪除public下的影片
                $path = public_path('video/' . $video->film);
                if (file_exists($path)) {
                    unlink($path);
                }
                //刪除DB資料
                $video->delete();
            }
        }

        //刪除食譜步驟
        $steps=RecipeStep::where('recipe_id', '=', $recipe->id)->get();
        //dd($steps);
        foreach ($steps as $step) {
            if ($step->picture !=null) {
                //刪除public下的步驟圖片
                $path = public_path('img/step/' . $step->picture);
                //dd($path);
                if (file_exists($path)) {
                    unlink($path);
                }
                //刪除DB資料
                $step->delete();
            }else{
                $step->delete();
            }
        }

        //最後刪除食譜
        $recipe->delete();

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


}
