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
                  <h1 class="m-0">Product</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product')}}">Product</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
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
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    Product Added Successfully.
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Product</h4>
                            </div>
                            <div class="card-body">

                                <form action="{{route('productStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="product_name">Product Name </label>
                                                <input type="text"  class="form-control" name="product_name" placeholder="Product Name.">
                                                @error('product_name')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price </label>
                                                <input type="text"  class="form-control" name="price" placeholder="Price.">
                                                @error('price')
                                                <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="stock">Stock </label>
                                                <input type="text"  class="form-control" name="stock" placeholder="Stock.">
                                                @error('stock')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="shop_id">Shop Id </label>
                                                <select  class="form-control" name="shop_id">
                                                    <option value="">Shop Name</option>
                                                    @foreach ($product as $item)
                                                        <option value="{{ $item->id }}" > {{ $item->shop_name }} </option>
                                                    @endforeach
                                                </select>
                                                @error('shop_id')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="video">Video </label>
                                                <input type="file"  class="form-control" name="video" placeholder="Video.">
                                                @error('video')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="block-options">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                            <a href="{{route('product')}}" class="btn btn-danger">
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
