<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function cart_items()
    {
        return view('members.cart_items.index');
    }

    //我的食譜列表
    public function recipes()
    {
        $user=Auth::user();//目前使用者
        $recipes = Recipe::where('user_id','=',$user->id)->orderBy('id','DESC')->get();//目前使用者的食譜
        if ($recipes->first()==null){  //檢測是否有資料
            $datanull=0;
        }else{
            $datanull=1;
        }
        $data = [
            'datanull' =>$datanull,
            'recipes' => $recipes,
        ];
        return view('members.recipes',$data);
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


    public function updatepassword(Request $request)

    {
        $user = Auth::user();

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        //用confirmed驗證新密碼和確認密碼是否相同
        $request->validate([
            'password' => 'required|confirmed',],[
            'password.confirmed' => '新密碼和確認密碼不一致',
        ]);

        // 驗證舊密碼
        if (!Hash::check($currentPassword, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => '舊密碼輸入錯誤']);
        }
        $request->user()->update([
            'password' => Hash::make($request->input('password')),
        ]);
        // 更新密碼
        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->back()->with('success', '密碼已經更新');
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

        return redirect()->route('members.index');
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
