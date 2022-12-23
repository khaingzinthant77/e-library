@extends('layouts.authBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <div class="text-center">
                <img class="c-sidebar-brand-full " src="{{ url('/assets/brand/mm-link.png') }}" width="200" height="46" alt="Logo">
                </div>
                <br><br>
               
                <div class="row">
                  <div class="col-md-1">
                    <a href="{{ url('/login') }}">
                       <svg class="c-icon">
                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-arrow-left"></use>
                        </svg>
                    </a>
                  </div>
                  <div class="col-md-10">
                      @if(Session::has('userId'))
                       <p class="text-left"><b>{{ Session::get('userId') }}</p>
                      @endif
                  </div>
                </div>
              
                 <p class="text-left"><b>OTP Code</p>
                  <form method="POST" action="{{ route('apiLogin') }}">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        @if(Session::has('message'))
                        <p style="color: red">{{ Session::get('message') }}</p>
                        @endif
                      </div>
                    </div>
                    
                    <div class="input-group ">
                      <input class="form-control" type="number" placeholder="XXXXXX" name="password" value="{{ old('password') }}" required autofocus>
                      <input type="hidden" name="loginId" value="{{ Session::get('userId') }}">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-8">
                          <p> If you have any OTP code!</p>
                        </div>
                        <div class="col-4">
                            <a href="#" id="resentCode" style="color: #0079b3;text-decoration-line: underline;cursor: pointer;">Resend</a>
                             {{--  <form method="POST" id="resendOTPForm" action="{{ route('loginrequest') }}">
                                @csrf

                                  <div class="input-group ">
                                    <input class="form-control" type="hidden" placeholder="loginId" name="loginId" value="{{ Session::get('userId') }}" >
                                  </div>
                              </form> --}}
                        </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-12 text-center"  >
                          <button class="btn btn-primary px-4" style="background-color: #4179b2" type="submit">Sign In</button>
                      </div>
                    </div>
                  </form>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection