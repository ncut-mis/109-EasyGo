<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container px-lg-5">
        <a class="navbar-brand" href="{{route('blog.new')}}">食材EasyGo</a>

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 " action="{{route('search')}}" method="get">
            <div class="input-group">
                <input type="text" class="input-text" style="width:550px" placeholder="輸入食譜名稱"  name="search" id="search">
                <button type="submit" class="btn btn-success">搜尋</button>
            </div>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.product') }}">進入食材網&ensp;</a>
                </li>



                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      食譜類別
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                      <li><a class="dropdown-item" href="{{route('blog.china')}}">中式</a></li>
                                      <li><a class="dropdown-item" href="{{route('blog.western')}}">西式</a></li>
                                      <li><a class="dropdown-item" href="{{route('blog.japan')}}">日式</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->type == '1')
                <a class="nav-link link-light " aria-current="page"  href="{{route('bloggers.recipes.create')}}">寫食譜</a>

{{--                <li class="nav-item active">--}}
{{--                    <a class="nav-link" href="">購物車&ensp;</a>--}}
{{--                </li>--}}


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('bloggers.recipes.create')}}">寫食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.cart_items.index')}}">購物車</a></li>
                                <li><a class="dropdown-item" href="{{route('members.recipes')}}">發表過的食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.collects')}}">我的收藏</a></li>
                                <li><a class="dropdown-item" href="{{route('members.index')}}">會員資料</a></li>
                                <li><a class="dropdown-item" href="{{route('members.orders.index')}}">所有訂單</a></li>

                                <li><a class="dropdown-item" href="{{ route('logout') }}">登出</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                <li><a class="dropdown-item" href="{{ route('logout') }}">登出</a></li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">註冊</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
                @endif


</nav>
