@extends('admin.layout.app')
@section('content')    
<div class="content-div">
    @include('web.layout.error')
  
    <div class="head col-md-12 d-inline-block">
      <p class="table-heading mt-2">Edit products</p>
    </div>
    <form action="{{ route('UpdateProduct',['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="col-md-12">
      <div class="text-left">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>
          <td>Type</td>
          <td><input type="text" placeholder="Computer Screen" value="{{$product->type}}" name="type" /></td>
        </tr>
        <tr>
          <td>Name</td>
        <td><input type="text" placeholder="Computer Screen" value="{{$product->name}}" name="name" /></td>
        </tr>
        <tr>
          <td>Category</td>
          <td>
            <select required name="category_id" onchange="abc(this.value)">
                @if(count($category) > 0)
                  @foreach ($category as $item)
                  <option value="{{ $item->id }}" {{ ($item->id == $product->category_id) ? "selected" : ""}}>{{ $item->name}}</option>
                  @endforeach
                @endif
            </select>
          </td>
        </tr>
        <tr>
          <td>Sub Category</td>
          <td>
            <select id="test" name="sub_category_id">
  
            </select>
          </td>
        </tr>
        <tr>
          <td>Organic/Discount</td>
          <td><input type="text" placeholder="Computer Screen" value="{{$product->extra_discount}}" name="extra_discount" /></td>
        </tr>
        <tr>
          <td>Sku</td>
        <td><input type="text" placeholder="Computer Screen" value="{{$product->sku}}" name="sku" /></td>
        </tr>

        <tr>
          <td>Update Product Image</td>
          <td><input type="file" name="image" accept="image/*"></td>
        </tr>
        <tr>
          <td></td>
          <td>
          <div class="col-md-12 text-center store-img mb-3 mt-3">
              <?php $img = ($product->featured_image) ? $product->featured_image : 'public/adminassets/images/product1.jpg' ?>
        <ul>
        <li><a href="#"><img class="" style="height: 100px;width;100px" src="{{ asset($img) }}"></a></li>
        </ul>
      </div>
      </td>
        </tr>
        <tr>
          <td>Add Product Gallery</td>
          <td><a data-fancybox="" data-type="iframe" data-src="" href="{{ route('addImageGaleryPopup',['id'=>$product->id])}}" class="view-button">Add Galery Photo</a></td>
        </tr>
        <tr>
          <td></td>
          <td>
          <div class="col-md-12 text-center store-img mb-3 mt-3">
        <ul>
          @foreach ($product->productImages as $item)
          <?php $img = ($item->prouct_images) ? $item->prouct_images : 'public/adminassets/images/product1.jpg' ?>
          @if($item->type == 'image')
        <li><a href="#"><img class="" style="height: 200px;width: 200px;object-fit: contain" src="{{ asset($img) }}"><a href="{{ route('deleteImages',['id'=>$item->id])}}">X</a></li>
          @elseif($item->type == 'video')
          <li><video style="height: 200px;width: 200px;object-fit: contain" src="{{ asset($img) }}" controls>
            </video><span>X</span>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
      </td>
        </tr>
          <td>Sell Price</td>
          <td><input type="number" name="price" value="{{ number_format($product->price,2)}}" step="0.01" /></td>
        </tr>
        <tr>
          <td>Color</td>
          <td><input type="text" name="color" value="{{$product->color}}"  placeholder="Black" /></td>
        </tr>
        <tr>
          <td>Weight</td>
          <td><input type="text" name="weight" value="{{$product->weight}}"  placeholder="Weight" /></td>
        </tr>
        <tr>
          <td>Length</td>
          <td><input type="text" name="length" value="{{$product->length}}"  placeholder="Length" /></td>
        </tr>
        <tr>
          <td>Width</td>
          <td><input type="text" name="width" value="{{$product->width}}"  placeholder="Width" /></td>
        </tr>
        <tr>
          <td>Height</td>
          <td><input type="text" name="height" value="{{$product->height}}"  placeholder="Height" /></td>
        </tr>
        <tr>
          <td>Other Information</td>
          <td><input type="text" name="other_information" value="{{$product->other_information}}"  placeholder="Other Information" /></td>
        </tr>

        <tr>
          <td>Short Description</td>
          <td><textarea rows="3" cols="50" name="short_description">{{ $product->short_description}}</textarea></td>
        </tr>
        <tr>
          <td>Discription</td>
        <td><textarea rows="3" cols="50" name="description">{{ $product->description}}</textarea></td>
        </tr>
      </table>
      <div class="col-md-12 text-center mt-5"> 
        <button class="view-button" type="submit">Update Product</button>
        
      </div>
    </div>
    </div>
    </form>
  </div>
  <script>


    function abc(id)
    {
      $.post("{{ route('getCategoryAjax')}}",{id:id, _token: '{{csrf_token()}}'},function(e)
      {
   //     console.log(e);
        $("#test").html(e);
      })
    }
  
      </script>
@endsection
