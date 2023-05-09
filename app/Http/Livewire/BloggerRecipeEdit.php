<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeFilm;
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
           $status,
           $steps = [],
           $ingredients = [],
           $originalSteps = [],
           $images = [],
           $videos = [];


    protected $rules = [
        'videos' => 'nullable|array',
        'videos.*' => 'nullable|mimes:mp4,mov',
        'images' => 'nullable|array',
        'images.*' => 'nullable|mimes:jpeg,png,gif',
        'image.*' => 'nullable|mimes:jpeg,png,gif',
    ];


    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->name = $recipe->name;
        $this->text = $recipe->text;
        $this->recipe_category_id = $recipe->recipeCategory->id;
        $this->images = $recipe->images;
        $this->videos = $recipe->videos;
        $this->status = $recipe->status;
        $this->ingredients = $recipe->ingredients->toArray();
        $this->steps = $recipe->recipesteps->toArray();
        $this->originalSteps = $recipe->recipesteps->toArray();
    }

    //步驟填寫欄位
    public function addStep()
    {
        $newStep = new RecipeStep([
            'recipe_id' => $this->recipe->id,
            'sequence' => count($this->steps) + 1,
            'text' => '',
            'picture' => null,
        ]);

        $newStep->save();
        $this->steps[] = $newStep;
        session()->flash('message2', '新增步驟成功!');

    }

    //移除某步驟
    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
        $this->resetSequence();
    }

    //某步驟上移
    public function moveStepUp($index)
    {
        if ($index > 0 && $index < count($this->steps)) {
            $temp = $this->steps[$index];
            $this->steps[$index] = $this->steps[$index - 1];
            $this->steps[$index - 1] = $temp;

            $this->resetSequence();
        }
    }

    //某步驟下移
    public function moveStepDown($index)
    {
        if ($index < count($this->steps) - 1) {
            $temp = $this->steps[$index];
            $this->steps[$index] = $this->steps[$index + 1];
            $this->steps[$index + 1] = $temp;

            $this->resetSequence();
        }
    }
    //重新排序編號
    private function resetSequence()
    {
        foreach ($this->steps as $key => $step) {
            $this->steps[$key]['sequence'] = $key + 1;
        }
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
            //刪除DB資料
            $image->delete();
        }
        session()->flash('message', '圖片已成功刪除！');
    }


    //刪除預覽中的影片
    public function deleteUploadVideo($index)
    {
        //刪除預覽圖片
        unset($this->videos[$index]);
        //重新排列
        $this->videos = array_values($this->videos);
    }
    //刪除食譜片
    public function deleteRecipeVideo($id)
    {
        $video = RecipeFilm::find($id);
        if ($video) {
            //刪除public下的影片
            $path = public_path('video/' . $video->film);
            if (file_exists($path)) {
                unlink($path);
            }
            //刪除DB資料
            $video->delete();
        }
        session()->flash('message', '影片已成功刪除！');
    }

    //更新食譜基本資料
    public function update()
    {
        $recipe = Recipe::find($this->recipe->id);
        $recipe->name = $this->name;//食譜名稱
        $recipe->text = $this->text;//食譜簡介
        $recipe->status = $this->status;//上下架
        $recipe->recipe_category_id = $this->recipe_category_id;//食譜類別
        $recipe->save();

        //食譜封面
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
            //刪除臨時文件
            Storage::disk('local')->delete($image->getRealPath());
        }

        //食譜影片
        if ($this->videos) {
           // dd($this->videos);
            foreach ($this->videos as $video) {
                //自訂名稱
                $videoName = time() . '_' . $video->getClientOriginalName();
                //dd($videoName);
                //儲存至公開資料夾下
                $video->storeAs('', $videoName, 'public_video');
                //存入DB
                RecipeFilm::create([
                    'recipe_id' => $recipe->id,
                    'film' => $videoName,
                ]);
            }
            //清空陣列
            $this->videos = [];
        }

        // 刪除暫存檔案
        $files = Storage::disk('local')->allFiles('livewire-tmp');
        foreach ($files as $file) {
            Storage::disk('local')->delete($file);
        }
        session()->flash('message', '食譜更新成功!');
    }


    //食材填寫欄位
    public function addList()
    {
        $this->ingredients[] = [
            'name' => '',
            'remark' => '',
            'quantity'=>'',
        ];
    }

    //移除某食材
    public function removeList($index)
    {
        //刪除指定索引位置的元素
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }


    //食譜食材
    public function IngredientUpdate()
    {

    }


    //刪除食譜步驟圖片
    public function deleteStepImg($id)
    {
        $recipeStep = RecipeStep::find($id);

        if ($recipeStep) {
            $path = public_path('img/step/' . $recipeStep->picture);
            if (file_exists($path)) {
                unlink($path);
            }
            $recipeStep->update(['picture' => '']);
        }
        // 顯示成功消息
        session()->flash('message2', '圖片已成功刪除！');
    }

    public function StepUpdate()
    {
        $steps=$this->steps;
        foreach ($steps as $index =>$step) {
            if (isset($step['text'], $step['sequence'])) {
                if (isset($step['id'])) {
                    //更新已存在的步驟
                    $recipeStep = RecipeStep::find($step['id']);
                    if ($recipeStep) {
                        //更新步驟順序和說明
                        $recipeStep->update([
                            'sequence' => $step['sequence'],
                            'text' => $step['text']
                        ]);

                        //更新圖片
                        if (isset($steps[$index]['picture']) && $steps[$index]['picture'] instanceof \Illuminate\Http\UploadedFile) {
                            //刪除原有的圖片
                            $oldPicture = $recipeStep->picture;
                            if ($oldPicture) {
                                $path = public_path('img/step/' . $oldPicture);
                                if (file_exists($path)) {
                                    unlink($path);
                                }
                            }
                            //上傳新的圖片
                            $imageName = time() . '_' . $steps[$index]['picture']->getClientOriginalName();
                            $steps[$index]['picture']->storeAs('step', $imageName, 'public_recipe');
                            $steps[$index]['picture']=null;
                            //dd( $steps);
                            $recipeStep->update(['picture' => $imageName]);
                        }
                    }
                }
            }
        }

        // 刪除某個步驟
        $deletedStepIds = collect($this->originalSteps)
            ->pluck('id')
            ->diff(collect($this->steps)->pluck('id'))
            ->all();
        foreach ($deletedStepIds as $stepId) {
            $recipeStep = RecipeStep::find($stepId);
            if ($recipeStep && $recipeStep->picture) {
                $oldPicture = $recipeStep->picture;
                $path = 'step/' . $oldPicture;
                if (Storage::disk('public_recipe')->exists($path)) {
                    Storage::disk('public_recipe')->delete($path);//刪除public/img/step下的檔案
                }
                RecipeStep::whereIn('id', $deletedStepIds)->delete();//刪除DB
            }
            else{
                RecipeStep::whereIn('id', $deletedStepIds)->delete();//刪除DB
            }
        }
       // $steps->refresh();
        session()->flash('message2', '食譜步驟更新成功！');
    }

    public function render()
    {
        $recipe_categories = RecipeCategory::orderBy('id','DESC')->get();//食譜類別
        $recipeImages = RecipeImg::where('recipe_id', $this->recipe->id)->get();//封面
        $recipeVideos = RecipeFilm::where('recipe_id', $this->recipe->id)->get();//影片
        $steps = RecipeStep::where('recipe_id', $this->recipe->id)->get();//步驟
        $ingredients = Ingredient::where('recipe_id', $this->recipe->id)->get();//食材

        return view('livewire.blogger-recipe-edit', [
            'recipe_categories' => $recipe_categories,
            'recipeImages' => $recipeImages,
            'recipeVideos' => $recipeVideos,
            'steps' => $steps,
            'ingredients' => $ingredients,

        ])->extends('members.layouts.master');
    }
}
