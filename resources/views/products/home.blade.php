<!-- TODO - Create Home Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class = "d-flex flex-row mb-2">

        <div class = "d-flex flex-column">
            <!-- TEST LOOP -->
            @for($x = 0; $x < 10; $x++)
            {
                <div>
                    <!-- EMPTY FOR NOW -->
                </div>
            }
            @endfor
        </div>

        <div class = "container mt-5">
            <h1> HOME PAGE</h1>
            <div class = "justify-content">
                @foreach ($products as $product)
                <div class = "card m-2" style = "background-color: rgba(255,255,255, 0.4); width: 50rem;">
                    <div class = "row g-0">
                        <div class = "col-md-4">
                            <img src = "{{$product->image_url}}" class = "card-img-left" alt = "product image">
                        </div>
                        <div class = col-md-4>
                            <div class = "card-body">
                                <h3 class ="card-title"> {{$product->name}} </h3>
                                <p class = "card-text fs-5"> {{$product->description}} </p>
                                <p class = "card-text fs-5"> {{$product->category}} </p>
                                <p class = "card-text fs-5"> {{$product->price}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
