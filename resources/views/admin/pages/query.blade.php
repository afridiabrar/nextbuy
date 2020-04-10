@extends('admin.layout.app')
@section('content')
<div class="content-div">
    <div class="head col-md-12 d-inline-block">
      <p class="table-heading mt-4">queries</p>
    </div>
    <div class="col-md-12">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>     
          <th>User Name</th>
          <th>Email Address</th>
          <th>Contact Number</th>
          <th>Query Type</th>
          <th>Admin Respond</th>
          {{-- <th>Admin Message</th>
          <th>Massage</th> --}}
          <th>Action</th>
        </tr>
        @if(count($query) > 0)
        @foreach ($query as $v)
        <tr>
          
        <td>{{ $v->name}}</td>
        <td>{{ $v->email}}</td>
        <td>{{ $v->phone_no}}</td>
        <td>{{ $v->query_type}}</td>
        <td>{{ substr($v->message , 0, 20)}}...</td>
        {{-- <td>{{  ($v->is_responded == 1) ? 'Yes' : 'No'}}</td>
        <td>{{ substr($v->admin_respond , 0, 20)}}...</td> --}}
        <td><a data-fancybox="" data-type="iframe" data-src="" href="{{ route('view_query',['id'=>$v->id])}}" class="">
              <button class="view-button">View</button>
              </a></td>
          </tr>
        @endforeach
        @endif
     
      
      </table>
      <div class="paging">
        {{ $query->links()}}  
      </div>
    </div>
  </div>
@endsection
