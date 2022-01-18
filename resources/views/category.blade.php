<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Categories') }}
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
                                <form method="POST" action="{{ route('categoryinsert') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Category Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Category" value="{{ old('name') }}">
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
                <!-- Modal insert -->
                <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('categoryupdate') }}"> 
                                    @csrf
                                    <input type="hidden" name="post_id" id="post_id">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Category Name</label>
                                        <input type="text" name="name" class="form-control " id="category" placeholder="Category" >
                                    </div>  
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ////////////////////// Edit end ///////////////////////////////////// --}}
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th width="100px">Action</th>
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

$(document).ready(function() {
function load_data(from_date = '', to_date = '',status='', typep=''){
var table = $('.data-table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('category') }}",
columns: [
{data: 'id', name: 'id'},
{data: 'name', name: 'name'},
{data: 'action', name: 'action', orderable: false, searchable: false},
]
});
}
load_data();
$(document).on('click', '.edit', function(){
let op_id = $(this).attr('data_id');
let cateName=$(this).closest('tr').find('td').eq(1).text();
$('#post_id').val(op_id);
$('#category').val(cateName);
$('#editPost').modal('show');
});
$(document).on('click', '.delete', function(){

if (confirm('Are you sure you want to delete this category Id is Use in Templates ?')) {
let op_id = $(this).attr('data_id');


$.ajax({
url:"{{ route('categorydel') }}", 
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





});   


</script>
</x-app-layout>