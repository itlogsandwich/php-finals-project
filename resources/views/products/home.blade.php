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

    <!-- Navbar Component -->
    <x-header.nav/>

    <div class = "d-flex flex-row">

        <div class = "d-flex flex-column ">
            <div class = "card shadow-sm">
                <div class = "card-header fw-bold">
                    Shop by Category
                </div>
                <ul class = "list-group list-group-flush">
                    @foreach ($categories as $category)
                    <li class = "d-flex flex-row list-group-item justify-content-between">
                        <div>
                            <a href = "{{route('viewCategory' , ['category' => $category])}}">{{ucfirst($category)}}</a>
                        </div>

                        <div>
                            <span class = "badge bg-secondary rounded-pill "> {{$counts[$category] ?? 0}}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>


        </div>

        <div class = "d-flex flex-grow-1 container-fluid">
            <div class = "row justify-content">
                @foreach ($products as $product)
                <div class = "card border-success mb-2 me-2" style = "background-color: rgba(255,255,255, 0.4); max-width: 50rem;">
                        <div class = "row g-0">
                            <div class = "col-md-4">
                                <img src = "{{asset('storage/' . $product->image_path)}}" class = "img-fluid rounded" alt = "product image">
                            </div>
                            <div class = "col-md-4">
                                <div class = "card-body">
                                    <a href = "{{route('productView', ['product_id' => $product->id])}}" class ="card-title d-inline-block p-2 text-decoration-none border border-0 rounded-3 hover-border-primary fs-1" style = "transition: border-color 0.2s;"> {{$product->name}} </a>
                                    <a href = "{{route('productView', ['product_id' => $product->id])}}" class = "stretched-link"> </a>
                                    <p class = "card-text fs-5"> {{$product->description}} </p>
                                    <p class = "card-text fs-5"> {{ucfirst($product->category)}} </p>
                                    <p class = "card-text fs-5">₱{{$product->price}} </p>
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
