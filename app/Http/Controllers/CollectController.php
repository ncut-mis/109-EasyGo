<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member=Auth::user()->member;
        $collects = Collect::where('member_id','=', $member->id)->get();//目前使用者收藏的食譜
        //dd($collects);
        if ($collects->first()==null){  //檢測是否有資料
            $datanull=0;
        }else{
            $datanull=1;
        }
        $data = [
            'datanull' =>$datanull,
            'collects' => $collects,
        ];
        return view('members.collects',$data);
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

    public function store(Recipe $recipe)
    {
        //目前使用者
        $member = Auth::user()->member;

        //儲存至DB
        Collect::create([
            'member_id'=>$member->id,
            'recipe_id'=>$recipe->id,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success', '成功加入收藏.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collect  $collect
     * @return \Illuminate\Http\Response
     */
    public function show(Collect $collect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collect  $collect
     * @return \Illuminate\Http\Response
     */
    public function edit(Collect $collect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collect  $collect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collect $collect)
    {
        //
    }


    public function destroy(Collect $collect)
    {
        $collect->delete();
        return redirect()->back()->with('success', '收藏已删除.');
    }
}
