@extends('admin.layout.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

    <div class="content-div">
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('addPopup')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">categories</p>
        </div>
        <div class="col-md-12">
          <table id="dtBasicExample" width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
              <th width="25%" style="text-align: center">Category Id</th>
              <th width="25%" style="text-align: center">Categories</th>
              <th width="25%" style="text-align: center">Featured/UnFeatured</th>
              <th width="25%" style="text-align: center">Action</th>

            </tr>
            </thead>
              <tbody>
            @if(count($category) > 0)
            @foreach ($category as $item)
            <tr>
              <td style="text-align: center">{{ $item->id }}</td>
            <td style="text-align: center">{{ $item->name}}</td>
            <td style="text-align: center">
                <select name="status" onchange="getdata('{{$item->id}}',this.value)" class="black-select">
                  <option value="Featured" {{ $item->status == 'Featured' ? "selected" : "" }}>Featured</option>
                  <option value="UnFeatured" {{ $item->status == 'UnFeatured' ? "selected" : "" }}>UnFeatured</option>
              </select>

              </td>
                <td style="text-align: center">
                    <a data-fancybox data-type="iframe" data-src="" href="{{ route('edit_category',['id'=>$item->id])}}" class="">
                        <button class="view-button">Edit</button>
                    </a>
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


