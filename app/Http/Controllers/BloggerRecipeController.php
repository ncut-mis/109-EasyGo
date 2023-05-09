<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BloggerRecipeController extends Controller
{
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

   //寫食譜頁面(基本)
    public function create()
    {
        $recipe_categories=RecipeCategory::orderBy('id','DESC')->get();//食譜類別

        $data = [
            'recipe_categories'=>$recipe_categories
        ];
        return view('bloggers.recipes.create',$data);
    }

    public function create_next()
    {
        return view('bloggers.recipes.create2');
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

        //將新增的食譜id傳到下一頁
        return redirect()->route('bloggers.recipes.add',$data);
//        return view('livewire.blogger-recipe-add',$data);
        // 如果資料驗證失敗，自動回傳錯誤訊息並返回上一頁
        return back()->withErrors($validator)->withInput();

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

        //食譜封面圖片
        if($request->hasFile('videos')){
            $files=$request->file('videos');
            //處理圖片上傳
            foreach ($files as$file){
                //自訂名稱
                $videoName=time().'.'.$file->getClientOriginalExtension();

                //儲存至陣列中
                $request['recipe_id']=$recipe->id;
                $request['film']=$videoName;

                //儲存至指定目錄
                $file->move(\public_path('video'),$videoName);
                //存入DB
                RecipeImg::create([
                    'recipe_id' =>$recipe->id,
                    'film' => $videoName
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
