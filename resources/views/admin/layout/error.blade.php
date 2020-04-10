@if(Session::has('success')) 
<div class="alert alert-success alert-dismissible" style="text-align:center;">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> {{ Session::get('success')}}
	 <script>setTimeout(function(){ if(self==top)
			   window.location.reload();
			   else if(parent==top) {
				   parent.window.location.reload();
			   }
		   }, 3000);</script>
</div>
@endif
@if(Session::has('error')) 
<div class="alert alert-danger alert-dismissible" style="text-align:center;">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Error!</strong> {{ Session::get('error')}}
</div>
@endif