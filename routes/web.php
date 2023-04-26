<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRecipeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BloggerRecipeController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CollectController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Livewire\BloggerRecipeEdit;
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



//平台人員登入
Route::get('adminlogin',[AdminLoginController::class,'adminlogin'])->name('blog.adminlogin');
//中式
Route::get('china',[RecipeController::class,'china'])->name('blog.china');
//西式
Route::get('western',[RecipeController::class,'western'])->name('blog.western');
//日式
Route::get('japan',[RecipeController::class,'japan'])->name('blog.japan');


//食譜頁面(選擇性路由
Route::get('recipe',[RecipeController::class,'recipe'])->name('recipe.recipe');

//部落客
Route::get('create',[BloggerRecipeController::class,'create'])->name('bloggers.recipes.create');
Route::get('create2',[BloggerRecipeController::class,'create2'])->name('bloggers.recipes.create2');



//部落客
Route::prefix('bloggers')->name('bloggers.')->group(function(){
    Route::prefix('recipes')->name('recipes.')->group(function(){
        Route::get('/',[BloggerRecipeController::class,'recipes'])->name('create');//新增食譜
        Route::patch ('/{recipe}/launch',[BloggerRecipeController::class,'launch'])->name('launch');//上架
        Route::patch ('/{recipe}/stop',[BloggerRecipeController::class,'stop'])->name('stop');//下架
        //Route::get('/{recipe}/edit',[BloggerRecipeController::class,'edit'])->name('edit');//食譜資料編輯
        Route::get('/{recipe}/edit',BloggerRecipeEdit::class)->name('edit');//食譜資料編輯

       // Route::patch('/recipes/{recipe}', [BloggerRecipeController::class,'update'])->name('update');//食譜更新

    });
});

//賣場
Route::prefix('product')->name('product.')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('product');//賣場首頁
    Route::get('detail',[ProductController::class,'detail'])->name('detail');//產品詳細
    Route::get('add_product',[ProductController::class,'add_product'])->name('add_product');//新增商品葉面
    Route::get('cereals',[ProductController::class,'cereals'])->name('cereals');//穀物
    Route::get('fruit',[ProductController::class,'fruit'])->name('fruit');//水果
    Route::get('vegetable',[ProductController::class,'vegetable'])->name('vegetable');//蔬菜
    Route::get('meat',[ProductController::class,'meat'])->name('meat');//肉類
    Route::get('fresh',[ProductController::class,'fresh'])->name('fresh');//生鮮
    Route::get('milk',[ProductController::class,'milk'])->name('milk');//奶類
    Route::get('seasoning',[ProductController::class,'seasoning'])->name('seasoning');//調味
    Route::get('mushrooms',[ProductController::class,'mushrooms'])->name('mushrooms');//菇類
    Route::get('show/{product}',[ProductController::class,'show'])->name('show');//食材詳細資料

});
//賣場頁面(選擇性路由
Route::get('product',[ProductController::class,'product'])->name('product.product');

//會員專區
Route::get('cart_items',[MemberController::class,'cart_items'])->name('members.cart_items.index');//購物車

Route::get('recipes',[MemberController::class,'recipes'])->name('members.recipes');//我的食譜

Route::prefix('members')->name('members.')->group(function(){
    //個資
    Route::get('/',[MemberController::class,'members'])->name('index');//個人資料
    Route::patch('{member}',[MemberController::class,'update'])->name('update');//更新個人資料
    Route::post('password',[MemberController::class,'updatepassword'])->name('password.update');//更新密碼

    //收藏
    Route::prefix('collects')->name('collects.')->group(function(){
        Route::get('/',[CollectController::class,'index'])->name('index');//我的收藏
        Route::post('/{recipe}',[CollectController::class,'store'])->name('store');//食譜加入收藏
        Route::delete('/{collect}',[CollectController::class,'destroy'])->name('destroy');//取消食譜收藏
    });

    Route::prefix('recipes')->name('recipes.')->group(function(){
        Route::get('/',[MemberController::class,'recipes'])->name('index');//我的食譜
        Route::get('show/{recipe}',[RecipeController::class,'show'])->name('show');//檢視某一食譜
    });

    //會員-訂單
    Route::prefix('orders')->name('orders.')->group(function(){
        Route::get('/',[MemberOrderController::class,'index'])->name('index');//顯示所有訂單
        Route::get('cancel',[MemberOrderController::class,'cancel'])->name('cancel');//顯示已取消訂單
        Route::get('done',[MemberOrderController::class,'done'])->name('done');//顯示已完成訂單
        Route::get('{order}',[MemberOrderController::class,'show'])->name('show');//訂單詳細資料
        Route::patch('{order}/cancel',[MemberOrderController::class,'cancel_update'])->name('cancel_update');//取消訂單
        Route::patch('{order}/done',[MemberOrderController::class,'done_update'])->name('done_update');//完成訂單

    });
});


