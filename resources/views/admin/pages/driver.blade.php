@extends('admin.layout.app')
@section('content')    
<div class="content-div">
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('AdddriverPopup')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">Driver</p>
        </div>
        <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th>Driver Name</th>
              <th>Phone No</th>
              <th>Driver License</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
              <th>Nic Number</th>
              <th>For Index</th>
              <th>Action</th>
            </tr>
            @if(count($driver) > 0)
            @foreach ($driver as $v)
            <tr>
              <td>{{ $v->name}}</td>
              <td>{{ $v->phone_no}} </br>
              {{ $v->phone_no_2 }}</td>
              <td>{{ $v->driving_lic }}</td>
              <td>{{ $v->email }}</td>
              <td>{{ $v->Address }}</td>
              <td>{{ $v->city }}</td>
              <td>{{ $v->identity }}</td>
              <td>
                  <select name="status" onchange="getdata('{{$v->id}}',this.value)" class="black-select">
                    <option value="Active" {{ $v->status == 'Active' ? "selected" : "" }}>Featured</option>
                    <option value="InActive" {{ $v->status == 'InActive' ? "selected" : "" }}>UnFeatured</option>
                </select>
                </td>
              <td>
            <a data-fancybox data-type="iframe" data-src="" href="{{ route('EditdriverPopup',['id'=>$v->id])}}" class="">
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
      
        var url = "{{ url('changeDriver') }}/" + id + "/" + val;
        $.get(url, function(data, status){
          window.parent.location.reload();
    
        });
  
    }
  </script>
@endsection
