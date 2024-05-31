<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h1 class="text-white text-center">Laravel CRUD</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-1g my-5">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">Create Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('products.store')}}" method="post">
                      @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label h4">Name</label>
                            <input value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror
                             form-control-1g" placeholder="Name" name="name">
                            @error('name')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sku" class="form-label h4">Sku</label>
                            <input value="{{old('sku')}}" type="text" class="form-control @error('sku') is-invalid @enderror 
                            form-control-1g" placeholder="Sku" name="sku">
                            @error('sku')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label h4">Price</label>
                            <input value="{{old('price')}}" type="text" class="form-control @error('price') is-invalid @enderror
                             form-control-1g" placeholder="Price" name="price">
                            @error('price')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label h4">Description</label>
                            <textarea  class="form-control
                             form-control-1g" cols="30" rows="5" placeholder="Description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label h4">Image</label>
                            <input type="file" class="form-control 
                             form-control-1g" placeholder="Image" name="image">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg bg-primary text-white text-center">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
