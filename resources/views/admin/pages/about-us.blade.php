@extends('admin.layout.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<style>
 .note-style, .note-fontname, .note-color, .note-para, .note-table, .note-insert, .note-view { display:none !important;}
</style>
    
   
<div class="content-div">
      @include('admin.layout.error')  
      <form method="post" action="{{ route('edit_pages') }}" enctype="multipart/form-data">

		<div class="head col-md-12 d-inline-block">            
            <p class="table-heading mt-4">About Us</p>
        </div>
        @csrf
        <div class="col-md-12">
        <textarea id="summernote" name="about_us">{{ $data->about}}</textarea>
        </div>
        
        <div class="col-12 mt-4 text-right">
        	{{-- <a data-fancybox data-type="iframe" data-src="" href="{{ route('view_about_us') }}" class=""><button class="black-button">View Post</button></a> --}}
            <button type="submit" class="view-button">Update</button>
        </div>
      </form>
	</div>
   
   <script>
      $('#summernote').summernote({
        placeholder: 'About Us',
        tabsize: 2,
        height: 350
      });
      
      
   </script>

@endsection