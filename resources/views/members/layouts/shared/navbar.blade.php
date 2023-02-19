<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 " href="{{route('blog.new')}}">食譜EasyGo</a>
    <!-- Sidebar Toggle-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <div class="container">
            <div class="row ">
                <div class="navbar-nav col-6  nav" style="color: #fefefe">
                    <a class="nav-link link-light " aria-current="page"  href="{{route('blog.new')}}">首頁</a>
                    <a class="nav-link link-light " aria-current="page"  href="#">購物車</a>

            </div>
        </div>
    </div>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            </i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('members.members')}}">個人資料</a></li>
                <li><a class="dropdown-item" href="{{route('members.orders')}}">我的訂單</a></li>
                <li><a class="dropdown-item" href="{{route('members.recipes')}}">我的食譜</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>

                <form method="get" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
            </ul>
        </li>
    </ul>
</nav>
