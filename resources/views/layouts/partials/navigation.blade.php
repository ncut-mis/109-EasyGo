<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container px-lg-5">
        <a class="navbar-brand" href="{{route('blog.new')}}">食譜EasyGo</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.new') }}">首頁&ensp;</a>
                </li>



                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      類別
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                      <li><a class="dropdown-item" href="{{route('blog.china')}}">中式</a></li>
                                      <li><a class="dropdown-item" href="{{route('blog.western')}}">西式</a></li>
                                      <li><a class="dropdown-item" href="{{route('blog.japan')}}">日式</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                <a class="nav-link link-light " aria-current="page"  href="{{route('blogger.recipes')}}">寫食譜</a>
                <li class="nav-item active">
                    <a class="nav-link" href="">購物車&ensp;</a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->status == '0')
                        <script>alert('管理者登入成功');window.location.href='{{ route('admin.dashboard.index') }}'</script>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('blogger.recipes')}}">寫食譜</a></li>
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

                <!-- Navbar Search-->
{{--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 " action="" method="get">--}}
{{--    <div class="input-group">--}}
{{--        <input type="text" class="input-text" style="width:250px" placeholder="輸入餐點名稱"  name="search" id="search">--}}
{{--        <button type="submit" class="btn btn-success">搜尋</button>--}}
{{--    </div>--}}
{{--</form>--}}

{{--
 <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">--}}


{{--                              @if (Route::has('login'))--}}
{{--                                  <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--                                      @auth--}}
{{--                                          <a href="{{ url('/dashboard') }}" class="tbadge bg-light text-dark ">Dashboard</a>--}}
{{--                                          <a href="" class="tbadge bg-light text-dark ">會員</a>--}}
{{--                                      @else--}}
{{--                                          <a href="{{ route('login') }}" class="badge bg-light text-dark ">Log in</a>--}}

{{--                                          @if (Route::has('register'))--}}
{{--                                              <a href="{{ route('register') }}" class="badge bg-light text-dark">Register</a>--}}
{{--                                          @endif--}}
{{--                                      @endauth--}}
{{--                                  </div>--}}
{{--                          @endif--}}

</nav>
