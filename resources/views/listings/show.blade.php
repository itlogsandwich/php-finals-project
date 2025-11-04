<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class = "container" >
   <div class = "container mt-5">

    <h1> Your Listings</h1>
    <!-- NEEDS FIXING-->
    <!-- ALERTS BASED ON WHETHER LISTING WAS A SUCCESS OR NOT -->

    @if (session()->has('success'))
        <x-forms.alert type = 'success' :message = "session('success')" />
    @endif

    @if (session()->has('error'))
        <x-forms.alert type = 'danger' :message = "session('error')" />
    @endif
        <div class = "justify-content">
            @foreach ($listings as $listing)
            <div class = "card m-2" style = "background-color: rgba(255,255,255, 0.4); width: 50rem;">
                <div class = "row g-0">
                    <div class = "col-md-4">
                        <img src = "{{$listing->product->image_url}}" class = "card-img-left" alt = "product image">
                    </div>
                    <div class = "col-md-4">
                        <div class = "card-body">
                            <h3 class ="card-title"> {{$listing->product->name}} </h3>
                            <p class = "card-text fs-5"> {{$listing->product->description}} </p>
                            <p class = "card-text fs-5"> {{$listing->product->category}} </p>
                            <p class = "card-text fs-5"> {{$listing->product->price}} </p>
                        </div>
                    </div>
                    <div class =  "col-md-4">

                        <a href = {{route('listing.update.form', ['product_id' => $listing->product_id])}}" class = "btn btn-primary mt-2"> Edit </a>

                        <form method = "post" action = "{{route('listing.remove', ['product_id' => $listing->product_id])}}" onsubmit = "return confirm('Are you sure you want to remove this listing?')" class = "mt-2">
                            @csrf
                            <button type ="submit" class = "btn btn-danger"> Remove </button>
                        </form>
                    </div>
                 </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
