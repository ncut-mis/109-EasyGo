<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <li class="container px-lg-5">
        <a class="navbar-brand" href="{{route('product.product')}}">食材EasyGo</a>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 " action="{{route('search')}}" method="get">
            <div class="input-group">
                <input type="text" class="input-text" style="width:550px" placeholder="輸入食材名稱"  name="search" id="search">
                <button type="submit" class="btn btn-success">搜尋</button>
            </div>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.new') }}">進入食譜網</a>
                </li>

                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                              <li class="nav-item dropdown">

                              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      食材類別
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                      <li><a class="dropdown-item" href="{{route('product.cereals')}}">穀物</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.fruit')}}">水果</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.vegetable')}}">蔬菜</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.meat')}}">肉類</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.fresh')}}">海鮮</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.milk')}}">奶類</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.seasoning')}}">調味</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.mushrooms')}}">菇類</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>

                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->type == '2')
                <a class="nav-link link-light " aria-current="page"  href="{{route('product.add_product')}}">上架商品</a>
                    @endif
                @endif

                    @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->type == '1')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('bloggers.recipes.create')}}">寫食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.cart_items.index')}}">購物車</a></li>
                                <li><a class="dropdown-item" href="{{route('members.recipes.index')}}">發表過的食譜</a></li>
                                <li><a class="dropdown-item" href="{{route('members.collects.index')}}">我的收藏</a></li>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
            @endif
              </div>
            </ul>
          </div>
        </div>
    </div>
</nav>
