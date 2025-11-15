<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body>
        <div>

            <x-header.nav/>

            <div class = "d-flex">
                <div class = "container text-center border rounded-2">
                    <img src = "{{asset('storage/' . $product->image_path)}}" class = "m-2 w-50" alt = "product image">
                </div>

                <div class = "container border-top row align-items-center text-center">

                    <h1 class = "border-bottom"> {{$product->name}}</h1>
                    <h1 class = "border-bottom"> {{$user->name}}</h1>
                    <p class = "fs-3"> {{$product->description}} </p>
                    <p class = "fs-3"> {{ucfirst($product->category)}} </p>
                    <p class = "fs-3">₱{{$product->price}} </p>

                    <div class = "d-flex flex-column text-center">
                        <a href = "#" class = "mt-2 btn btn-primary rounded-4"> Contact Seller </a>
                        <a href = "#" class = "mt-2 btn btn-outline-primary rounded-4"> Favorites </a>
                    </div>

                </div>
            </div>


            <!-- TEMPORARY FOOTER -->
            <footer>

                <div>
                    <h1> Similar Items </h1>
                </div>

                <div  class = "d-flex flex-row">
                    @for ($i = 1;  $i <=5; $i++)
                    <div class = "container text-center border rounded-2" style = "max-width: 25rem;">
                        <img src = "{{asset('storage/' . $product->image_path)}}" class = "img-fluid" alt = "product image">
                    </div>
                    @endfor
                </div>

            </footer>
        </div>
    </body>
</html>
