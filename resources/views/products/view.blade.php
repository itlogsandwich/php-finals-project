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

            <div class = "container">
                <img src = "{{asset('storage/' . $product->image_path)}}" class = "m-2" alt = "product image">
                <h1> {{$product->name}}</h1>
                <p class = "card-text fs-5"> {{$product->description}} </p>
                <p class = "card-text fs-5"> {{ucfirst($product->category)}} </p>
                <p class = "card-text fs-5">₱{{$product->price}} </p>
            </div>

        </div>
    </body>
</html>
