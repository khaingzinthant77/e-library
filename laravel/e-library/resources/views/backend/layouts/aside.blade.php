<aside class="main-sidebar">
<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <a href="https://library.greensoftbd.xyz/profile/index">
                <img src="https://library.greensoftbd.xyz/uploads/member/default.png" class="img-circle" style="height: 45px; width: 50px" alt="User Image">
            </a>
        </div>
        <div class="pull-left info">
            <p>Admin</p>
            <a href="https://library.greensoftbd.xyz/profile/index"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
            <li class=" active">
                <a href="{{url('admin/dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                        </a>
                                </li>

            
            

            <li class=" ">
                <a href="{{url('admin/member')}}">
                    <i class="fa fa-user-plus"></i> <span>Member</span>
                            </a>
                    </li>
            
            @can('ebook_list')
            
            <li class="treeview ">
                <a href="{{url('admin/e_books')}}">
                    <i class="fa lms-book"></i> <span>Ebook</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                            <ul class="treeview-menu" style="display: none">
                                @can('book_list')
                                    <li class=" ">
                                        <a href="{{url('admin/e_books')}}">
                                            <i class="fa lms-study"></i> <span>Ebook</span>
                                        </a>
                                    </li>
                                @endcan
                                <li class=" ">
                                        <a href="{{url('admin/ebook_rents')}}">
                                            <i class="fa lms-study"></i> <span>Ebook Rent</span>
                                        </a>
                                    </li>
                                </ul>
                                            
                                </li>

            @endcan

            @can('author_list')
            <li class="">
                <a href="{{url('admin/authors')}}">
                    <i class="fa fa-user-plus"></i> <span>Author</span>
                                        </a>
                                </li>
            @endcan


            <li class="treeview ">
                <a href="{{url('admin/physical_books')}}">
                    <i class="fa lms-book"></i> <span>Books</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                            @can('book_list')
                                                <li class=""><a href="{{url('admin/physical_books')}}"><i class="fa fa-book"></i>Book</a></li>
                                            @endcan

                                            @can('book_issue_list')
                                            <li class="">
                                                <a href="{{url('admin/bookissue')}}">
                                                    <i class="fa lms-educational-book"></i> <span>Book Issue</span>
                                                                        </a>
                                                                </li>
                                            @endcan

                                            @can('rack_list')
                                                <li class=""><a href="{{url('admin/rack')}}"><i class="fa lms-bookshelf"></i>Rack</a></li>
                                            @endcan

                                            @can('category_list')
                                                <li class=""><a href="{{url('admin/categories')}}"><i class="fa lms-notebook"></i>Book Category</a></li>
                                            @endcan
                                              
                                            </ul>
                                </li>
                @can('slider_list')
                <li class=" ">
                    <a href="{{url('admin/sliders')}}">
                        <i class="fa lms-educational-book"></i><span>Sliders</span>
                   </a>
                </li>
                @endcan

                <li class=" ">
                    <a href="{{url('admin/favourites')}}">
                        <i class="fa lms-educational-book"></i><span>Favourite List</span>
                   </a>
                </li>
            
            <li class=" ">
                <a href="{{url('admin/request_books')}}">
                    <i class="fa lms-professor"></i> <span>Request Book</span>
               </a>
            </li>
        
           <!--  <li class="treeview ">
                <a href="https://library.greensoftbd.xyz/#">
                    <i class="fa fa-shopping-cart"></i> <span>Store Management</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                                <li class=""><a href="https://library.greensoftbd.xyz/order"><i class="fa fa-first-order"></i>Order</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/storebook"><i class="fa fa-book"></i>Store Book</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/storebookcategory"><i class="fa lms-notebook"></i>Store Book Category</a></li>
                                            </ul>
                                </li>
         -->
            <!-- <li class=" ">
                <a href="https://library.greensoftbd.xyz/emailsend">
                    <i class="fa fa-envelope"></i> <span>Email Send</span>
                                        </a>
                                </li>
        
            <li class="treeview ">
                <a href="https://library.greensoftbd.xyz/#">
                    <i class="fa lms-merchant"></i> <span>Account</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                                <li class=""><a href="https://library.greensoftbd.xyz/income"><i class="fa lms-incomes"></i>Income</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/expense"><i class="fa lms-salary"></i>Expense</a></li>
                                            </ul>
                                </li> -->
        
            <li class="treeview ">
                <a href="https://library.greensoftbd.xyz/#">
                    <i class="fa fa-clipboard"></i> <span>Reports</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                                <li class=""><a href="https://library.greensoftbd.xyz/bookreport"><i class="fa lms-library"></i>Book Report</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/bookissuereport"><i class="fa lms-writing"></i>Book Issue Report</a></li>
                                                <!-- <li class=""><a href="https://library.greensoftbd.xyz/memberreport"><i class="fa lms-community"></i>Member Report</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/idcardreport"><i class="fa lms-id-card"></i>ID Card Report</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/transactionreport"><i class="fa fa-credit-card"></i>Transaction Report</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/bookbarcodereport"><i class="fa fa-barcode"></i>Book Barcode Report</a></li> -->
                                            </ul>
                                </li>
        
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-lock"></i> <span>Administrator</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                                <li class=""><a href="{{url('admin/users')}}"><i class="fa fa-bars"></i>Login User</a></li>
                                                <li class=""><a href="{{url('admin/roles')}}"><i class="fa fa-users"></i>Role</a></li>
                                                <!-- <li class=""><a href="https://library.greensoftbd.xyz/emailtemplate"><i class="fa lms-template-design"></i>Email Template</a></li> -->
                                                <!-- <li class=""><a href="https://library.greensoftbd.xyz/permissions"><i class="fa fa-balance-scale"></i>Permissions</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/permissionlog"><i class="fa fa-key"></i>Permissionlog</a></li> -->
                                                <!-- <li class=""><a href="https://library.greensoftbd.xyz/update"><i class="fa fa-upload"></i>Update</a></li> -->
                                                <li class=""><a href="https://library.greensoftbd.xyz/backup"><i class="fa fa-download"></i>Backup</a></li>
                                               <!--  <li class=""><a href="https://library.greensoftbd.xyz/bulkimport"><i class="fa fa-upload"></i>Bulk Import</a> --></li>
                                            </ul>
                                </li>
        
            <li class="treeview ">
                <a href="https://library.greensoftbd.xyz/#">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                                                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                        </a>
                                        <ul class="treeview-menu" style="display: none">
                                                <li class=""><a href="https://library.greensoftbd.xyz/generalsetting"><i class="fa fa-cog"></i>General Setting</a></li>
                                                <!-- <li class=""><a href="https://library.greensoftbd.xyz/emailsetting"><i class="fa lms-open-envelope"></i>Email Setting</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/libraryconfigure"><i class="fa lms-settings"></i>Library Configure</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/themesetting"><i class="fa fa-paint-brush"></i>Theme Setting</a></li>
                                                <li class=""><a href="https://library.greensoftbd.xyz/paymentsetting"><i class="fa fa-credit-card-alt"></i>Payment Setting</a></li> -->
                                            </ul>
                                </li>
                </ul>
</section>
</aside>