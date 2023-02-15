<?php

use App\Http\Controllers\BloggerRecipeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
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
//測試
Route::get('/welcome',function (){
    return view('welcome');
});

//食譜部落格
Route::get('/',[RecipeController::class,'index'])->name('blog.new');//首頁
//中式
Route::get('china',[RecipeController::class,'china'])->name('blog.china');
//西式
Route::get('western',[RecipeController::class,'western'])->name('blog.western');
//日式
Route::get('japan',[RecipeController::class,'japan'])->name('blog.japan');


//食譜頁面(選擇性路由
Route::get('recipe',[RecipeController::class,'recipe'])->name('recipe.recipe');
//部落客
Route::get('blogger',[BloggerRecipeController::class,'recipes'])->name('blogger.recipes');


//賣場
Route::prefix('product')->name('product.')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('product');//賣場首頁
    Route::get('cereals',[ProductController::class,'cereals'])->name('cereals');//穀物
    Route::get('fruit',[ProductController::class,'fruit'])->name('fruit');//水果
    Route::get('vegetable',[ProductController::class,'vegetable'])->name('vegetable');//蔬菜
    Route::get('meat',[ProductController::class,'meat'])->name('meat');//肉類
    Route::get('fresh',[ProductController::class,'fresh'])->name('fresh');//生鮮
    Route::get('milk',[ProductController::class,'milk'])->name('milk');//奶類
    Route::get('seasoning',[ProductController::class,'seasoning'])->name('seasoning');//調味
    Route::get('mushrooms',[ProductController::class,'mushrooms'])->name('mushrooms');//菇類
});
//賣場頁面(選擇性路由
Route::get('product',[ProductController::class,'product'])->name('product.product');

//會員專區
Route::get('members',[MemberController::class,'members'])->name('members.members');//個人資料
Route::get('collects',[MemberController::class,'collects'])->name('members.collects');//我的收藏
Route::get('recipes',[MemberController::class,'recipes'])->name('members.recipes');//我的食譜
Route::get('orders',[MemberController::class,'orders'])->name('members.orders');//我的訂單(所有
Route::get('cancelorders',[MemberController::class,'cancelorders'])->name('members.cancelorders');//我的訂單(取消
Route::get('finishorders',[MemberController::class,'finishorders'])->name('members.finishorders');//我的訂單(完成

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
