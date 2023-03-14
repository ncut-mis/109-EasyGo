<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRecipeController;
use App\Http\Controllers\BloggerRecipeController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
////測試
//Route::get('/welcome',function (){
//    return view('welcome');
//});


//Route::get('/',[HomeController::class,'home'])->name('home');//首頁

Route::get('/sid/{category}',[HomeController::class,'sid'])->name('sid');//按照分類顯示在index上
Route::get('/search',[RecipeController::class,'search'])->name('search');//搜尋

//食譜部落格
Route::get('/',[RecipeController::class,'index'])->name('blog.new');//首頁
//Route::get('/',function (){return '123456789';})->name('blog.new');//首頁

//中式
Route::get('china',[RecipeController::class,'china'])->name('blog.china');
//西式
Route::get('western',[RecipeController::class,'western'])->name('blog.western');
//日式
Route::get('japan',[RecipeController::class,'japan'])->name('blog.japan');


//食譜頁面(選擇性路由
Route::get('recipe',[RecipeController::class,'recipe'])->name('recipe.recipe');



//部落客
Route::prefix('bloggers')->name('bloggers.')->group(function(){
    Route::prefix('recipes')->name('recipes.')->group(function(){
        Route::get('/',[BloggerRecipeController::class,'recipes'])->name('create');//新增食譜
        Route::patch ('/{recipe}/launch',[BloggerRecipeController::class,'launch'])->name('launch');//上架
        Route::patch ('/{recipe}/stop',[BloggerRecipeController::class,'stop'])->name('stop');//下架
        Route::get('/{recipe}/edit',[BloggerRecipeController::class,'edit'])->name('edit');//食譜資料顯示
    });
});

//賣場
Route::prefix('product')->name('product.')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('product');//賣場首頁
    Route::get('add_product',[ProductController::class,'add_product'])->name('add_product');//新增商品葉面
    Route::get('cereals',[ProductController::class,'cereals'])->name('cereals');//穀物
    Route::get('fruit',[ProductController::class,'fruit'])->name('fruit');//水果
    Route::get('vegetable',[ProductController::class,'vegetable'])->name('vegetable');//蔬菜
    Route::get('meat',[ProductController::class,'meat'])->name('meat');//肉類
    Route::get('fresh',[ProductController::class,'fresh'])->name('fresh');//生鮮
    Route::get('milk',[ProductController::class,'milk'])->name('milk');//奶類
    Route::get('seasoning',[ProductController::class,'seasoning'])->name('seasoning');//調味
    Route::get('mushrooms',[ProductController::class,'mushrooms'])->name('mushrooms');//菇類
    Route::get('show',[ProductController::class,'show'])->name('show');//食材詳細資料
});
//賣場頁面(選擇性路由
Route::get('product',[ProductController::class,'product'])->name('product.product');

//會員專區

Route::get('members',[MemberController::class,'members'])->name('members.members');//個人資料
Route::get('cart_items',[MemberController::class,'cart_items'])->name('members.cart_items.index');//購物車
Route::get('collects',[MemberController::class,'collects'])->name('members.collects');//我的收藏
Route::get('recipes',[MemberController::class,'recipes'])->name('members.recipes');//我的食譜
Route::get('orders',[MemberController::class,'orders'])->name('members.orders');//我的訂單(所有
Route::get('cancel',[MemberController::class,'cancel'])->name('members.orders.cancel');//我的訂單(取消
Route::get('done',[MemberController::class,'done'])->name('members.orders.done');//我的訂單(完成
Route::get('show',[MemberController::class,'show'])->name('members.orders.show');//訂單詳細資料

Route::prefix('members')->name('members.')->group(function(){
    Route::get('/',[MemberController::class,'members'])->name('index');//個人資料
    Route::patch('/{member}',[MemberController::class,'update'])->name('update');//更新個人資料
    Route::post('/password',[MemberController::class,'updatepassword'])->name('password.update');//更新密碼
    Route::get('collects',[MemberController::class,'collects'])->name('collects');//我的收藏
    Route::get('recipes',[MemberController::class,'recipes'])->name('recipes');//我的食譜

    //會員-訂單
    Route::prefix('orders')->name('orders.')->group(function(){
        Route::get('/',[MemberOrderController::class,'index'])->name('index');//我的訂單(所有
        Route::get('cancel',[MemberOrderController::class,'cancel'])->name('cancel');//我的訂單(取消
        Route::get('done',[MemberOrderController::class,'done'])->name('done');//我的訂單(完成
        Route::get('show',[MemberOrderController::class,'show'])->name('show');//訂單詳細資料

    });
});


//購物車
Route::get('index',[CartItemController::class,'index'])->name('members.cart_items.index');//購物車
Route::get('finish',[CartItemController::class,'finish'])->name('members.cart_items.finish');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {


    Route::get('/dashboard', function (){
        $user=Auth::User();
        $type=$user->type;
        if($type=='1')
        {
            return redirect('/');
        }
        elseif($type=='2')
        {
            return redirect('admins/recipes');
        }
        return view('dashboard');

    })->name('dashboard');
});



    //平台人員
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/recipes',[AdminRecipeController::class,'index'])->name('recipes.index');//餐點列表
        Route::get('/recipes/create', [AdminRecipeController::class, 'create'])->name('recipes.create');//新增餐點頁面


        Route::get('/products',[AdminProductController::class,'index'])->name('products.index');//商品列表
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');//新增商品頁面

    });



Route::get('/logout',[HomeController::class,'logout'])->name('logout');

//辨別role，跳轉至各個使用者首面(1->member,2->admin)
Route::get('/redirects',[HomeController::class,'index'])->name('index');
