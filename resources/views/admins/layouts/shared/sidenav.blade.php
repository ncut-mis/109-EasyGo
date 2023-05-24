<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{route('admins.recipes.index')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    食譜管理
                </a>
                <a class="nav-link" href="{{route('admins.products.index')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    商品管理
                </a>
                <div class="btn-group">

                    <a class="nav-link btn" href="{{route('admins.orders.check_apply')}}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        訂單管理
                    </a>
                    <button type="button" class="btn  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true" >
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('admins.orders.check_apply')}}">待審核訂單</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.cancel_apply')}}">申請取消訂單</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.audited')}}">已成立</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.ship')}}">出貨中</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.shipped')}}">已出貨</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.arrival')}}">已送達</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.done')}}">已完成</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.cancel')}}">已取消</a></li>
                        <li><a class="dropdown-item" href="{{route('admins.orders.index')}}">全部</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </nav>
</div>
