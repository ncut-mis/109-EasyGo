@extends('members.layouts.master')

@section('page-title', '食譜內容')

@section('content')

    <section class="py-0">
        <div class="container px-5 my-5 ">
            <div class="row gx-3">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-danger btn-lg">發布</button>
                    <button type="button" class="btn  btn-lg">儲存</button>
                    <button type="button" class="btn btn-lg">取消</button>
                </div>

                <!-- Post title-->
                <div class="mb-3">
                    <!--食譜名稱-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">食譜名稱</label>
                        <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                        <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱" value="{{$recipe->name}}">
                    </div>

                    <!--食譜封面-->
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">食譜封面</label>
                        <!--輪播圖片-->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe_imgs as $key => $recipe_img)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{asset('img/recipe/'.$recipe_img->picture)}}" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" class="form-control">
                    </div>

                    <!--食譜類別-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">食譜類別</label>
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                                @foreach ($recipe_categories as $recipe_category)
                                    <!--顯示目前設定的食譜類別，並可選擇其他類別-->
                                    <option value="{{ $recipe_category->id }}" {{ $recipe->recipe_category_id == $recipe_category->id ? 'selected' : '' }}>{{ $recipe_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!--食譜簡介-->
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">食譜簡介</label>
                        <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder="請輸入食譜簡介">{{$recipe->text}}</textarea><!--多行輸入框-->
                    </div>
                </div>

                <!--食材-->
                <div class="mb-3">
                    <h1 class="fw-bolder mb-1">食材<button type="button" class="btn btn-lg">+</button></h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">名稱</th>
                                <th scope="col">數量</th>
                                <th scope="col">類別</th>
{{--                                <th scope="col">數量</th>--}}
{{--                                <th scope="col">數量</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recipe_ingredients as $recipe_ingredient)
                                <tr>
                                    <td><input name="name" id="name" type="text" class="form-control" placeholder="請輸入食材名稱" value="{{$recipe_ingredient->name}}"></td>
                                    <td><input type="text" class="name" value="{{$recipe_ingredient->quantity}}"></td>
                                    <td><input type="text" class="name" value="{{$recipe_ingredient->category->name}}"></td>
                                </tr>
                            @endforeach
{{--                                <td><input type="text" class="name" value=""></td>--}}
                        </tbody>
                    </table>
                </div>

                <!--步驟-->
                <div class="mb-3">
                    <h1 class="fw-bolder mb-2">步驟<button type="button" class="btn btn-lg">+</button></h1>
                    @foreach ($recipe_steps as $recipe_step)
                    <div class="card w-80 mb-3">
                        <div class="row g-0">
                            @if($recipe_step->picture!=null)
                                <div class="col-md-4">
                                    <img class="d-block w-100" src="{{asset('img/step/'.$recipe_step->picture)}}" alt="...">
                                    <div class="navbar-fixed-bottom">
                                        <input type="file" name="stepimage" id="stepimage" accept="image/*" class="form-control">
                                    </div>
                                </div>
                            @else
                                <div class="row col-md-4 align-items-center">
                                    <h1 class="card-title text-secondary">目前無照片</h1>
                                    <div class="navbar-fixed-bottom">
                                        <input type="file" name="stepimage" id="stepimage" accept="image/*" class="form-control">
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-8">
                                <div class="card-body mb-3">
                                    <h2 class="card-title mb-6">步驟{{$recipe_step->sequence}}<button type="button" class="btn btn-lg">－</button></h2>
                                    <textarea name="text" id="text" class="form-control" rows="7" placeholder="">{{$recipe_step->text}}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
