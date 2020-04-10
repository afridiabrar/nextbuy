@extends('admin.layout.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
    
    <div class="content-div">
      @include('web.layout.error')
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('addMedia')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">Product Media</p>
        </div>
        <div class="col-md-12">
          <table id="dtBasicExample" width="100%" border="0" cellspacing="0" cellpadding="0">
              <thead>
            <tr>
              <th width="30%">Image</th>
              <th width="40%">Link</th>
              <th width="30%">Action</th>
            </tr>
              </thead>
              <tbody>
                
              @if(count($media) > 0)
            @foreach ($media as $item)
            <?php $img = ($item ->image) ? $item->image : 'https://seeba.se/wp-content/themes/consultix/images/no-image-found-360x260.png' ?>
            <tr>
            <td style="text-align: center"><img src="{{ asset($img)}}" style="width: 200px;height: 200px"></td>
            <td style="text-align: center">{{ $item->link}}</td>
            <td style="text-align: center">
              <a href="{{ route('deleteMedia',['id'=>$item->id])}}" class="">
                <button style="background: red" class="view-button">Delete</button>
              </a></td>
              </tr>
            @endforeach
            @endif
                  </tbody>
          </table>
         <div class="paging">
                 {{ $media->links()}}
            </div>
        </div>
</div>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>

        window.onload = function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        }

        function getdata(id,val)
        {

            var url = "{{ url('changeCategorystatus') }}/" + id + "/" + val;
            $.get(url, function(data, status){
                window.parent.location.reload();

            });

        }
    </script>

@endsection
