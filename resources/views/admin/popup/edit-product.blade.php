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
<section class="popup view-popup">
  <div class="red-heading">
    <h4 class="p-2 text-uppercase">Edit Products</h4>
  </div>
  <div class="col-md-12 text-left mt-4">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Product Id</td>
        <td><input type="text" placeholder="01" /></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><input type="text" placeholder="Computer Screen" /></td>
      </tr>
      <tr>
        <td>Product Image</td>
        <td><input type="file" name="pic" accept="image/*"></td>
      </tr>
      <tr>
        <td>Product Gallery</td>
        <td><input type="file" name="pic" accept="image/*"></td>
      </tr>
      <tr>
        <td>Stock</td>
        <td><input type="number" placeholder="24" /></td>
      </tr>
      <tr>
        <td>Stock</td>
        <td><input type="number" placeholder="$75" /></td>
      </tr>
      <tr>
        <td>Color</td>
        <td><input type="text" placeholder="Black" /></td>
      </tr>
       <tr>
        <td>Size</td>
        <td><select>
  <option value="small">Small</option>
  <option value="medium">Medium</option>
  <option value="large">Large</option>
  <option value="xl">XL</option>
</select></td>
      </tr>
      <tr>
        <td>Category</td>
        <td><select>
  <option value="computers">Computers</option>
  <option value="jewelry">Jewelry</option>
  <option value="kids">kids </option>

</select></td>
      </tr>
      <tr>
        <td>Discription</td>
        <td><textarea rows="3" cols="50">Lorem ipsum dummy text Lorem ipsum dummy text Lorem ipsum dummy text
</textarea></td>
      </tr>
    </table>
    <div class="col-md-12 text-center mt-5"> <a href="" class="">
      <button class="view-button">Save</button>
      </a> <a href="" class="">
      <button class="cancel-button">Cancel</button>
      </a> </div>
  </div>
</section>
</body>
</html>