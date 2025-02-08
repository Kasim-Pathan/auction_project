    @extends('adminLTE.layouts.master')
@section('title',"dashboard")

@section('main')

<!--begin::App Main-->
<main class="app-main">
<div class="container mt-5">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product Management</h1>
        <a href="{{route('admin.product.create')}}">
        <button id="addNewProductBtn" class="btn btn-primary mb-3">Add New Product</button>
        </a>
        <table id="productTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mydata as $data)
                <tr class="align-middle">
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->category_name}}</td>
                    <td><img class="img-fluid w-25 " src="{{asset($data->image)}}" alt=""></td>
                    <td>{{$data->price}}</td>
                    <td class="text-center">
                        
                    <a href="{{ route('admin.product.edit', $data->id) }}"><button  class="btn btn-success btn-sm"> Edit </button> </a>
                        <form action="{{route('admin.product.destroy',$data->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm delete-product" onClick="return confirm('Are you sure you want to delete this product?')">Delete</button>
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
            const table = $('#productTable').DataTable({
                responsive: true,
                lengthChange: false,
                searching: true,
                paging: true,
                ordering: true,
                info: true,
            });

        });
    </script>
</body>
</html>

</div>
<!-- Bootstrap JS -->
</main>
<!--end::App Main-->
@endsection