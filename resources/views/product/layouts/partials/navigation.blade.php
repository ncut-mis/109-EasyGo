<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container px-lg-5">
        <a class="navbar-brand" href="{{route('product.product')}}">賣場EasyGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <div class="container">
              <div class="row ">
                  <div class="navbar-nav col-6  nav" style="color: #fefefe">
                      <a class="nav-link link-light " aria-current="page"  href="{{route('product.product')}}">首頁</a>
                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      類別
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                      <li><a class="dropdown-item" href="{{route('product.cereals')}}">穀物</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.fruit')}}">水果</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.vegetable')}}">蔬菜</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.meat')}}">肉類</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.fresh')}}">生鮮</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.milk')}}">奶類</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.seasoning')}}">調味</a></li>
                                      <li><a class="dropdown-item" href="{{route('product.mushrooms')}}">菇類</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                      <a class="nav-link link-light " aria-current="page"  href="{{route('product.product')}}">購物車</a>
                      <a class="nav-link link-light " aria-current="page"  href="{{route('product.product')}}">會員專區</a>
                  </div>
              </div>
          </div>
        </div>
    </div>
</nav>
