@php($sunday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Sunday')->first())
@php($monday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Monday')->first())
@php($tuesday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Tuesday')->first())
@php($wednesday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Wednesday')->first())
@php($thursday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Thursday')->first())
@php($friday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Friday')->first())
@php($saturday=App\Models\restaurant_time_slot::where('restaurant_id',$restaurant_id)->where('day','Saturday')->first())

    <div class="schedule-item">
        <span class="btn">{{('Monday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$monday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$monday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$monday->time_slot_id}}" {{$monday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
            <div class="schedult-date-content" id="mon{{$monday->time_slot_id}}" @if($monday->is_close==0)style="display:none;"@endif>
                <span class="d-inline-flex align-items-center">
                    <span class="start--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Opening Time</span>
                            {{$monday->from_time}}
                        </span>
                    </span>
                    <span class="end--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Closing Time</span>
                            {{$monday->to_time}}
                        </span>
                    </span>
                </span>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$monday->time_slot_id}}" data-dayid="1" data-day="{{('monday')}}"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn">{{('Tuesday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$tuesday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$tuesday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$tuesday->time_slot_id}}" {{$tuesday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        <div class="schedult-date-content" id="tue{{$tuesday->time_slot_id}}" @if($tuesday->is_close==0)style="display:none;"@endif>
                <span class="d-inline-flex align-items-center">
                    <span class="start--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Opening Time</span>
                            {{$tuesday->from_time}}
                        </span>
                    </span>
                    <span class="end--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Closing Time</span>
                            {{$tuesday->to_time}}
                        </span>
                    </span>
                </span>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$tuesday->time_slot_id}}" data-dayid="2" data-day="{{('tuesday')}}"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
            <span class="btn">{{('Wednesday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$wednesday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$wednesday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$wednesday->time_slot_id}}" {{$wednesday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
            <div class="schedult-date-content" id="wed{{$wednesday->time_slot_id}}" @if($wednesday->is_close==0)style="display:none;"@endif>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Opening Time</span>
                                {{$wednesday->from_time}}
                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Closing Time</span>
                                {{$wednesday->to_time}}
                            </span>
                        </span>
                    </span>
                <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$wednesday->time_slot_id}}" data-dayid="3" data-day="{{('wednesday')}}"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn">{{('Thursday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$thursday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$thursday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$thursday->time_slot_id}}" {{$thursday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        <div class="schedult-date-content" id="thu{{$thursday->time_slot_id}}" @if($thursday->is_close==0)style="display:none;"@endif>
            
                <span class="d-inline-flex align-items-center">
                    <span class="start--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Opening Time</span>
                            {{$thursday->from_time}}
                        </span>
                    </span>
                    <span class="end--time">
                        <span class="clock--icon">
                            <i class="tio-time"></i>
                        </span>
                        <span class="info">
                            <span>Closing Time</span>
                            {{$thursday->to_time}}
                        </span>
                    </span>
                </span>
                
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$thursday->time_slot_id}}" data-dayid="4" data-day="{{('thursday')}}"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn">{{('Friday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$friday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$friday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$friday->time_slot_id}}" {{$friday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        <div class="schedult-date-content" id="fri{{$friday->time_slot_id}}" @if($friday->is_close==0)style="display:none;"@endif>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Opening Time</span>
                                {{$friday->from_time}}
                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Closing Time</span>
                                {{$friday->to_time}}
                            </span>
                        </span>
                    </span>
                
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$friday->time_slot_id}}" data-dayid="5" data-day="{{('friday')}}"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn">{{('Saturday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$saturday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$saturday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$saturday->time_slot_id}}" {{$saturday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        <div class="schedult-date-content" id="sat{{$saturday->time_slot_id}}" @if($saturday->is_close==0)style="display:none;"@endif>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Opening Time</span>
                                {{$saturday->from_time}}
                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Closing Time</span>
                                {{$saturday->to_time}}
                            </span>
                        </span>
                    </span>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$saturday->time_slot_id}}" data-dayid="6" data-day="{{('saturday')}}"><i class="tio-add"></i></span>
    </div>
</div>

    <div class="schedule-item">
        <span class="btn">{{('Sunday')}}</span>
            <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox2{{$sunday->time_slot_id}}">
                <input type="checkbox" onchange="onoffslot({{$sunday->time_slot_id}},{{$restaurant_id}})" class="toggle-switch-input" id="stocksCheckbox2{{$sunday->time_slot_id}}" {{$sunday->is_close?'checked':''}}>
                <span class="toggle-switch-label">
                    <span class="toggle-switch-indicator"></span>
                </span>
            </label>
        <div class="schedult-date-content" id="sun{{$sunday->time_slot_id}}" @if($sunday->is_close==0)style="display:none;"@endif>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Opening Time</span>
                                {{$sunday->from_time}}
                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span>Closing Time</span>
                                {{$sunday->to_time}}
                            </span>
                        </span>
                    </span>
                
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal{{$sunday->time_slot_id}}" data-dayid="0" data-day="{{('sunday')}}"><i class="tio-add"></i></span>
    </div>
</div>