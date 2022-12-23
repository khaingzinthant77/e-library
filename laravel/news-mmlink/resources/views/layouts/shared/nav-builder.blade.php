<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';    
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>

    
        <div class="c-sidebar-brand">
            {{-- <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/mm-link.png') }}" width="200" height="46" alt="Logo">
            <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/mini.png') }}" width="46" height="46" alt="Logo"> --}}
            {{ Session::get('user_name') }}
        </div>

        <ul class="c-sidebar-nav ps">

            {{-- <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link " href="{{ url('/')}}">
                    <i class="cil-speedometer c-sidebar-nav-icon"></i>
                    Dashboard
                </a>
            </li> --}}
            {{-- <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="{{ url('/tickets')}}">
                    <i class="cil-task c-sidebar-nav-icon"></i>Tickets
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets/vip')}}">
                            <span class="c-sidebar-nav-icon"></span> VIP Tickets
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets')}}">
                            <span class="c-sidebar-nav-icon"></span> Tickets List
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets/new')}}">
                            <span class="c-sidebar-nav-icon"></span> New Tickets
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets/assign')}}">
                            <span class="c-sidebar-nav-icon"></span> Assign Tickets
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets/solved')}}">
                            <span class="c-sidebar-nav-icon"></span> Solved Tickets
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/tickets/suspend')}}">
                            <span class="c-sidebar-nav-icon"></span>  Suspend Tickets
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/news')}}">
                   <i class="cil-newspaper c-sidebar-nav-icon"></i>
                    News
                </a>
            </li>
             <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/token')}}">
                   <i class="cil-info c-sidebar-nav-icon"></i>
                    Token
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/popup_ads')}}">
                   <i class="cil-info c-sidebar-nav-icon"></i>
                    Popup Ads
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/rating')}}">
                   <i class="cil-info c-sidebar-nav-icon"></i>
                    Rating
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/billing_contact')}}">
                   <i class="cil-newspaper c-sidebar-nav-icon"></i>
                    Billing Contact
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/setting_url')}}">
                   <i class="cil-settings c-sidebar-nav-icon"></i>
                    Setting URL
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/contract')}}" target="_blank">
                   <i class="cil-info c-sidebar-nav-icon"></i>
                    Tearm & Condtition
                </a>
            </li>
            @if (session()->get('user_level') === "Administrator")
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link " href="{{ url('/action_logs')}}">
                    <i class="cil-settings c-sidebar-nav-icon"></i>
                    Action Logs
                </a>
            </li>
            @endif
          
        </ul>
        {{-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div> 
        </div> --}}
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>