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
    <h4 class="p-2 text-uppercase">Add Galery Images</h4>
  </div>
<form action="{{ route('addImage') }}" method="POST" enctype="multipart/form-data">
  <div class="col-md-12 text-left mt-4">
    @csrf
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <input type="hidden" value="{{ $product_image->id}}" name="product_id">
      <tr>
        <td>Product Gallery</td>
        <td><input type="file" name="prouct_images[]" id="file"  multiple></td>
      </tr>
    </table>
    <div class="col-md-12 text-center mt-5">
      <button class="view-button" type="submit">Add</button>
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
<script>
    $(document).ready(function(){
        $('form').ajaxForm({
            beforeSend:function(){
                $('#success').empty();
                $('.progress-bar').text('0%');
                $('.progress-bar').css('width', '0%');
            },
            uploadProgress:function(event, position, total, percentComplete){
                $('.progress-bar').text(percentComplete + '0%');
                $('.progress-bar').css('width', percentComplete + '0%');
            },
            success:function(data)
            {
                if(data.success)
                {
                    $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
                    $('#success').append(data.image);
                    $('.progress-bar').text('Uploaded');
                    $('.progress-bar').css('width', '100%');
                }
            }
        });
    });
    </script>
</html>