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

            xhr.open('POST', "{{route('members.cart_items.update')}}"); // Specify the HTTP method and endpoint

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    location.reload();
                }
            };

            //送出表單
            xhr.send(formData);
        }
    </script>

    </style>
    <br>
    <header class="masthead">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <br><center><h1><b>購物車</b></h1></center>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <center><hr width="80%"></center>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <br>
                            <th width="20%" style="text-align: center">圖片</th>
                            <th width="20%" style="text-align: center">名稱</th>
                            <th width="10%" style="text-align: center">單價</th>
                            <th width="10%" style="text-align: center">數量</th>
                            <th width="15%" style="text-align: center">功能</th>
                        </tr>
                        </thead>
                        <tbody>
        @forelse ($carts as $cart)
            <tr>
                <td>
                    <a target="_blank" href="">
                        <img src="./img/product/{{ $cart->picture }}" class="img-thumbnail" style="width: 120px;">
                    </a>
                </td>
                <td>
                    <a target="_blank" href=""><h5></h5></a>
                    @if(!$cart->status)
                        <div class="warning">{{ $cart->name }}<font color="#FF0000">(商品被下架)</font></div>
                    @else
                        <div class="warning">{{  $cart->name  }}</div>
                    @endif
                </td>
                <td class="text-right">${{  $cart->price  }}</td>
                <td class="text-center"><input type="number" id="quantity" name="quantity" min="1" value="{{  $cart->quantity  }}" onchange="post_update_quantity('{{$cart->id}}', this.value);"></td>


                <td nowrap>
                    <form action="{{route('members.cart_items.remove')}}" method="post">
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
                <div style="text-align:right">
{{--                    <b>總計：{{$total}} 元</b>--}}
                </div>
                <div style="text-align:center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       前往結帳
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">注意!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @forelse ($carts as $cart)
                                        @if(!$cart->status)

                                            <div class="warning">▶{{  $cart->name  }}</div>
                                            <h2><b><font color="#FF0000">!!!!!被下架囉!!!!!</font></b></h2>
                                        @else
                                            
                                        @endif
                                    @empty
                                            @endforelse


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-outline-primary" href="{{route('members.cart_items.finish')}}">前往結帳</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection



@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
