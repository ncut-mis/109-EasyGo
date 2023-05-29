<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeImg;
use App\Models\Ingredient;
use App\Models\Member;
use App\Models\RecipeStep;
use App\Models\Suggest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    //食譜首頁
    public function index()
    {
        $recipes=Recipe::where('status','=',1)->orderBy('id','DESC')->get();//顯示上架食譜
        $topRecipes = Recipe::has('collects', '>', 5)->get();//收藏人數大於5的食譜
        $categories=RecipeCategory::orderBy('id','DESC')->get();
        $data=[
            'recipes' => $recipes,
            'topRecipes'=>$topRecipes,
            'categories'=>$categories,
            ];

    return view('blog.new',$data);
    }

    //搜尋食譜
    public function search(Request $request)
    {
        $search = $request->input('search');
        $SearchRecipe = Recipe::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->where('status', 1)//上架
            ->get();
        $categories=RecipeCategory::orderBy('id','DESC')->get();//sidenav顯示類別
        $data=[
                'SearchRecipe'=>$SearchRecipe,
                'categories'=>$categories,
            ];
        return view('blog.new',$data);
    }

    //食譜類別搜尋
    public function category(RecipeCategory $category)
    {

        $categories=RecipeCategory::orderBy('id','DESC')->get();
        $SearchRecipe=Recipe::where('recipe_category_id','=',$category->id)->where('status', 1)->get();//取得該類別以上架食譜
        $data=[
            'SearchRecipe'=>$SearchRecipe,
            'categories'=>$categories
        ];
        //dd($recipes);
        return view('blog.new',$data);
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
            $all_replies=Comment::where('recipe_id','=',$id)->where('comment_id','=',$comment->id)->get();

            $comment_replies = array();

            foreach ($all_replies as $reply)
            {
                $member_info=Member::where('id','=',$reply->member_id)->get();
                $user_info=User::where('id','=',$member_info[0]->user_id)->get();

                $reply->nickname = $member_info[0]->nickname;
                $reply->fullname = $user_info[0]->name;

                array_push($comment_replies, $reply);
            }

            $member_info=Member::where('id','=',$comment->member_id)->get();
            $user_info=User::where('id','=',$member_info[0]->user_id)->get();

            $comment->nickname = $member_info[0]->nickname;
            $comment->fullname = $user_info[0]->name;
            $comment->replies = $comment_replies;

            array_push($rsp_comments, $comment);
        }

        $data=[
            'recipe'=>$recipe,
            'recipe_img'=>$recipe_imgs,
            'ingredients'=>$ingredients,
            'comments'=>$rsp_comments,
        ];


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


    //食譜顯示資訊
    public function show(Recipe $recipe)
    {
        // 刪除暫存檔案
        $files = Storage::disk('local')->allFiles('livewire-tmp');
        foreach ($files as $file) {
            Storage::disk('local')->delete($file);
        }

        //未登入
        $isCollect = null;
        $collect = null;
        //辨別該會員是否收藏此食譜，且非此食譜發表人
        if (Auth::check() && $recipe->user_id !== Auth::user()->id) {
            $member = Auth::user()->member;
            $isCollect = Collect::where('member_id', $member->id)
                ->where('recipe_id', $recipe->id)
                ->exists();
            if ($isCollect) {
                $collect = Collect::where('member_id', $member->id)
                    ->where('recipe_id', $recipe->id)
                    ->first();
            }
        }

        //抓取各食材的建議食材
        $ingredients = Ingredient::where('recipe_id', $recipe->id)->get();
        foreach ($ingredients as $ingredient) {
            //各食材對應建議商品
            $suggests = Suggest::where('ingredient_id','=',$ingredient->id)->get();
            foreach ($suggests as $suggest) {
                $product = Product::find($suggest->product_id);
                $suggest->product = $product;
            }
            $ingredient->suggests = $suggests;
        }

        //將會員跟留言連結
        $comments =
            Comment::where('recipe_id', '=', $recipe->id)->where('comment_id', null)
            ->join('members', 'comments.member_id', '=', 'members.id')
            ->select('comments.id', 'nickname', 'content', 'comment_id', 'recipe_id', 'comments.created_at')
            ->get();
        //第二層留言
        function getSubComment(Recipe $recipe, $id)
        {
            $sub_comments =
                Comment::where('recipe_id', '=', $recipe->id)->where('comment_id', '!=', null)->where('comment_id', '=', $id)
                ->join('members', 'comments.member_id', '=', 'members.id')
                ->select('nickname', 'content', 'comment_id', 'comments.created_at')
                ->get();
            // print_r($sub_comments);
            return $sub_comments;
        }

        foreach ($comments as $comment) {
            $comment->sub_comments = getSubComment($recipe, $comment->id);
        }
        // print_r($comments);
        $categories=RecipeCategory::orderBy('id','DESC')->get();
        $data = [
            'recipe' => $recipe,
            'comments' => $comments,
            'isCollect'=>$isCollect,
            'collect'=>$collect,
            'categories'=>$categories,
            'ingredients'=>$ingredients,

        ];
        return view('recipe.show', $data);

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
    public function List(Recipe $recipe)
    {

        $ingredients = Ingredient::where('recipe_id', '=', $recipe->id)
            ->join('recipes', 'ingredients.recipe_id', '=', 'recipes.id')
            ->join('suggests', 'ingredients.id', '=', 'suggests.ingredient_id')
            ->join('products', 'products.id', '=', 'suggests.product_id')

            // ->orderBy('categories.id')
            ->select('ingredients.name as category_name' , 'products.name as product_name','products.id AS product_id','products.price AS product_price','products.norm AS product_norm')
            ->get();
        return $ingredients;

    }
}
