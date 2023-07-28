<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

    <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['new'])}}" style="background: #FFFFFF">
        <div class="card-body">
            <div class="flex-between align-items-center mb-1">
                <div style="text-align: left;">
                    <h6 class="card-subtitle" style="color: #EF3F3E!important;">Pending</h6>
                    <span class="card-title h2" style="color: #EF3F3E!important;">
                    {{$data['pending']}}
                    </span>
                </div>
                <div class="mt-2">
                    <i class="tio-shopping-cart" style="font-size: 30px;color: #EF3F3E;"></i>
                </div>
            </div>

        </div>
    </a>

</div>
<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

    <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['accepted'])}}" style="background: #FFFFFF;">
        <div class="card-body">
            <div class="flex-between align-items-center mb-1">
                <div style="text-align: left;">
                    <h6 class="card-subtitle" style="color: #EF3F3E!important;">Accepted</h6>
                    <span class="card-title h2" style="color: #EF3F3E!important;">
                    {{$data['accepted']}}
                    </span>
                </div>
                <div class="mt-2">
                    <i class="tio-checkmark-circle-outlined" style="font-size: 30px;color: #EF3F3E"></i>
                </div>
            </div>

        </div>
    </a>

</div>
<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

    <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['completed'])}}" style="background: #FFFFFF">
        <div class="card-body">
            <div class="flex-between align-items-center gx-2 mb-1">
                <div style="text-align: left;">
                    <h6 class="card-subtitle" style="color: #EF3F3E!important;">Completed</h6>
                    <span class="card-title h2" style="color: #EF3F3E!important;">
                    {{$data['completed']}}
                    </span>
                </div>
                <div class="mt-2">
                    <i class="tio-checkmark-circle" style="font-size: 30px;color: #EF3F3E"></i>
                </div>
            </div>

        </div>
    </a>

</div>
<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">

    <a class="card card-hover-shadow h-100" href="{{route('panel.Order.list', ['cancelled'])}}" style="background: #FFFFFFff">
        <div class="card-body">
            <div class="flex-between align-items-center gx-2 mb-1">
                <div style="text-align: left;">
                    <h6 class="card-subtitle" style="color: #EF3F3E!important;">Cancelled/Rejected</h6>
                    <span class="card-title h2" style="color: #EF3F3E!important;">
                    {{$data['cancelled']}}
                    </span>
                </div>
                <div class="mt-2">
                    <i class="tio-remove-from-trash" style="font-size: 30px;color: #EF3F3E"></i>
                </div>
            </div>

        </div>
    </a>

</div>