//購物車
Route::get('index',[CartItemController::class,'index'])->name('members.cart_items.index');//購物車
Route::post('remove',[CartItemController::class,'destroy'])->name('members.cart_items.remove');//刪除購物車商品
Route::post('store',[CartItemController::class,'store'])->name('members.cart_items.store');//商品加入購物車
Route::post('update',[CartItemController::class,'update'])->name('members.cart_items.update');
Route::get('finish',[CartItemController::class,'finish'])->name('members.cart_items.finish');//結帳
Route::post('order', [OrderController::class, 'checkout'])->name('members.orders.checkout'); //下訂單

//留言
Route::prefix('comment')->name('comment.')->group(function(){
    Route::post('create',[CommentController::class,'create'])->name('create');
});


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
        Route::prefix('recipes')->name('recipes.')->group(function(){
            Route::get('/',[AdminRecipeController::class,'index'])->name('index');//餐點列表
            Route::patch ('/{recipe}/launch',[AdminRecipeController::class,'launch'])->name('launch');//上架
            Route::patch ('/{recipe}/stop',[AdminRecipeController::class,'stop'])->name('stop');//下架
            Route::get('/create', [AdminRecipeController::class, 'create'])->name('create');//新增餐點頁面
        });
        //食材
        Route::get('/logins',[AdminLoginController::class,'index'])->name('login.index');//商品列表
        Route::get('/products',[AdminProductController::class,'index'])->name('products.index');//商品列表
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');//新增商品頁面
        Route::get('/products/{product}',[AdminProductController::class,'show'])->name('products.show');//商品詳細
        Route::post('/products/store',[AdminProductController::class,'store'])->name('products.store');//儲存商品
        Route::delete('/products/{product}',[AdminProductController::class,'destroy'])->name('products.destroy');//刪除商品
        Route::patch ('/products/{product}/launch',[AdminProductController::class,'launch'])->name('products.launch');//上架
        Route::patch ('/products/{product}/stop',[AdminProductController::class,'stop'])->name('products.stop');//下架
        Route::get('/products/{product}/edit',[AdminProductController::class,'edit'])->name('products.edit');//修改商品
        Route::patch('/products/{product}}',[AdminProductController::class,'update'])->name('products.update');//更新商品


        //訂單
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/',[AdminOrderController::class,'index'])->name('index');//訂單列表
            Route::get('/cancel_apply',[AdminOrderController::class,'cancel_apply'])->name('cancel_apply');//取消申請訂單列表
            Route::get('/check_apply',[AdminOrderController::class,'check_apply'])->name('check_apply');//審核訂單列表
            Route::get('/audited',[AdminOrderController::class,'audited'])->name('audited');//已成立訂單列表
            Route::get('/ship',[AdminOrderController::class,'ship'])->name('ship');//出貨中訂單列表
            Route::get('/shipped',[AdminOrderController::class,'shipped'])->name('shipped');//已出貨訂單列表
            Route::get('/arrival',[AdminOrderController::class,'arrival'])->name('arrival');//已送達訂單列表
            Route::get('/done',[AdminOrderController::class,'done'])->name('done');//已完成訂單列表
            Route::get('/cancel',[AdminOrderController::class,'cancel'])->name('cancel');//已取消訂單列表
            Route::get('/{order}/',[AdminOrderController::class,'show'])->name('show');//訂單詳細資料
            Route::patch('/{order}/update_check',[AdminOrderController::class,'update_check'])->name('update_check');//確認訂單
            Route::patch('/{order}/update_cancel',[AdminOrderController::class,'update_cancel'])->name('update_cancel');//修改訂單狀態
            Route::patch('/{order}',[AdminOrderController::class,'update'])->name('update');//修改訂單狀態
        });
    });



Route::get('/logout',[HomeController::class,'logout'])->name('logout');

//辨別role，跳轉至各個使用者首面(1->member,2->admin)
Route::get('/redirects',[HomeController::class,'index'])->name('index');
