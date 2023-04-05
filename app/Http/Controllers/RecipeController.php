<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeImg;
use App\Models\Ingredient;
use App\Models\Member;
use App\Models\RecipeStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes=Recipe::where('status','=',1)->get();//顯示上架食譜
        $data=[
            'recipes' => $recipes,
            ];

    return view('blog.new',$data);
    }

    public function china()
    {
        return view('blog.china');
    }
    public function western()
    {
        return view('blog.western');
    }
    public function japan()
    {
        return view('blog.japan');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //辨別該會員是否收藏此食譜
        $member=Auth::user()->member;
        $isCollect = Collect::where('member_id', $member->id)
            ->where('recipe_id', $recipe->id)
            ->exists();
        $collect = Collect::where('member_id', $member->id)->where('recipe_id', $recipe->id)->first();
       // $collectId = $collect->id;

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

        $data = [
            'recipe' => $recipe,
            //'suggests'=>$suggests,
            'comments' => $comments,
            'isCollect'=>$isCollect,
            'collect'=>$collect
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
}
