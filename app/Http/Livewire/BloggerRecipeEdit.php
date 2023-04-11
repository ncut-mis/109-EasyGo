<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeImg;
use App\Models\RecipeStep;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class BloggerRecipeEdit extends Component
{
    use WithFileUploads;

    public $recipe,
           $name,
           $text,
           $recipe_category_id,
          // $images = [],
           $status,
           $steps = [];
    public $images = [];


    public function addStep()
    {
        $this->steps[] = [
            'step_text' => '',
            'step_image' => null,
        ];
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
    }

    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->name = $recipe->name;
        $this->text = $recipe->text;
        $this->recipe_category_id = $recipe->recipeCategory->id;
        $this->images = $recipe->images;
        $this->status = $recipe->status;
        $this->steps =$recipe->recipesteps->toArray();
    }


    //刪除預覽中的圖片
    public function deleteUploadImg($index)
    {
        //刪除預覽圖片
        unset($this->images[$index]);
        //重新排列
        $this->images = array_values($this->images);
    }

    //刪除食譜封面圖片
    public function deleteRecipeImg($id)
    {
        $image = RecipeImg::find($id);
        if ($image) {
            //刪除public下的圖片
            $path = public_path('img/recipe/' . $image->picture);
            if (file_exists($path)) {
                unlink($path);
            }
            //刪除DB的圖片
            $image->delete();
        }
        session()->flash('message', '圖片已成功刪除！');
    }

    //更新資料
    public function update()
    {
        $recipe = Recipe::find($this->recipe->id);
        $recipe->name = $this->name;
        $recipe->text = $this->text;
        $recipe->status = $this->status;
        $recipe->recipe_category_id = $this->recipe_category_id;
        $recipe->save();

        //若有上傳圖片(封面)
        if ($this->images) {
            foreach ($this->images as $image) {
                //自訂名稱
                $imageName = time() . '_' . $image->getClientOriginalName();
                //儲存至公開資料夾下
                $image->storeAs('recipe', $imageName, 'public_recipe');
                //存入DB
                RecipeImg::create([
                    'recipe_id' => $recipe->id,
                    'picture' => $imageName,
                ]);
            }
            //清空陣列
            $this->images = [];
            //取得storage\app\livewire-tmp目錄下的檔案，並刪除
            $files = Storage::disk('local')->allFiles('livewire-tmp');
            foreach ($files as $file) {
                Storage::disk('local')->delete($file);
            }
        }


        return redirect()->back()->with('message', '食譜更新成功！');
    }

    public function render()
    {
        $recipe_categories = RecipeCategory::orderBy('id','DESC')->get();//食譜類別
        $recipeImages = RecipeImg::where('recipe_id', $this->recipe->id)->get();//封面
        $steps = RecipeStep::where('recipe_id', $this->recipe->id)->get();

        return view('livewire.blogger-recipe-edit', [
            'recipe_categories' => $recipe_categories,
            'recipeImages' => $recipeImages,
            'steps' => $steps
        ])->extends('members.layouts.master');
    }
}
