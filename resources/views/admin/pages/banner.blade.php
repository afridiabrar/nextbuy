@extends('admin.layout.app')
@section('content')
<div class="content-div">
<div class="col-md-12 head-input"> <a data-fancybox="" data-type="iframe" data-src="" href="{{ route('AddBanner')}}" class="add-user-btn mt-2">Add</a> </div>
        <div class="head col-md-12 d-inline-block">
          <p class="table-heading mt-4">Banner</p>
        </div>
        <div class="col-md-12">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th width="30%">Banner Image</th>
              <th width="30%">Banner Title</th> 
              <th width="20%">Status</th>            
              <th width="20%">Action</th>            
            </tr>
            @if(count($banner) > 0)
            @foreach ($banner as $item)
            <?php $img = ($item->banner_image) ? $item->banner_image : 'assets/images/other/01.jpg'; ?>
            <tr>
                <td class="plantmore-product-thumbnail"><a href="#"><img style="height: 100px;width:100px" src="{{asset($img)}}" alt=""></a></td>
                <td>{{ $item->title}}</td>
                <td>{{ $item->status}}</td>
                <td>
                  <select name="status" onchange="getdata('{{$item->id}}',this.value)" class="black-select">
                    <option value="Featured" {{ $item->status == 'Featured' ? "selected" : "" }}>Featured</option>
                    <option value="UnFeatured" {{ $item->status == 'UnFeatured' ? "selected" : "" }}>UnFeatured</option>
                </select>
                </td>

              </tr>    
            @endforeach
            @endif
          </table>
          <div class="paging">
                  {{ $banner->links()}}
            </div>
        </div>
</div>
<script>
    function getdata(id,val)
    {
      
        var url = "{{ url('changeBannerImage') }}/" + id + "/" + val;
        $.get(url, function(data, status){
          window.parent.location.reload();
    
        });
  
    }
  </script>
@endsection
