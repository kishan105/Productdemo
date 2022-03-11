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
                  <h1 class="m-0">Shop</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item active">Edit Shop</li>
                  </ol>
                </div>
              </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        @if (session('message'))
                            <div class="alert alert-success d-flex align-items-center">
                                    Shop Added Successfully.
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Shop</h4>
                            </div>
                            <div class="card-body">

                                <form action="{{route('shopStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="shop_name">Shop Name </label>
                                                <input type="text"  class="form-control" name="shop_name" placeholder="Shop Name.">
                                                @error('shop_name')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="image">Image </label>
                                                <input type="file"  class="form-control" name="image" placeholder="Image.">
                                                @error('image')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address </label>
                                                <input type="text"  class="form-control" name="address" placeholder="Address.">
                                                @error('address')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input type="email"  class="form-control" name="email" placeholder="Email.">
                                            @error('email')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="block-options">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                            <a href="{{route('shop')}}" class="btn btn-danger">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
