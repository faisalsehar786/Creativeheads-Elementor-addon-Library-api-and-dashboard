<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Edit Template') }}
</h2>
</x-slot>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="py-12">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

         @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- success message display --}}
@if(session('message'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> {{ session('message') }}
</div>
@endif

{{-- error message display if company added --}}
@if(session('error'))
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Alert!</strong> {{ session('error') }}
</div>
@endif


<a href="{{ route('temp') }}"class="btn btn-success  my-2 mx-2" > Back</a>
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Button trigger modal -->
                
                               <form method="POST" action="{{ route('tempupdate') }}" enctype="multipart/form-data">
                                    @csrf
                                      <input type="hidden" name="post_id" id="post_slug" value="{{$temp->id }}">
                                      @php
                                      $cats=App\Models\Category::all();
                                      @endphp
                                     <div class="form-group">
                                        <label for="exampleFormControlInput1">Category </label>
                                       <select class="form-control" name="category">
                                        @foreach($cats as $cat)
                                           <option value="{{ $cat->id }}"@if($cat->id==$temp->cat_id) selected="" @endif>{{ $cat->name }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1"> Title</label>
                                         <input class="form-control" type="text" placeholder="abc...." name="title" id="title" value="{{ $temp->name }}">
                                    </div>

                                       <div class="form-group">
                                        <label for="exampleFormControlInput1">Template File(.json)</label>
                                        <input type="file" name="tempfile" class="form-control" id="exampleFormControlInput1" accept="application/JSON">

                                        <input type="hidden" name="hiddenjson" value="{{ $temp->file }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Screen Shot of Template</label>
                                        <input type="file" name="tempimage" class="form-control" id="exampleFormControlInput1" accept="image/*" >
                                         <input type="hidden" name="hiddentemp" value="{{ $temp->img }} ">

                                         <img src="{{ asset('tempimages/') }}/{{ $temp->img }}" class="img-thumbnail img-fluid" width="300" height="300">
                                    </div>

                                     <div class="form-group">
                                        <label for="exampleFormControlInput1">Is Elementor Pro </label>
                                       <select class="form-control" name="ispro">
                                       
                                           <option value="no" @if($temp->is_pro=='no') selected="" @endif>No</option>
                                            <option value="yes"@if($temp->is_pro=='yes') selected="" @endif>Yes</option>
                                     
                                       </select>
                                    </div>  
 <button type="submit" class="btn btn-primary">Update</button>
                                </form>

                
            </div>
        </div>
    </div>
</div>

</x-app-layout>