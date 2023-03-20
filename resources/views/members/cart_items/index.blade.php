@extends('members.layouts.master')

@section('page-title', '購物車')

@section('content')

    <script>
        function post_update_quantity(product_id, quantity)
        {
            var formData = new FormData();

            formData.append('_token', "{{ csrf_token() }}");
            formData.append('product_id', product_id);
            formData.append('quantity', quantity);

            const xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object

            xhr.open('POST', "{{    route('members.cart_items.update')    }}"); // Specify the HTTP method and endpoint

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    location.reload();
                }
            };

            //送出表單
            xhr.send(formData);
        }
    </script>
    <h1>我的購物車</h1>
    <table class="table table-striped">
        <tr>
            <th colspan=2>商品名稱</th>
            <th nowrap class="text-right">商品單價</th>
            <th nowrap class="text-center">購買數量</th>
            <th nowrap class="text-right">小計</th>
            <th>功能</th>
        </tr>
        @forelse($carts as $cart)
            <tr>
                <td>
                    <a target="_blank" href="">
                        <img src="./img/product/{{ $cart->picture }}" class="img-thumbnail" style="width: 120px;">
                    </a>
                </td>
                <td>
                    <a target="_blank" href=""><h5></h5></a>
                    @if(!$cart->status)
                        <div class="warning">该商品已下架</div>
                    @else
                        <div class="warning">{{  $cart->name  }}</div>
                    @endif
                </td>
                <td class="text-right">${{  $cart->price  }}</td>
                <td class="text-center"><input type="number" id="quantity" name="quantity" min="1" value="{{  $cart->quantity  }}" onchange="post_update_quantity('{{$cart->id}}', this.value);"></td>
                <td class="text-right" id="display_price">${{  $cart->price * $cart->quantity  }}</td>
                <td nowrap>
                    <form action="{{    route('members.cart_items.remove')    }}" method="post">
                        @csrf <!-- Laravel's built-in CSRF protection -->
                        <input name="id" value="{{$cart->id}}" style="display:none"/>
                        <button class="btn btn-danger btn-sm">移除</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td><h1>購物車空無一物</h1></td>
            </tr>
        @endforelse
    </table>
@endsection



@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
