<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Wish On | Admin Panel</title>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-grid.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/bootstrap-reboot.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/style.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/adminasset/css/jquery.fancybox.min.css')}}" />
</head>

<body class="bg-white">
    <section class="popup view-popup">
    	
		<div class="red-heading">
			<h4 class="p-2 text-uppercase">View Users</h4>
		</div>
        
        <!--<div class="col-md-12 text-center profile-pic mb-3">
			<img class="" src="images/user-img-1.png" />
        </div>-->
        @php
                  
        $img = ($user->profile_pic) ? $user->profile_pic : 'public/images/images.png';
    
  @endphp

        <div class="col-md-12 text-center profile-pic mb-3">
                <img class="img-thumbnail" width="120px" height="100px" src="{{ asset($img) }}" />
        </div>

        <div class="col-md-12 text-left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>UserName</td>
                    <td><strong>{{ $user->f_name }} {{ $user->l_name }}</strong> </td>
                </tr>             
                <tr>
                    <td>Contact No.</td>
                    <td><strong>{{ $user->phone_no }}</strong> 	</td>
                </tr>
                
                <tr>
                    <td>Email Address</td>
                    <td><strong>{{ $user->email}}</strong> </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><strong>{{($user->Gender) ? $user->Gender : 'Not Defined'}}</strong> </td>
                </tr>
            
                
            </table>
		</div>
       
	</section>

</body>
</html>