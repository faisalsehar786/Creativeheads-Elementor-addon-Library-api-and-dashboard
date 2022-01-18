<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates') }}
        </h2>
    </x-slot>
 <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

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

            <button type="button" class="btn btn-primary float-right my-2 mx-2" data-toggle="modal" data-target="#addPost">
            Add
            </button>
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Button trigger modal -->
                
                <!-- Modal insert -->
                <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('tempinsert') }}" enctype="multipart/form-data">
                                    @csrf
                                      <input type="hidden" name="slug" id="post_slug" value="{{ old('slug') }}">
                                      @php
                                      $cats=App\Models\Category::all();
                                      @endphp
                                     <div class="form-group">
                                        <label for="exampleFormControlInput1">Category </label>
                                       <select class="form-control" name="category">
                                        @foreach($cats as $cat)
                                           <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1"> Title</label>
                                         <input class="form-control" type="text" placeholder="abc...." name="title" id="title" value="{{ old('title') }}">
                                    </div>

                              <div class="form-group">
                                        <label for="exampleFormControlInput1">Template File(.json)</label>
                                        <input type="file" name="tempfile" class="form-control" id="exampleFormControlInput1" accept="application/JSON">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Screen Shot of Template</label>
                                        <input type="file" name="tempimage" class="form-control" id="exampleFormControlInput1" accept="image/*" >
                                    </div>

                                     <div class="form-group">
                                        <label for="exampleFormControlInput1">Is Elementor Pro </label>
                                       <select class="form-control" name="ispro">
                                       
                                           <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                     
                                       </select>
                                    </div>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ////////////////////// Edit sta ///////////////////////////////////// --}}


                 <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">view</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               
                                  <img src="" class="img-thumbnail img-fluid viewtemp">
                              
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 
                               
                            </div>
                        </div>
                    </div>
                </div>
               
             
         <table class="table table-bordered data-table">

                                     <div class="form-group">
                                        <label for="exampleFormControlInput1">Category </label>
                                       <select class="form-control" name="category" id="filcat">

                                        <option value="all" selected="">All</option>
                                        @foreach($cats as $cat)
                                           <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                       </select>
                                    </div>

                                      <div class="form-group">
                                        <label for="exampleFormControlInput1">Is Elementor Pro </label>
                                       <select class="form-control" name="ispro" id="filispro">
                                            <option value="all" selected="">All</option>
                                           <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                     
                                       </select>
                                    </div>
   <button class="btn btn-info filter mb-2">Filter</button>
   <button class="btn btn-danger reset mx-2 mb-2">Reset</button>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>image</th>
                <th>category</th>
                <th>is Pro</th>
                <th width="190px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
</div>  
</div>
<script type="text/javascript">

    $(document).ready(function(){
  function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'_')
        ;
}
  $("#title").change(function(){
    var slug=convertToSlug($(this).val());

    $('#post_slug').val(slug);

  });


  function load_data(cat,ispro){


var table = $('.data-table').DataTable({
processing: true,
serverSide: true,
ajax:{
url: "{{ route('temp') }}",
 data:{cat:cat,ispro:ispro},
},
columns: [
             {data: 'id', name: 'id',searchable: false},
            {data: 'name', name: 'name'},
            {data: 'image', name: 'image',searchable: false},
            {data: 'category', name: 'category',searchable: false},
             {data: 'is_pro', name: 'is_pro', searchable: false},
            {data: 'action', name: 'action' ,searchable: false},
        ]
    });
}
load_data();


$(document).on('click', '.delete', function(){

if (confirm('Are you sure you want to delete this  ?')) {
let op_id = $(this).attr('data_id');

  
$.ajax({
url:"{{ route('tempdel') }}", 
type:"POST",
dataType:"json",
data:{op_id:op_id,_token:"{{ csrf_token() }}"},
success:function(res)
{
if (res.status=='ok'){
$('.data-table').DataTable().destroy();
load_data();

}}
})



}
});
 
$(document).on('click', '.view', function(){

let imagelink=$(this).closest('tr').find('img').attr('src');

$('.viewtemp').attr("src",imagelink);
//console.log(imagelink);
$('#editPost').modal('show');
});

$(document).on('click', '.reset', function(){

    $('.data-table').DataTable().destroy();
load_data();
});

$(document).on('click', '.filter', function(){


 $('.data-table').DataTable().destroy();

 let filcat=$('#filcat').val();

 letfilispro=$('#filispro').val();
 load_data(filcat,letfilispro)


});
});
  
</script>
</x-app-layout>