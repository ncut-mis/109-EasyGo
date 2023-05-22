<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeFilm;
use App\Models\RecipeImg;
use App\Models\RecipeStep;
use App\Models\Suggest;
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
           $images = [],
           $videos = [],

           $ingredients = [],
           $suggests=[],

           $steps = [],
           $originalSteps = [];

    public $showInput = [];//推薦自行輸入框
    public $products= [];


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
        //將顯示輸入框與否陣列初始化為指定數量的元素
        $this->showInput = array_fill(0, count($this->ingredients), false);

        //從建議資料表中獲取所有建議資料
        $suggests = Suggest::all();
        //將建議按照食材id分為各組
        $Suggests = $suggests->groupBy('ingredient_id');

        //將食材對應的建議資料添加到各食材中
        foreach ($this->ingredients as $index => $ingredient) {
            $ingredientId = $ingredient['id'];

            //建議分組中資料加入對應的食材陣列中
            if ($Suggests->has($ingredientId)) {
                $ingredient['suggests'] = $Suggests[$ingredientId]->toArray();
            } else {
                $ingredient['suggests'] = [];//新增建議新陣列
            }
            $this->ingredients[$index] = $ingredient;
        }

        $this->products = Product::all(); //取得所有商品資料

        $this->steps = $recipe->recipesteps->toArray();
        $this->originalSteps = $recipe->recipesteps->toArray();
    }

//<<<食譜基本資料>>>

    //圖片
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

    //影片
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
                $image->storeAs('img/recipe', $imageName, 'public_new');
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
                $video->storeAs('video', $videoName, 'public_new');
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


