@extends('members.layouts.master')

@section('page-title', '訂單詳細資料')

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4">{$訂單編號}</h1>

        <!-- Main Content -->
        <form>
            <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">運送狀態</label>
            <div class="col-sm-9 bg-light p-3 border">
                備貨中
            </div>

            <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">收件地址</label>
            <div class="col-sm-9 bg-light p-3 border">
                徐翊筑<br>
                0912345678<br>
                新竹縣xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">品項</th>
                <th scope="col">數量</th>
                <th scope="col">金額</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <form>
            <table class="table">
                <th scope="col" class="text-start">總金額</th>
                <th scope="col" class="text-end">$</th>
            </table>
        </form>
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">付款方式</label>
        <form>
            <table class="table">
                <th scope="col" >線上付款</th>
            </table>
        </form>
        <table>
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">訂單時間</label>
            <label for="exampleFormControlInput1" type="date" class="text-end">yyyy/mm/dd</label><br>
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">付款時間</label>
            <label for="exampleFormControlInput1" type="date" class="text-end">yyyy/mm/dd</label>
        </table>
    </div>
@endsection
