<div class="main-navbar">
        <ul class="nav-menu header-right">
            <li class="back-btn">
                <div class="mobile-back text-end">
                    <span>Back</span>
                    <i aria-hidden="true" class="fa fa-angle-right ps-2"></i>
                </div>
            </li>
        @if (auth()->check())
            <li class="user user-light rounded5" style="padding-top: 5px;padding-bottom: 5px;margin-top: 15px;margin-bottom: 15px;">
                <a href="#" class="nav-link menu-title"><i class="fas fa-user"></i> {{auth()->user()->name}}</a>
                <ul class="nav-submenu menu-content" style="width:170px;">
                    <li><a href="{{route('dashboard')}}" ><i class="fas fa-id-card"></i> Dashboard</a></li>
                    <li style="margin-left: 0px;"><a href="javascript:" onclick="Swal.fire({
                        title: 'Do you want to logout?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonColor: '#CF2228',
                        cancelButtonColor: '#363636',
                        confirmButtonText: `Yes`,
                        denyButtonText: `Don't Logout`,
                        }).then((result) => {
                        if (result.value) {
                        location.href='{{route('logout')}}';
                        } else{
                        Swal.fire('Canceled', '', 'info')
                        }
                        })" ><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </li>
        @else
            <li class="user user-light rounded5" style="padding-top: 5px;padding-bottom: 5px;margin-top: 15px;margin-bottom: 15px;">
                <a href="#" data-bs-toggle="modal" data-bs-target="#login_model" class="nav-link menu-title"><i class="fas fa-sign-in-alt"></i> login</a>
            </li>
        @endif
        </ul>
</div>
{{-- <li class="user user-light rounded5" style="background-color: #ef3f3e;">
    <a href="{{url('login')}}" style="color: #ffffff;font-weight: 900;">
        <!-- <i class="fas fa-user"></i> -->
        Book Table
    </a>
</li> --}}
