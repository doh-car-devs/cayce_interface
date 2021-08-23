<aside class="main-sidebar sidebar-dark-olive elevation-4">
    <!-- Brand Logo -->
    <a href="{{redirect('dashboard')->with('feature-new', 'Have a great day!')}}" class="brand-link">
        <img src="{{asset('assets/icons/DOH-Logo.png')}}" alt="DOH Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DOH-CAR <small class="text-muted">Portal</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pt-1 pb-1 mb-1 d-flex">
            <div class="image my-auto">
                <img src="{{asset('assets/icons/ICT-Logo.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('userprofile.show',1)}}" class="d-block m-0 p-0" data-placement="bottom" data-tt="tooltip" title="Complete Name">
                    {{auth()->user()->prefix.' '.auth()->user()->name_family.', '.auth()->user()->name .' '. auth()->user()->name_middle}}
                </a>
                <small class="cyan m-0 p-0 blue" data-placement="bottom" data-tt="tooltip" title="Position">{{auth()->user()->designation}}</small><br>
                <small class=" m-0 p-0 indigo" data-placement="bottom" data-tt="tooltip" title="Assignment">{{session('division.division_abbr')}} - {{session('section.section_abbr')}}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview"
                role="menu" data-accordion="true">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link @menuActive('dashboard', 'active')">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <li class="nav-header">Page Groups</li>
                @foreach (session('user_link_group') as $key => $group)
                @if ($group->link_group !== "hidden")
                    <li class="nav-item has-treeview" id="tree{{$key}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                {{$group->link_group}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach (session('user_links') as $link)
                                @if ($link->link_group == $group->link_group && $link->link_group !== "hidden")
                                    <li class="nav-item">
                                        <a href="{{route($link->link)}}" class="nav-link @menuActive($link->uri, 'active') mainnavlink">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{$link->name}}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
                @endforeach
                <li class="nav-item has-treeview" id="tree">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('userprofile.show',1)}}" class="nav-link @menuActive($link->uri ?? '#', 'active') mainnavlink">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-header">List View</li>
                <li class="nav-header">Support</li> --}}
                <li class="nav-header text-white">Requests</li>
                <li class="nav-item">
                    <a href="{{route('pt.pr.create')}}" class="nav-link @menuActive('pt/pr', 'active')">
                        <i class="nav-icon fas fa-folder-plus"></i>
                        <p> Purchase Request </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('item.requests')}}" class="nav-link @menuActive('item/requests', 'active')">
                        <i class="nav-icon fas fa-folder-plus"></i>
                        <p> Item Request </p>
                    </a>
                </li>

                <li class="nav-header">MISCELLANEOUS</li>

                <li class="nav-item has-treeview" id="tree">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt nav-icon"></i>
                        <p>
                            FMTIS Documentation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('portalpipeline')}}" class="nav-link @menuActive($link->uri ?? '#', 'active') mainnavlink">
                                <i class="fas fa-tasks nav-icon"></i>
                                <p>Project Pipeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a target="_blank" href="https://bit.ly/FMTIS_manual" class="nav-link ">
                                <i class="fas fa-file-word nav-icon"></i>
                                <p>Documentation</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview" id="tree">
                    <a href="#" class="nav-link">
                        <i class="fas fa-scroll nav-icon"></i>
                        <p>
                            Forms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a target="_blank" href="http://192.168.224.68:2019/HDF"  class="nav-link ">
                                <i class="fas fa-laptop-medical nav-icon"></i>
                                <p>Health Declaration Form</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a target="_blank" href="http://192.168.224.68:2019/profiling"  class="nav-link ">
                                <i class="fas fa-syringe nav-icon"></i>
                                <p>Vaccine Profiling Form</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
