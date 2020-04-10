@extends('admin.layout.app')
@section('content')    
<div class="content-div">
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('AddCouponPopup')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">Coupon</p>
        </div>
        <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th>Coupon Name</th>
              <th>Coupon Code</th>
              <th>Coupon Value</th>
              <th>Coupon Type</th>
              <th>Action</th>
            </tr>
            @if(count($coupon) > 0)
            @foreach ($coupon as $v)
            <tr>
              <td>{{ $v->name}}</td>
              <td>{{ $v->code }}</td>
              <td>
                @if($v->type == 'percentage') 
                 {{ $v->coupon_value}}%
                @elseif($v->type == 'dollar')
                ${{ $v->coupon_value}}
                @endif
              </td>
             
  
              <td>
                  <select name="status" onchange="getdata('{{$v->id}}',this.value)" class="black-select">
                    <option value="Active" {{ $v->status == 'Active' ? "selected" : "" }}>Active</option>
                    <option value="InActive" {{ $v->status == 'InActive' ? "selected" : "" }}>InActive</option>
                </select>
                </td>
              <td>
            <a data-fancybox data-type="iframe" data-src="" href="{{ route('EditCouponPopup',['id'=>$v->id])}}" class="">
                <button class="view-button">Edit</button>
              </a>
              {{-- <a href="#" >
                <button class="delete-button">Delete</button>
              </a>                 --}}
                </td>
            </tr>
            @endforeach

            @endif

          </table>
          <div class="paging">

          </div>
        </div>
</div>
<script>
    function getdata(id,val)
    {
      
        var url = "{{ url('changeCoupon') }}/" + id + "/" + val;
        $.get(url, function(data, status){
          window.parent.location.reload();
    
        });
  
    }
  </script>
@endsection
