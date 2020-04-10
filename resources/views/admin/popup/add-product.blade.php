<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Wish On | Admin Panel</title>

<!--Css Start-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-grid.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-reboot.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/style.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/jquery.fancybox.min.css')}}" />

<!--Css End-->

</head>

<body class="bg-white">
    @include('web.layout.error')
<section class="popup view-popup">
  <div class="red-heading">
    <h4 class="p-2 text-uppercase">Add Products</h4>
  </div>
<form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
  <div class="col-md-12 text-left mt-4">
    @csrf
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Product Type</td>
        <td><input type="text" name="type" placeholder="Product Type" /></td>
      </tr>
      <tr>
        <td>Product SKU</td>
        <td><input type="text" name="sku"  placeholder="Product SKU" /></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><input type="text" name="name" placeholder="Computer Screen" /></td>
      </tr>
      <tr>
        <td>Product Image</td>
        <td><input type="file" required name="image" accept="image/*"></td>
      </tr>
      <tr>
        <td>Product Gallery</td>
        <td><input type="file" name="prouct_images[]" id="file" multiple  accept="image/*"></td>
      </tr>
      <tr>
        <td>Discount/Organic</td>
        <td><input type="text" name="extra_discount" placeholder="24" /></td>
      </tr>
      <tr>
        <td>Price</td>
        <td><input type="number" step="0.01" name="price" placeholder="$75" /></td>
      </tr>

      <tr>
        <td>Weight</td>
        <td><input type="text" name="weight" placeholder="Weight" /></td>
      </tr>

      <tr>
        <td>Length</td>
        <td><input type="text" name="length" placeholder="Length" /></td>
      </tr>

      <tr>
        <td>Width</td>
        <td><input type="text" name="width" placeholder="Width" /></td>
      </tr>

      <tr>
        <td>height</td>
        <td><input type="text" name="height" placeholder="Height" /></td>
      </tr>
      <tr>
        <td>Color</td>
        <td><input type="text" name="color" placeholder="Color" /></td>
      </tr>

      <tr>
        <td>Other Information</td>
        <td><input type="text" name="other_information" placeholder="600g,1pack/small" /></td>
      </tr>

      <tr>
        <td>Tax Status</td>
        <td>
          <select required name="tax_status">
                <option value="taxable">Taxable</option>
                <option value="non_taxable">Non Taxable</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Category</td>
        <td>
          <select required name="category_id" onchange="abc(this.value)">
              @if(count($category) > 0)
                @foreach ($category as $item)
                <option value="{{ $item->id }}">{{ $item->name}}</option>
                @endforeach
              @endif
          </select>
        </td>
      </tr>
      <tr>
        <td>Sub Category</td>
        <td>
          <select required id="test" name="sub_category_id">

          </select>
        </td>
      </tr>
      <tr>
        <td>Short Description</td>
        <td>
          <textarea name="short_description" rows="10" cols="50"></textarea>
        </td>
      </tr>
      <tr>
        <td>Description</td>
        <td>
          <textarea name="description" rows="10" cols="50"></textarea>
        </td>
      </tr>
    </table>
    <div class="col-md-12 text-center mt-5">
      <button class="view-button" type="submit">Add Product</button>
     </div>
  </div>
</form>
<br />
<div class="progress">
    <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        0%
    </div>
</div>
<br />
<div id="success" class="row">

</div>
<br />
</section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
</html>