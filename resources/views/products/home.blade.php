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
    <div>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">Silkiest Road - Anonymous Store</a>
                <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
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
                            <a href = "#">{{ucfirst($category)}}</a>
                        </div>

                        <div>
                            <span class = "badge bg-secondary rounded-pill "> 10 </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>


        </div>

        <div class = "flex-grow-1 container-fluid">
            <div class = "justify-content">
                @foreach ($products as $product)
                <div class = "card" style = "background-color: rgba(255,255,255, 0.4); width: 50rem;">
                    <div class = "row g-0">
                        <div class = "col-md-4">
                            <img src = "{{asset('storage/' . $product->image_path)}}" class = "card-img m-2" alt = "product image">
                        </div>
                        <div class = col-md-4>
                            <div class = "card-body">
                                <h3 class ="card-title"> {{$product->name}} </h3>
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
