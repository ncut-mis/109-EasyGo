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
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;


class BloggerRecipeAdd extends Component
{
    use WithFileUploads;

    public $recipe,
        $steps = [],
        $ingredients = [],
        $originalSteps = [],
        $images = [],
        $videos = [];
    public $isSaved = false;
    public $showInput = [];

    protected $rules = [
        'videos' => 'nullable|array',
        'videos.*' => 'nullable|mimes:mp4,mov',
        'images' => 'nullable|array',
        'images.*' => 'nullable|mimes:jpeg,png,gif',
        'image.*' => 'nullable|mimes:jpeg,png,gif',
    ];

    public function mount(Recipe $recipe)
    {
        //在Livewire組件中取得前一頁面的食譜id
        $previousRecipeId = session('previousRecipeId');
        $this->previousRecipeId = $previousRecipeId;
        //用食譜id找出對應食譜
        $this->recipe = Recipe::find($previousRecipeId);

        $this->images = $recipe->images;
        $this->videos = $recipe->videos;
        $this->ingredients = $recipe->ingredients->toArray();
        $this->steps = $recipe->recipesteps->toArray();
        $this->originalSteps = $recipe->recipesteps->toArray();
    }

//<<<食譜封面影片>>>
    //刪除預覽中的圖片
    public function deleteUploadImg($index)
    {
        //刪除預覽圖片
        unset($this->images[$index]);
        //重新排列
        $this->images = array_values($this->images);
    }
    //刪除預覽中的影片
    public function deleteUploadVideo($index)
    {
        //刪除預覽圖片
        unset($this->videos[$index]);
        //重新排列
        $this->videos = array_values($this->videos);
    }
    //新增食譜封面、影片
    public function add()
    {
        //食譜封面
        if ($this->images) {
            foreach ($this->images as $image) {
                //自訂名稱
                $imageName = time() . '_' . $image->getClientOriginalName();
                //儲存至公開資料夾下
                $image->storeAs('img/recipe', $imageName, 'public_new');
                //存入DB
                RecipeImg::create([
                    'recipe_id' => $this->previousRecipeId,
                    'picture' => $imageName,
                ]);
            }
            //清空陣列
            $this->images = [];
        }

        //食譜影片
        if ($this->videos) {
            // dd($this->videos);
            foreach ($this->videos as $video) {
                //自訂名稱
                $videoName = time() . '_' . $video->getClientOriginalName();
                //dd($videoName);
                //儲存至公開資料夾下
                $video->storeAs('video', $videoName, 'public_new');
                //存入DB
                RecipeFilm::create([
                    'recipe_id' => $this->previousRecipeId,
                    'film' => $videoName,
                ]);
            }
            //清空陣列
            $this->videos = [];
        }
        $this->isSaved = true;

        // 刪除暫存檔案
        $files = Storage::disk('local')->allFiles('livewire-tmp');
        foreach ($files as $file) {
            Storage::disk('local')->delete($file);
        }
        session()->flash('message', '食譜圖片及影片新增成功!');
    }

//<<<食譜食材>>>
    //食材填寫欄位
    public function addList()
    {
        $this->ingredients[] = [
            'id' =>'',//會在新增食材時，填入DB對應編號
            'quantity' => '',
            'remark' => '',
            'name'=>'',
        ];
        $this->showInput[] = false;//輸入框
    }

    //刪除某食材
    public function removeList($index)
    {
        if (isset($this->ingredients[$index]['id'])) {
            //DB有此食材
            $ingredient = Ingredient::find($this->ingredients[$index]['id']);
            if ($ingredient) {
                $ingredient->delete();
                session()->flash('error', '食材刪除成功!');
            }
        }
        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }

    //輸入框
    public function selectCategory($index, $categoryId)
    {
        //找出DB對應類別id
        $category = Category::find($categoryId);

        //辨別選擇類別的category_id是否為null(第一階)
        if ($category && $category->category_id === null) {
            $this->showInput[$index] = true;//顯示輸入框
        } else {
            $this->showInput[$index] = false;//隱藏輸入框

            //清除輸入框類文字
            $this->ingredients[$index]['name'] = '';
            //刪除食材資料表的name資料
            if (isset($ingredient['id']))
            {
                $ingredientdata = Ingredient::find($ingredient['id']);
                $ingredientdata->name = '';
                $ingredientdata->save();
            }
        }
    }

    //食材儲存
    public function IngredientSave()
    {
        foreach ($this->ingredients as $index => $ingredient) {
            //食材類別及用量不得為空
            if (!empty($ingredient['category_id']) && !empty($ingredient['quantity'])) {
                //若陣列中id不為空
                if ($ingredient['id'] !== '') {
                    //更新已存在的食材(找出DB對應id)
                    $recipeIngredient = Ingredient::find($ingredient['id']);
                    if ($recipeIngredient) {
                        $recipeIngredient->update([
                            'category_id' => $ingredient['category_id'],
                            'quantity' => $ingredient['quantity'],
                            'name'=>$ingredient['name']
                        ]);
                        session()->flash('message1', '更新食材成功!');
                    }
                } else {
                    // 创建新的食材
                    $newIngredient=Ingredient::create([
                        'recipe_id' => $this->previousRecipeId,
                        'name'=>$ingredient['name'],
                        'category_id' => $ingredient['category_id'],
                        'quantity' => $ingredient['quantity']
                    ]);
                    $this->ingredients[$index]['id'] = $newIngredient->id;
                    session()->flash('message1', '新增食材成功!');
                }
            } else {
                session()->flash('error', '請輸入完整資料!(名稱、用量)');
            }
        }
    }


//<<<食譜步驟>>>
    //步驟填寫欄位
    public function addStep()
    {
        $newStep = new RecipeStep([
            'recipe_id' => $this->previousRecipeId,
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
        if (isset($this->steps[$index]['id'])) {
            $stepId = $this->steps[$index]['id'];
            // 從資料庫中獲取步驟資料
            $recipeStep = RecipeStep::find($stepId);
            if ($recipeStep) {
                // 刪除步驟圖片
                if ($recipeStep->picture) {
                    Storage::disk('public_new')->delete('img/step/' . $recipeStep->picture);
                }
                // 從資料庫中刪除步驟記錄
                $recipeStep->delete();
            }
        }

        //從步驟陣列中移除該步驟
        unset($this->steps[$index]);
        //重新索引步驟陣列
        $this->steps = array_values($this->steps);
        $this->resetSequence();
        //儲存步驟至資料庫
        $this->StepUpdate();

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

    //步驟更新
    public function stepSave()
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
                            $steps[$index]['picture']->storeAs('img/step', $imageName, 'public_new');
                            $steps[$index]['picture']=null;
                            //dd( $steps);
                            $recipeStep->update(['picture' => $imageName]);
                        }
                    }
                }
            }
        }

        session()->flash('message2', '步驟更新成功！');
    }



    public function render()
    {
        $categories = Category::orderBy('id','ASC')->get();//食材類別

        return view('livewire.blogger-recipe-add', [
            'categories' => $categories,
        ])->extends('members.layouts.master');
    }
}
