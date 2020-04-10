@extends('admin.layout.app')
@section('content')
<div class="content-div">

    @include('admin.layout.error')
		<div class="head col-md-12 d-inline-block">
            <p class="table-heading mt-4">Users</p>
        </div>
        
        <div class="col-md-12">
		
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th>Image</th>
                <th>Full Name</th>
                <th>Contact No.</th>
                <th>Email Address</th>
                <th>Action</th>
              </tr>
              @foreach($user as $k => $v)
                @if($v->is_admin == 0)
              <tr>
                  @php
                  
                    $img = ($v->profile_pic) ? $v->profile_pic : 'public/images/images.png';
                
              @endphp
              <td style="text-align:center;"><img src="{{ asset($img) }}" width="100" height="100"></td>
                <td>{{ $v->f_name }} {{ $v->l_name }}</td>
                <td>{{ (!empty($v->phone_no)) ? $v->phone_no : "Null" }}</td>
                <td>{{ $v->email }}</td>
                <td>                    
                <select name="status" onchange="getdata('{{$v->id}}',this.value)" class="black-select">
                    <option value="Activate" {{ $v->status == 'Activate' ? "selected" : "" }}>Activate</option>
                    <option value="Deactivate" {{ $v->status == 'Deactivate' ? "selected" : "" }}>Deactivate</option>
                </select>
                <a data-fancybox data-type="iframe" data-src="" href="{{ route('popup_edit_user',['id'=>$v->id]) }}" class=""><button class="view-button">View</button></a>
                </td>
              </tr>
                @endif
              @endforeach
              
              
            </table>
            <div class="paging"> 
                {{$user->links()}}
            </div>
        </div>

	</div>
  <script>
      function getdata(id,val)
      {
        
          var url = "{{ url('changeuserstatus') }}/" + id + "/" + val;
          $.get(url, function(data, status){
            window.parent.location.reload();
      
          });
    
      }
    </script>

@endsection
