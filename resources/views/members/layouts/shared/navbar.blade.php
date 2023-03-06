<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container px-lg-5">
        <a class="navbar-brand" href="{{route('blog.new')}}">食譜EasyGo</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.new') }}">進入食譜網&ensp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.product') }}">進入食材網&ensp;</a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->status == '0')
                        <script>alert('管理者登入成功');window.location.href='{{ route('admin.dashboard.index') }}'</script>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('bloggers.recipes.create')}}">寫食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.cart_items.index')}}">購物車</a></li>
                                <li><a class="dropdown-item" href="{{route('members.recipes')}}">發表過的食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.collects')}}">我的收藏</a></li>
                                <li><a class="dropdown-item" href="{{route('members.members')}}">會員資料</a></li>
                                <li><a class="dropdown-item" href="{{route('members.orders')}}">所有訂單</a></li>

                                <li><a class="dropdown-item" href="{{ route('logout') }}">登出</a></li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
                @endif
            </ul>
        </div>
    </div>



{{--    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i--}}
{{--            class="fas fa-bars"></i></button>--}}
{{--    <!-- Navbar Search-->--}}
{{--    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">--}}
{{--        <div class="input-group">--}}
{{--            </i></button>--}}
{{--        </div>--}}
{{--    </form>--}}
    <!-- Navbar-->
</nav>
