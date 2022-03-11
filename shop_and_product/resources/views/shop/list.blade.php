<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop And Produst</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-4">
                <div class="col-sm-6">
                  <h1 class="m-20">Shop List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop</a></li>
                      <li class="breadcrumb-item active">Shop List</li>
                    </ol>
                </div>
              </div>
            </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('shopAdd')}}" class="btn btn-secondary"><i class="fa fa-fw fa-plus mr-1"></i> Add shop</a>
                        <a href="{{route('export')}}" class="btn btn-primary me-1">Export Data</a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Import Data
                        </button>

                    </div>

                    <div class="card-body">

                    @if(Session::has('message'))
                        <div class="alert alert-danger d-flex align-items-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Shop Deleted successfully.
                        </div>
                    @endif
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Shop Name</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop as $shopData)
                            <tr>
                                <td>{{ $shopData['id'] }}</td>
                                <td>{{ $shopData['shop_name'] }}</td>
                                <td>
                                    <img src="{{url('uploads/shop/'.$shopData['image'])}}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>{{ $shopData['address'] }}</td>
                                <td>{{ $shopData['email'] }}</td>
                                <td>{{$shopData['created_at'] }}</td>
                                <td>{{$shopData['updated_at'] }}</td>
                                <td>
                                    <a href="{{ route('shopEdit', $shopData['id']) }}" class="btn btn-info"> EDIT </a>
                                     |
                                    <a href="{{ route('shopDelete', $shopData['id']) }}" class="btn btn-danger"> DELETE </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>


</html>

