<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{url('/home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('settings/locations')}}">Customer Locations</a></li>
                    <li><a href="{{url('settings/products')}}">Products</a></li>
                    <li><a href="{{url('settings/sms-sender-id')}}">SMS Sender ID</a></li>
                    {{--<li><a href="pages/charts/flot.html">Channels</a></li>--}}
                </ul>
            </li>
            <li>
                <a href="{{url('transactions')}}">
                    <i class="fa fa-dashboard"></i> <span>New Transaction</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{url('customers')}}">
                    <i class="fa fa-male"></i><span>Customers</span>
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Customer Reports</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('reports/customers/most-number-purchases')}}">Most Number Of Purchases</a></li>
                    <li><a href="{{url('reports/customers/most-amount-purchases')}}">Most Amount Spent</a></li>
                    <li><a href="{{url('reports/customers/least-number-purchases')}}">Least Number Of Purchases</a></li>
                    <li><a href="{{url('reports/customers/least-amount-purchases')}}">Least Amount Spent</a></li>
                    <li><a href="{{url('reports/customers/by-location')}}">Customers By Location</a></li>
                    {{--<li><a href="pages/charts/flot.html">Channels</a></li>--}}
                </ul>
            </li>
            <li>
                <a href="{{url('users')}}">
                    <i class="fa fa-users"></i><span>Users Management</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{url('promotions')}}">
                    <i class="fa fa-desktop"></i> Promotions<span></span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{url('logout')}}">
                    <i class="fa fa-user"></i> <span>Logout</span>
                    </span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>