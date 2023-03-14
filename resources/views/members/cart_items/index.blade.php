@extends('members.layouts.master')

@section('page-title', '購物車')

@section('content')


    <h1>我的購物車</h1>
    <table class="table table-striped">
        <tr>
            <th colspan=2>商品名稱</th>
            <th nowrap class="text-right">商品單價</th>
            <th nowrap class="text-center">購買數量</th>
            <th nowrap class="text-right">小計</th>
            <th>功能</th>
        </tr>
{{--        @forelse($carts as $cart)--}}
            <tr>
                <td>
                    <a target="_blank" href="">
                        <img src="" class="img-thumbnail" style="width: 120px;">
                    </a>
                </td>
                <td>
                    <a target="_blank" href=""><h5></h5></a>
{{--                    @if(!$cart->product->on_sale)--}}
                        <div class="warning">该商品已下架</div>
{{--                    @endif--}}
                </td>
                <td class="text-right"></td>
                <td class="text-center"></td>
                <td class="text-right"></td>
                <td nowrap><a href="#" class="btn btn-danger btn-sm">移除</a></td>
            </tr>
{{--        @empty--}}

            <tr>
                <td><h1>購物車空無一物</h1></td>
            </tr>
{{--        @endforelse--}}
    </table>
@endsection



@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
