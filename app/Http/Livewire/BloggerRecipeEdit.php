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
           $status;
    public $steps = [];
    public $originalSteps = [];
    public $images = [];





    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->name = $recipe->name;
        $this->text = $recipe->text;
        $this->recipe_category_id = $recipe->recipeCategory->id;
        $this->images = $recipe->images;
        $this->status = $recipe->status;
        $this->steps = $recipe->recipesteps->toArray();
        $this->originalSteps = $recipe->recipesteps->toArray();
    }

    //步驟空填寫欄位
    public function addStep()
    {
        $this->steps[] = [
            'sequence' => count($this->steps) + 1,
            'text' => '',
            'picture' => null,
        ];
       // dd($this->steps);
    }

    //移除某步驟
    public function removeStep($index)
    {
        //刪除指定索引位置的元素
        unset($this->steps[$index]);

        $this->steps = array_values($this->steps);
        // 更新步驟序列編號
        $this->resetSequence();
    }

    //某步驟上移
    public function moveStepUp($index)
    {
        if ($index === 0) {
            return;
        }

        $temp = $this->steps[$index];//儲存要移動的資料
        //調換位置
        $this->steps[$index] = $this->steps[$index - 1];
        $this->steps[$index - 1] = $temp;

        // 更新步驟序列編號
        $this->resetSequence();
    }

    //某步驟下移
    public function moveStepDown($index)
    {
        if ($index === count($this->steps) - 1) {
            return;
        }

        $temp = $this->steps[$index];
        $this->steps[$index] = $this->steps[$index + 1];
        $this->steps[$index + 1] = $temp;

        // 更新步驟序列編號
        $this->resetSequence();
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

    //刪除食譜步驟圖片
    public function deleteStepImg($id)
    {
        $recipeStep = RecipeStep::find($id);

        if ($recipeStep) {
            $path = public_path('img/step/' . $recipeStep->picture);
            if (file_exists($path)) {
                //dd($path);
                unlink($path);
            }
            //dd($path);
            $recipeStep->update(['picture' => '']);
        }
        session()->flash('message', '圖片已成功刪除！');
    }

    //更新所有資料
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
            //取得storage\app\livewire-tmp目錄下的檔案，並刪除
            $files = Storage::disk('local')->allFiles('livewire-tmp');
            foreach ($files as $file) {
                Storage::disk('local')->delete($file);
            }
        }

//        //食譜步驟
//        foreach ($this->steps as $step) {
//            if (isset($step['id'])) {
//                $recipeStep = RecipeStep::find($step['id']);//步驟編號
//                $recipeStep->update([
//                    'sequence' => $step['sequence'],
//                    'text' => $step['text']
//                ]);
//                //dd($recipeStep);
//
//                //如果有上傳圖片
//                if (isset($step['picture']) && is_uploaded_file($step['picture'])) {
//                    //刪除原本照片
//                    if ($recipeStep->picture && Storage::exists($recipeStep->picture)) {
//                        Storage::delete($recipeStep->picture);
//                    }
//                    //儲存上傳圖片
//                    //自訂名稱
//                    $imageName = time() . '_' . $step['picture']->getClientOriginalName();
//                    //儲存至公開資料夾下
//                    $step['picture']->storeAs('step', $imageName, 'public_recipe');
//                    //存入DB
//                    $recipeStep->update([
//                        'sequence' => $step['sequence'],
//                        'text' => $step['text'],
//                        'picture' => $imageName
//                    ]);
//                    //$recipeStep->update(['picture' => $imageName]);
//                }
//            }
//            else {
//                RecipeStep::create([
//                    'recipe_id' => $recipe->id,
//                    'text' => $step['text'],
//                    'sequence' => $step['sequence'],
//                ]);
//                //是否有上傳圖片
//                if (isset($step['picture']) && is_uploaded_file($step['picture'])) {
//                    //儲存上傳圖片
//                    //自訂名稱
//                    $imageName = time() . '_' . $step['picture']->getClientOriginalName();
//                    //儲存至公開資料夾下
//                    $step['picture']->storeAs('step', $imageName, 'public_recipe');
//                    //存入DB
//                    RecipeStep::create(['picture' => $imageName]);
//                }
//            }
//            //取得storage\app\livewire-tmp目錄下的檔案，並刪除
//            $files = Storage::disk('local')->allFiles('livewire-tmp');
//            foreach ($files as $file) {
//                Storage::disk('local')->delete($file);
//            }
//        }
//
//        //刪除要移除的步驟
//        $deletedStepIds = collect($this->originalSteps)
//            ->pluck('id')
//            ->diff(collect($this->steps)->pluck('id'))
//            ->all();
//        RecipeStep::whereIn('id', $deletedStepIds)->delete();
//       // $recipeStep = RecipeStep::find($stepId);
//        if ($recipeStep) {
//            $path = public_path('img/step/' . $recipeStep->picture);
//            if (file_exists($path)) {
//                unlink($path);
//            }
//        }

        foreach ($this->steps as $step) {
            // 檢查步驟資料是否有效
            if (isset($step['text']) && isset($step['sequence'])) {
                if (isset($step['id'])) {
                    // 更新現有步驟
                    $recipeStep = RecipeStep::find($step['id']);
                    if ($recipeStep) {
                        $recipeStep->update([
                            'sequence' => $step['sequence'],
                            'text' => $step['text']
                        ]);

                        // 如果有上傳圖片
                        if (isset($step['picture']) && is_uploaded_file($step['picture'])) {
                            // 刪除原本照片
                            if ($recipeStep->picture && Storage::exists($recipeStep->picture)) {
                                Storage::delete($recipeStep->picture);
                            }

                            // 儲存上傳圖片
                            $imageName = time() . '.' . $step['picture']->getClientOriginalName();
                            $step['picture']->storeAs('step', $imageName, 'public_recipe');

                            // 更新DB步驟的圖片文件名
                            $recipeStep->update([
                                'picture' => $imageName
                            ]);
                        }
                    }
                } else {
                    // 創建新步驟
                    $recipeStep = RecipeStep::create([
                        'recipe_id' => $recipe->id,
                        'text' => $step['text'],
                        'sequence' => $step['sequence']
                    ]);
                    // 如果有上傳圖片
                    if (isset($step['picture']) && is_uploaded_file($step['picture'])) {
                        // 儲存上傳圖片
                        $imageName = time() . '.' . $step['picture']->getClientOriginalName();
                        $step['picture']->storeAs('step', $imageName, 'public_recipe');

                        // 更新步驟的圖片文件名
                        $recipeStep->update([
                            'picture' => $imageName
                        ]);
                    }
                }
            }
            // 刪除要移除的步驟
            $deletedStepIds = collect($this->originalSteps)
                ->pluck('id')
                ->diff(collect($this->steps)->pluck('id'))
                ->all();
            RecipeStep::whereIn('id', $deletedStepIds)->delete();

            // 刪除圖片
            foreach ($deletedStepIds as $stepId) {
                $recipeStep = RecipeStep::find($stepId);
                if ($recipeStep && $recipeStep->picture) {
                    $path = public_path('storage/step/' . $recipeStep->picture);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            // 刪除暫存檔案
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
        $steps = RecipeStep::where('recipe_id', $this->recipe->id)->get();//步驟
        return view('livewire.blogger-recipe-edit', [
            'recipe_categories' => $recipe_categories,
            'recipeImages' => $recipeImages,
            'steps' => $steps
        ])->extends('members.layouts.master');
    }
}
