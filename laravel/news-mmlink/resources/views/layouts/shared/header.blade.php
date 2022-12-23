<div class="c-wrapper">
  <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
      <span class="c-header-toggler-icon"></span>
    </button>
    <a class="c-header-brand d-sm-none" href="#"></a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <?php
        use App\MenuBuilder\FreelyPositionedMenus;
        if(isset($appMenus['top menu'])){
            FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
        }
    ?>  

    <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/mm-link.png') }}" width="200" height="46" alt="Logo" style="margin-left: 40%; align-self:center">

    <ul class="c-header-nav ml-auto mr-4">

      <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
          {{ Session::get('user_name') }} &nbsp;&nbsp;<div class="c-avatar">  
          <img class="c-avatar-img" src="{{ url('/assets/img/avatars/user.png') }}" alt="user@email.com"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
          <div class="dropdown"></div>
          <a class="dropdown-item" >
            <form action="{{ url('/logout') }}" method="POST"> 
              @csrf 
              <button type="submit" class="btn">      
                <svg class="c-icon mr-2">
                  <use xlink:href="{{ url('/icons/sprites/free.svg#cil-account-logout') }}"></use>
                </svg> 
                Logout
              </button>
            </form>
          </a>
        </div>
      </li>
    </ul>
  {{--   <div class="c-subheader px-3">
      <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <?php $segments = ''; ?>
        @for($i = 1; $i <= count(Request::segments()); $i++)
            <?php $segments .= '/'. Request::segment($i); ?>
            @if($i < count(Request::segments()))
                <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
            @else
                <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
            @endif
        @endfor
      </ol>
    </div> --}}
  </header>
