@extends('admin.layout.app')
@section('content')    
<div class="content-div">
  
    <div class="head col-md-12 d-inline-block">
      <p class="table-heading mt-4">View products</p>
    </div>
    <div class="col-md-12 text-left">
      <?php $img = ($product->featured_image) ? $product->featured_image : 'public/images/product1.jpg' ?>
    <div class="col-md-12 text-center store-img" style="padding: 15px; background: #e1e1e1;"><a href="#"><img style="height: 100px;width;100px" class="" src="{{ asset($img)}}"></a></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Product Id</td>
          <td>{{ $product->id }}</td>
        </tr>
        <tr>
          <td>Name</td>
          <td>{{ $product->name }}</td>
        </tr>
          <td>Selling Price</td>
          <td>${{ number_format($product->price,2) }}</td>
            </tr>
        <tr>
          <td>Category</td>
          <td>{{ $product->categories->name}}</td>
        </tr>
        <tr>
          <td>Short Description</td>
          <td>{{ $product->short_description}}.</td>
        </tr>
        <tr>
          <td>Description</td>
          <td>{{ $product->description}}.</td>
        </tr>
        <tr>
          <td>Product&nbsp;Gallery</td>
          <td></td>
        </tr>
      </table>
      <div class="col-md-12 text-center store-img" style="padding: 15px; background: #e1e1e1;">
        <ul>
          @foreach ($product->productImages as $vv)
          <?php $img = ($vv->prouct_images) ? $vv->prouct_images : 'public/images/product1.jpg' ?>
          @if($vv->type == 'image')
            <li><a href="#"><img class="" style="height: 150px;width:150px" src="{{ asset($img) }}"></a></li>              
          @else
            <li><video class="" style="height: 150px;width:150px" controls src="{{ asset($img) }}"></video></li>              
          @endif          
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
