@extends('admin.layout.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

    <div class="content-div">
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('addSubCat')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">Sub categories</p>
        </div>
        <div class="col-md-12">
          <table id="dtBasicExample" width="100%" border="0" cellspacing="0" cellpadding="0">
              <thead>
            <tr>
              <th width="20%">Sub Category Id</th>
              <th width="20%">Category Name</th>
              <th width="20%">Sub Categories Name</th>
              <th width="20%">Banner Link</th>
              <th width="20%">Banner Image</th>
              <th width="20%">Action</th>
            </tr>
              </thead>
              <tbody>

              @if(count($category) > 0)
            @foreach ($category as $item)
            <?php $img = ($item ->banner_image) ? $item->banner_image : 'https://seeba.se/wp-content/themes/consultix/images/no-image-found-360x260.png' ?>
            <tr>
              <td style="text-align: center">{{ $item->id}}</td>
            <td style="text-align: center">{{ $item->categories->name}}</td>
            <td style="text-align: center">{{ $item->name}}</td>
            <td style="text-align: center">{{ (!empty($item->link)) ? $item->link : 'Empty' }}</td>
            <td style="text-align: center"><img src="{{ asset($img)}}" style="width: 100px;height: 100px"></td>
                <td>
                    <a data-fancybox data-type="iframe" data-src="" href="{{ route('editSubCat',['id'=>$item->id])}}" class="">
                        <button class="view-button">Edit</button>
                    </a>
                    {{-- <a href="#" >
                      <button class="delete-button">Delete</button>
                    </a>                 --}}
                </td>
              </tr>
            @endforeach
            @endif
                  </tbody>
          </table>
{{--          <div class="paging">--}}
{{--                  {{ $category->links()}}--}}
{{--            </div>--}}
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
