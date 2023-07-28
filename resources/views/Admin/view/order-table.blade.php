@foreach($orders as $key=>$order)

<tr class="status-{{$order['order_status']}} class-all">
        <td class="">
            {{$key+1}}
        </td>
        <td class="table-column-pl-0">
            <a href="{{route('panel.Order.detail',[$order['o_id']])}}">{{$order['order_id']}}</a>
        </td>
        
        <td>{{$order['user_name']}}</td>
        <td>{{$order['restaurant_name']}}</td>
        <td>{{$order['order_type']}}</td>
        <td class="text-capitalize">
            @if($order['order_status']=='0')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                    <span class="legend-indicator bg-info"></span>{{('New')}}
                </span>
            @elseif($order['order_status']=='1')
                <span class="badge badge-soft-primary ml-2 ml-sm-3">
                    <span class="legend-indicator bg-primary"></span>{{('Accepted')}}
                </span>
            @elseif($order['order_status']=='2')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                    <span class="legend-indicator bg-warning"></span>{{('Picked')}}
                </span>
            @elseif($order['order_status']=='5')
                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                    <span class="legend-indicator bg-danger"></span>{{('Rejected')}}
                </span>
            @elseif($order['order_status']=='4')
                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                    <span class="legend-indicator bg-danger"></span>{{('Cancelled')}}
                </span>
            @elseif($order['order_status']=='3')
                <span class="badge badge-soft-success ml-2 ml-sm-3">
                    <span class="legend-indicator bg-success"></span>{{('Completed')}}
                </span>
            @endif
        </td>
        <td>{{$order['payment_type']}}</td>
        <td>{{$order['grand_total']}}₹</td>
        <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
        <td>
            @if($order['order_status']=='0')
            <a class="btn btn-sm btn-info" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '1']) }}','Change status to accepted ?', event)"><i class="tio-checkmark-circle-outlined"></i> {{('Accept')}}</a>
            <a class="btn btn-sm btn-danger" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '4']) }}','Change status to cancelled ?', event)"><i class="tio-remove-from-trash"></i> {{('Cancel')}}</a>
            @elseif($order['order_status']=='1')
            <a class="btn btn-sm btn-warning" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '2']) }}','Change status to picked ?', event)"><i class="tio-poi-user"></i> {{('Pick')}}</a>
            @elseif($order['order_status']=='2')
            <a class="btn btn-sm btn-success" onclick="status_change_alert('{{ route('panel.Order.status', ['order_id' => $order['order_id'], 'order_status' => '3']) }}','Change status to out for completed ?', event)"><i class="tio-checkmark-circle"></i> {{('Complete')}}</a>
            @endif
            <a class="btn btn-sm btn-secondary" href="{{route('panel.Order.detail',['o_id'=>$order['o_id']])}}"><i class="tio-visible"></i> </a>

        </td>
    </tr>

@endforeach
