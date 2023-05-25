<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request$request)
    {

        $comment_id = $request->input('comment_id');
//        $user = Auth::user(); //目前使用者
        $member = Auth::user()->member()->orderby('id', 'DESC')->first();//取得使用者在會員資料表的資訊

        $recipe_id = $request->input('recipe_id');

        $content = $request->input('content');
        $new_comment = new Comment;

        if ($comment_id != NULL) {
            $new_comment->comment_id = $comment_id;
        }

        $new_comment->member_id = $member->id;
        $new_comment->recipe_id = $recipe_id;
        $new_comment->comment_id = $comment_id == NULL ? NULL : $comment_id; //
        $new_comment->content = $content;
        $new_comment->save();

        return redirect()->back()->with('success', '留言成功');
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