//<<<食譜食材>>>
   //食材填寫欄位
    public function addList()
    {
        $this->ingredients[] = [
            'id' => '', //食材編號
            'quantity' => '', //食材數量
            'remark' => '', //食材備註
            'name' => '', //食材名稱
            'suggests' => [], //對應的建議陣列
        ];
        //輸入框
        $this->showInput[] = false;
    }
    //移除某食材
    public function removeList($index)
    {
        //先刪除建議在刪除食材
        if (isset($this->ingredients[$index]['id'])) {
            //DB有建議
            $ingredientId = $this->ingredients[$index]['id'];//食材id
            Suggest::where('ingredient_id', $ingredientId)->delete();//刪除此食材的所有建議

            //DB有此食材
            $ingredient = Ingredient::find($ingredientId);
            if ($ingredient) {
                $ingredient->delete();
            }
            session()->flash('error', '食材刪除成功!');
        }

        unset($this->ingredients[$index]);
        $this->ingredients = array_values($this->ingredients);
    }

    //新增建議商品下拉單
    public function addSuggest($index)
    {
        $suggest = [
            'id' => '',
            'ingredient_id' => '',
            'product_id' => '',
            'recommend' => 0,
            'quantity' => '',
            'stock'=>1,
        ];
        //將新增的建議加入對應食材的陣列中
        $this->ingredients[$index]['suggests'][] = $suggest;
    }
    //刪除某食材中的某建議
    public function delSuggest($index, $key)
    {
        //找到對應的建議id
        $ingredientSuggest = $this->ingredients[$index]['suggests'][$key];
        unset($this->ingredients[$index]['suggests'][$key]);

        if (!empty($ingredientSuggest['id'])) {
            Suggest::find($ingredientSuggest['id'])->delete();
            session()->flash('error', '刪除建議成功!');
        }
    }

    //選擇建議商品
    public function selectSuggest($index, $key,$productId)
    {
        //是否有選擇商品
        if (isset($this->ingredients[$index]['suggests'][$key]['product_id'])) {
            //找到對應商品
            $product = Product::find($productId);
            $this->ingredients[$index]['suggests'][$key]['stock'] = $product->stock;//最大庫存量

            //設定預設數量為 1
            $this->ingredients[$index]['suggests'][$key]['quantity'] =1;
        }
    }

    //抓取資料庫建議商品的庫存最大值
    public function getMaxQuantity($key, $index)
    {
        $productId = $this->ingredients[$index]['suggests'][$key]['product_id'];
        $product = Product::find($productId);

        return $product ? $product->stock : 0;
    }


    //選擇食材類別-名稱輸入框
    public function selectCategory($index, $categoryId)
    {
        //找出DB對應類別id
        $category = Category::find($categoryId);

        //辨別選擇類別的category_id是否為null(第一階)
        if ($category->category_id === null) {
            $this->showInput[$index] = true;//顯示輸入框
            $this->ingredients[$index]['name'] = '';
        } elseif($category->category_id !== null) {
            $this->showInput[$index] = false;//隱藏輸入框

            //填入輸入框類文字
            $this->ingredients[$index]['name'] = $category->name;
            //刪除食材資料表的name資料
            if (isset($ingredient['id']))
            {
                $ingredientdata = Ingredient::find($ingredient['id']);
                $ingredientdata->name = '';
                $ingredientdata->save();
            }
        } else {
            $this->showInput[$index] = false; // 隱藏輸入框
        }
    }

    //食譜食材
    public function IngredientUpdate()
    {

        //食材
        foreach ($this->ingredients as $index => $ingredient) {
          //  dd($this->ingredients );
            //食材類別及用量不得為空
            if (!empty($ingredient['category_id']) && !empty($ingredient['quantity'])) {
                //若食材id不為空(已存在)
                if (!empty($ingredient['id'])) {
                    $recipeIngredient = Ingredient::find($ingredient['id']);
                    if ($recipeIngredient) {
                        $recipeIngredient->update([
                            'category_id' => $ingredient['category_id'],
                            'quantity' => $ingredient['quantity'],
                            'name' => $ingredient['name'],
                            'remark' => $ingredient['remark'],
                        ]);
                        session()->flash('message1', '更新食材成功!');
                    }
                    // 建立或更新建議商品
                    foreach ($ingredient['suggests'] as $key => $suggest) {
                        if (!empty($suggest['id'])) {
                            // 更新已存在的建議商品
                            $ingredientSuggest = Suggest::find($suggest['id']);
                            if ($ingredientSuggest) {
                                $ingredientSuggest->update([
                                    'product_id' => $suggest['product_id'],
                                    'recommend' => $suggest['recommend'],
                                    'quantity' => $suggest['quantity'],
                                ]);
                            } else {
                                session()->flash('error', '無此商品!');
                            }

                        }
                        //有選擇商品
                        elseif(!empty($suggest['product_id'])) {
                            // 建立新建議商品
                            $newSuggest = Suggest::create([
                                'ingredient_id' => $this->ingredients[$index]['id'],
                                'product_id' => $suggest['product_id'],
                                'recommend' => $suggest['recommend'],
                                'quantity' => $suggest['quantity'],
                            ]);
                            $this->ingredients[$index]['suggests'][$key]['id'] = $newSuggest->id; // 建議 id
                        }
                    }

                    //若食材不存在
                } else {
                    //建立新食材
                    $newIngredient = Ingredient::create([
                        'recipe_id' =>  $this->recipe->id,
                        'name' => $ingredient['name'],
                        'category_id' => $ingredient['category_id'],
                        'quantity' => $ingredient['quantity'],
                        'remark' => $ingredient['remark'],
                    ]);
                    $this->ingredients[$index]['id'] = $newIngredient->id;//食材id

                    //建立建議商品
                    foreach ( $this->ingredients[$index]['suggests'] as $key => $suggest) {
                        if (empty($suggest['id']) && !empty($suggest['product_id']) && !empty($suggest['quantity'])) {
                            $newSuggest = Suggest::create([
                                'ingredient_id' => $newIngredient->id,
                                'product_id' =>  $this->ingredients[$index]['suggests'][$key]['product_id'],
                                'recommend' =>  $this->ingredients[$index]['suggests'][$key]['recommend'],
                                'quantity' =>  $this->ingredients[$index]['suggests'][$key]['quantity'],
                            ]);
                            $this->ingredients[$index]['suggests'][$key]['id'] = $newSuggest->id; //建議id
                        }else{
                            session()->flash('error', '選擇數量');
                        }
                    }
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

    //刪除食譜步驟圖片??
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
                            $steps[$index]['picture']->storeAs('img/step', $imageName, 'public_new');
                            $steps[$index]['picture']=null;
                            //dd( $steps);
                            $recipeStep->update(['picture' => $imageName]);
                        }
                    }
                }
            }
        }

        session()->flash('message2', '食譜步驟更新成功！');
    }

    public function render()
    {
        $recipe_categories = RecipeCategory::orderBy('id','DESC')->get();//食譜類別
        $recipeImages = RecipeImg::where('recipe_id', $this->recipe->id)->get();//封面
        $recipeVideos = RecipeFilm::where('recipe_id', $this->recipe->id)->get();//影片

        $categories = Category::orderBy('id','ASC')->get();//食材類別
        $products = Product::orderBy('id','ASC')->get();//商品

        return view('livewire.blogger-recipe-edit', [
            'recipe_categories' => $recipe_categories,
            'recipeImages' => $recipeImages,
            'recipeVideos' => $recipeVideos,

            'categories' => $categories,
            'products' => $products,

        ])->extends('members.layouts.master');
    }
}
