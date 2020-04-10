@extends('admin.layout.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<div class="content-div">
    @include('admin.layout.error')

    <div class="col-md-12 head-input">
    <a href="{{ route('csv')}}" data-fancybox="" data-type="iframe" data-src=""  style='background:green;position: relative;top: 22px;color: white' class='view-button'>Add Csv</a>
    <a href="{{ route('export')}}" style='background:red;position: relative;top: 22px;color: white' class='view-button'>Download Csv</a>

        <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('addPopupProduct')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">products</p>
        </div>
        <div class="col-md-12">
          <table width="100%" border="0" id="productsDt" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
              <th>Id</th>
              <th>Category Name</th>
              <th>SubCategory Name</th>
              <th>Name</th>
              <th>Price</th>
              <th>Featured Product</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody></tbody>
          </table>
          {{-- <div class="paging">
                    {{ $product->links() }}
          </div> --}}
        </div>
</div>
<script type="text/javascript">
  $(function () {
    
    var url = 'http://admin.nextbuy.ae/admin/edit_product/';
    var urllls = 'http://admin.nextbuy.ae/admin/view_product/';
    var delete_url = 'http://admin.nextbuy.ae/admin/delete_product/';
    var table = $('#productsDt').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('show_serverside') }}",
        columns: [
          // {
          //     data: 'is_featured',
          //     name: 'is_featured',
          //     render: function(data,type,row){
          //       console.log(data);
          //       return "<input type='checkbox' name='id["+row['id']+"]'/>";
          //     }
          //   },
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
            {data: 'sub_category_name', name: 'sub_category_name'},
            {data: 'name', name: 'name'},
            {data: 'price',name:'price'},
            {
              data: 'is_featured',
              name: 'is_featured',
              render: function(data,type,row){
                console.log(data);
                return "<select onchange='getdata("+row['id']+",this.value)' >"+
                "<option value='1'"+ ((data == 1) ? "selected" : "") +" >Featured</option>" +
                "<option value='0'"+ ((data == 0) ? "selected" : "") +" >UnFeatured</option>" +
                "</select>";
              }
            },
            {
              data: 'id', name: 'id',
            render:function(data,type,row)
            {
                return "<a href='"+ urllls+""+row['id'] +"'>"+
                "<button class='view-button'>View</button>"+
              "</a>"+
              "<a  href='"+ url+""+row['id'] +"' >"+
                "<button class='view-button'>Edit</button>"+
             "</a>"+
             "<a  href='"+ delete_url+""+row['id'] +"' >"+
                "<button style='background:red' class='view-button'>Delete</button>"+
             "</a>"
             ;
            }
            },
        ]
    });
    
  });
</script>
<script>
    function getdata(id,val)
    {
     
        var url = "{{ url('changeproductStatus') }}/" + id + "/" + val;
        $.get(url, function(data, status){
          window.parent.location.reload();
        });
    }

    

  </script>
@endsection
