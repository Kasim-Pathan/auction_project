
@extends('adminLTE.layouts.master')
   @section('title',"dashboard")

    @section('main')
      <!--begin::App Main-->
     
    <div class="container mt-5">
            
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        

        <h1 class="mb-4">Product Categories</h1>
        <a href="{{route('admin.category.create')}}">

         <button class="btn btn-primary mb-3">Add New</button>
            </a>
        <table id="categoriesTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows -->
                 @foreach($mydata as $data)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$data->category_name}}</td>
                    <td>{{$data->category_description}}</td>
                    <td><img class="img-fluid w-25 " src="{{asset($data->category_image)}}" alt=""></td>
                    <td class="text-center">
                    <a href="{{ route('admin.category.edit', $data->id) }}">                        
                    <button class="btn btn-success btn-sm">Edit</button>
                    </a>
                    <form action="{{route('admin.category.destroy',$data->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete this category.')">Delete</button>
                    </form>
                    </td>
                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#categoriesTable').DataTable({
                responsive: true,
                lengthChange: false,
                searching: true,
                paging: true,
                ordering: true,
                info: true,
            });
        });
    </script>

      </main>
      <!--end::App Main-->
     @endsection