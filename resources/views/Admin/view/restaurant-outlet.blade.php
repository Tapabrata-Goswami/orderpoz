@extends('Admin.app')

@section('title',('Restaurant Detail'))

@push('css_or_js')
<!-- Custom styles for this page -->
<link href="{{asset('back-end/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <style>
        .flex-item{
            padding: 10px;
            flex: 20%;
        }

        /* Responsive layout - makes a one column-layout instead of a two-column layout */
        @media (max-width: 768px) {
            .flex-item{
                flex: 50%;
            }
        }

        @media (max-width: 480px) {
            .flex-item{
                flex: 100%;
            }
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('panel.dashboard')}}">{{('Dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{('Restaurant Detail')}}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{route('panel.Restaurant.list')}}" class="btn btn-primary mt-3 mb-3">{{('Back to Restaurant list')}}</a>
            </div>
        </div>
        <!-- Page Header -->
        <div class="page-header">
        <div class="flex-between row mx-1 row">
            <div class="col-6">
                <h1 class="page-header-title">{{ $restaurant->restaurant_name? $restaurant->restaurant_name : "Restaurant Name : Update Please" }}</h1>
            </div>
            <div class="col-6">
                <a href="javascript:" data-toggle="modal" data-target="#shipping-address-modal" class="btn btn-primary float-right link">
                    <i class="tio-edit"></i> {{('Add Outlet')}}
                </a>
            </div>
        </div>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',[$restaurant['restaurant_id']])}}">{{('Restaurant')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'review']) }}">{{('Review')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'outlet']) }}">{{('Outlets')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('panel.Restaurant.detail',['restaurant_id'=>$restaurant->restaurant_id, 'tab'=>'booktable']) }}">{{('Booked Tables')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
        <!-- End Page Header -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product">
            <div class="row pt-2">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="flex-start">
                                <div class="mx-1"><h3>{{('Outlets')}}</h3></div>
                                <div><h3><span style="color: red;">({{$outlets->total()}})</span></h3></div>
                            </div>
                        </div>
                        <div class="table-responsive datatable-custom">
                            <table id="columnSearchDatatable"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                   class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   data-hs-datatables-options='{
                                        "order": [],
                                        "orderCellsTop": true,
                                        "paging": false
                                    }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{('SL#')}}</th>
                                        <th>{{('Branch')}}</th>
                                        <th>{{('Address')}}</th>
                                        <th>{{('Area')}}</th>
                                        <th>{{('City')}}</th>
                                        <th>{{('State')}}</th>
                                        <th>{{('Active/Inactive')}}</th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">
                                @foreach($outlets as $k=>$c)
                                <tr>
                                    <th scope="row">{{$outlets->firstItem()+$k}}</th>
                                    <td>{!! $c->is_main=='1'?'Main Branch':'Sub Branch' !!}</td>
                                    <td>{{$c->outlet_gps_address}}</td>
                                    <td>{{$c->outlet_area}}</td>
                                    <td>{{$c->outlet_city}}</td>
                                    <td>{{$c->outlet_state}}</td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$c->outlet_id}}">
                                            <input type="checkbox" onclick="status_change_alert('{{route('panel.Restaurant.status-update-outlet',[$c->outlet_id,$c->outlet_status?0:1])}}', '{{('You want to change this Outlet status')}}', event)" class="toggle-switch-input" id="stocksCheckbox{{$c->outlet_id}}" {{$c->outlet_status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    {{--<td>
                                        <a class="btn btn-white btn-sm" href="javascript:"
                                           onclick="status_change_alert('{{route('panel.Restaurant.delete-outlet',[$c->outlet_id])}}','{{('Want to delete this outlet ?')}}',event)">
                                            <i class="tio-delete-outlined text-danger"></i>
                                        </a>
                                    </td>--}}
                                </tr>

                            @endforeach
                                </tbody>
                            </table>


                        </div>
                        <div class="card-footer">
                    {{$outlets->links()}}
                </div>
                @if(count($outlets)==0)
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{asset('back-end/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0">{{('No data to show')}}</p>
                    </div>
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="shipping-address-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-top-cover btn-secondary text-center">
                <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="0 0 1920 100.1">
                        <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
                    </svg>
                </figure>

                <div class="modal-close">
                    <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal"
                            aria-label="Close">
                        <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                    d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- End Header -->

            <div class="modal-top-cover-icon">
                <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                    <i class="tio-android-phone-vs"></i>
                </span>
            </div>

            <form action="{{route('panel.Restaurant.store-outlet')}}" method="post">
                @csrf
                <div class="modal-body">
                    
                    <div class="row mb-3">
                        <label for="requiredLabel" class="col-md-3 col-form-label input-label text-md-right">
                            {{('Address')}}
                        </label>
                        <div class="col-md-9 js-form-message">
                            <input type="text" class="form-control" id="outlet_gps_address" name="outlet_gps_address" value="" required>
                            <input type="hidden" class="form-control" id="outlet_gps_lat" name="outlet_gps_lat" value="" required>
                            <input type="hidden" class="form-control" id="outlet_gps_lng" name="outlet_gps_lng" value="" required>
                            <input type="hidden" class="form-control" name="restaurant_id" value="{{$restaurant['restaurant_id']}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="requiredLabel" class="col-md-3 col-form-label input-label text-md-right">
                            {{('Area')}}
                        </label>
                        <div class="col-md-9 js-form-message">
                            <input type="text" class="form-control" id="outlet_area" name="outlet_area" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="requiredLabel" class="col-md-3 col-form-label input-label text-md-right">
                            {{('City')}}
                        </label>
                        <div class="col-md-9 js-form-message">
                            <input type="text" class="form-control" id="outlet_city" name="outlet_city" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="requiredLabel" class="col-md-3 col-form-label input-label text-md-right">
                            {{('State')}}
                        </label>
                        <div class="col-md-9 js-form-message">
                            <input type="text" class="form-control" id="outlet_state" name="outlet_state" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{{('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{('save')}} {{('changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

@endsection

@push('script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&libraries=places&country=ind"></script>
<script type="text/javascript">
  function initialize() {
  var input = document.getElementById('outlet_gps_address');
  var options = {
    types: ['address'],
    // componentRestrictions: {
    //   country: 'in'
    // }
  };
  autocomplete = new google.maps.places.Autocomplete(input, options);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          var code = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "locality") {
          var city = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "sublocality_level_1") {
          var area = place.address_components[i].long_name;
        }
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          var state = place.address_components[i].long_name;
        }
      }
    }
      var address = place.formatted_address;
      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();

      document.getElementById("outlet_gps_lat").value = latitude;
      document.getElementById("outlet_gps_lng").value = longitude;
    //   document.getElementById("outlet_area").value = area;
    //   document.getElementById("outlet_city").value = city;
    //   document.getElementById("outlet_state").value = state;
  })
}
google.maps.event.addDomListener(window, "load", initialize);
</script>
<script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href=url;
                }
            })
        }

        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

    </script>
@endpush
