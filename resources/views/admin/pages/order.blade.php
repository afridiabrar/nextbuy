@extends('admin.layout.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

    @include('admin.layout.error')
<div class="content-div">
    <div class="head col-md-12 d-inline-block">
      <p class="table-heading mt-4">orders</p>
    </div>
    <div class="col-md-12">
      <table id="dtBasicExample" width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead>
        <tr>
          
          <th>Invoice #id</th>
          <th>User Name</th>
          <th>Address</th>
          <th>Name</th>
          <th>Product Price</th>
          <th>Assign Drvier</th>
          <th>Order Status</th>
        <th>Payment Type</th>
          
          <th>Action</th>
        </tr>
          </thead>
          <tbody>
        @foreach ($order as $vvvv)

        <tr>
          
        <td>{{ $vvvv->receipt_no }}</td>
          <td>{{ $vvvv->user['f_name'] }}</td>
          <td>
              <p>{{ $vvvv->address->first_name }} {{ $vvvv->address->last_name }}</p>
              <p>{{ $vvvv->address->address1 }} ,{{ $vvvv->address->postcode }},{{ $vvvv->address->city }}</p>

          </td>
          <td>
              @foreach ($vvvv->order_product as $vv)
            <p><?= (!empty($vv->product->name)) ? $vv->product->name : "" ?>  </p>
            @endforeach
          </td>
          <td>
          @foreach ($vvvv->order_product as $val)

          </br>{{ (!empty($val->product->price)) ? number_format($val->product->price,2) : ""}} aed
          @endforeach
        </td>
        <td>
            <select name="driver_id" onchange="getdriver(this,'{{$vvvv->id}}')">
              <option value="">Select Driver</option>
                @foreach ($driver as $item)
            <option value="{{ $item->id}}" {{ $vvvv->driver_id == $item->id ? "selected" : ""}}>{{ $item->name}}</option>
                @endforeach
            </select>
          </td>
          <td>
              <select name="status" onchange="getdata('{{$vvvv->id}}',this.value)" class="black-select">
                  <option value="Pending" {{ $vvvv->status == 'Pending' ? "selected" : "" }}>Pending</option>
                  <option value="Processing" {{ $vvvv->status == 'Processing' ? "selected" : "" }}>Processing</option>
                  <option value="Completed" {{ $vvvv->status == 'Completed' ? "selected" : "" }}>Completed</option>
              </select>
          </td>
          <td>{{ $vvvv->payment_type}}</td>
        <td>

            <a  href="{{ route('edit_order',['id'=>$vvvv->id]) }}" class=""><button class="view-button">Edit</button></a>
            <a  href="{{ route('s_order',['id'=>$vvvv->id]) }}" class=""><button class="view-button">View</button></a>
            <a  href="{{ route('customerInvoice',['id'=>$vvvv->id]) }}" class=""><button class="view-button">Customer Invoice</button></a>
            <a  href="{{ route('admin_invoice',['id'=>$vvvv->id]) }}" class=""><button class="view-button">Admin Invoice</button></a>

         </td>
        </tr>
        @endforeach
          </tbody>
      </table>
      <div class="paging"> {{ $order->links()}} </div>
    </div>
  </div>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        window.onload = function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        }
    function getdriver(e,order_id)
    {

      var id = e.options[e.selectedIndex].value;
      var trimid = $.trim(id);
      var url = "{{ url('changeDriver') }}/"+trimid+"/"+order_id;
          $.get(url, function(data, status){
            window.parent.location.reload();
          });
    }
      function getdata(id,val)
      {

          var url = "{{ url('changeOrderstatus') }}/" + id + "/" + val;
          $.get(url, function(data, status){
            window.parent.location.reload();

          });

      }
    </script>

@endsection
