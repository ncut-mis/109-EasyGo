<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.members');
    }
    public function collects()
    {
        return view('members.collects');
    }

    //我的食譜列表
    public function recipes()
    {
        $user=Auth::user();//目前使用者
        $recipes = Recipe::where('user_id','=',$user->id)->get();//目前使用者的食譜
        $data = [
            'recipes' => $recipes,
        ];
       // $recipes=Event::where('activity_id','=',$activity->id)->orderby('time')->get();
        return view('members.recipes',$data);
    }
    public function orders()
    {
        return view('members.orders');
    }
    public function cancel()
    {
        return view('members.orders.cancel');
    }
    public function done()
    {
        return view('members.orders.done');
    }
    public function show()
    {
        return view('members.orders.show');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function members()
    {
        $member = Auth::user()->member()->orderby('id', 'DESC')->first();//取得使用者在會員資料表的資訊
        $data = [
              'member' => $member,
            ];
        return view('members.members', $data);
    }
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

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
    public function update(Request $request, Member $member)
    {
        $user= Auth::user();
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        $member->update([
            'address'=>$request->address,
            'phone'=>$request->phone,
            'nickname'=>$request->nickname,
        ]);

        return redirect()->route('members.members');
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
