<header class="main-header">

    <!-- Logo -->
    <a href="https://library.greensoftbd.xyz/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Linn&#8230;</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Linn LMS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                                    <li class="dropdown tasks-menu">
                        <a href="https://library.greensoftbd.xyz/" target="_blank" title="View Frontend" aria-expanded="true">
                          <i class="fa fa-globe"></i>
                        </a>
                    </li>
                                <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="languageimage" src="https://library.greensoftbd.xyz/uploads/language/english.png" alt="">
                    <span class="label label-danger">4</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Please select your language</li>
                    <li>
                      <ul class="menu">
                        <li>
                          <a href="https://library.greensoftbd.xyz/dashboard/langswitch/english">
                            <h3>
                                <img class="languageimage" src="https://library.greensoftbd.xyz/uploads/language/english.png" alt="">
                                English <i class='fa fa-check'></i>                            </h3>
                          </a>
                        </li>
                        <li>
                          <a href="https://library.greensoftbd.xyz/dashboard/langswitch/hindi">
                            <h3>
                                <img class="languageimage" src="https://library.greensoftbd.xyz/uploads/language/hindi.png" alt="">
                                Myanmar                             </h3>
                          </a>
                        </li>
                        
                      </ul>
                    </li>
                  </ul>
                </li>
                <!-- user Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://library.greensoftbd.xyz/uploads/member/default.png" class="user-image" alt="user Image">
                      <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- user image -->
                        <li class="user-header">
                            <img src="https://library.greensoftbd.xyz/uploads/member/default.png" class="img-circle" alt="user Image">

                            <p>{{auth()->user()->name}} - {{auth()->user()->roles[0]->name}}<small> Member Since - {{date('d-M-Y',strtotime(auth()->user()->created_at))}}</small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="https://library.greensoftbd.xyz/profile/index" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              
                            <!-- <a class="btn btn-default btn-flat">Sign out</a> -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                               <!-- <a class="btn btn-default btn-flat"></a> -->
                               <button class="btn btn-default btn-flat">Sign out</button>
                                {{ csrf_field() }}
                            </form>

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>