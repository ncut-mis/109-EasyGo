@extends('members.layouts.master')
@section('page-title', '新增食譜')
@section('content')

    <section class="py-5">
        <div class="container px-5 my-5 ">
            <div class="row gx-5">

                {{--如果有成功訊息，顯示該訊息--}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{--如果有錯誤訊息，顯示該訊息--}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        <form action="{{route('bloggers.recipes.store')}}" method="POST" style="display: inline-block">
             @method('post')
             @csrf

            <!-- Post title-->
            <h1 class="fw-bolder mb-1">寫食譜</h1>
            <div class="mb-3">
                <!--食譜名稱-->
                <div class="mb-3">
                    <label class="form-label" for="name">食譜名稱</label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱">
                </div>

                <!--食譜類別-->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">食譜類別</label>
                    <select class="form-select" aria-label="Default select example" name="recipe_category_id" id="recipe_category_id">
                        <option selected>選擇食譜類別</option>
                        <!--迴圈抓取categories資料表資料-->
                        @foreach($recipe_categories as $recipe_category)
                            <option value="{{$recipe_category->id}}">{{$recipe_category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!--食譜是否上架-->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">是否上架</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status" value="1">
                            <label class="form-check-label" for="flexRadioDefault1">是</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"  name="status" id="status" value="0" checked>
                            <label class="form-check-label" for="flexRadioDefault2">否</label>
                        </div>
                </div>

                <!--食譜簡介-->
                <div class="mb-3">
                    <label for="text" class="form-label">食譜簡介</label>
                    <textarea name="text" id="text" class="form-control" rows="7" placeholder="請輸入食譜簡介"></textarea><!--多行輸入框 -->
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-secondary btn-lg">下一頁</button>
                </div>

                </div>

                </form>
            </div>
        </div>
    </section>
@endsection
