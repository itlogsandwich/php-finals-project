<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class = "container bg-image ">

    <div class = "container mt-5 border rounded-2">
        <h1> Product Listing </h1>
        <form method = "post" action = "{{route('listing.create')}}" class = "mt-4">
            @csrf
            <div class ="mb-3">
                <label for = "name" class = "form-label"> Item name</label>
                <input type = "text" class = "form-control" id = "name" name = "name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"> Description </label>
                <input type="text" class="form-control" id="description" name = "description">
            </div>
            <div class="form-floating mb-3">
                <select class = "form-select" id = "category" name = "category">
                    <label for = "category"> Choose a category </label>
                    <option selected> Category </option>
                    <option value = "electronics"> Electronics </option>
                    <option value = "apparel"> Apparel </option> 
                    <option value = "food"> food </option>
                    <option value = "medication"> medication </option>
                    <option value = "tools"> tools </option>
                    <option value = "miscellaneous"> miscellaneous</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label"> Price </label>
                <input type="number" class="form-control" id="price" name = "price">
            </div>
            <div class = "mb-3">
                <label for = "image_url"> Image Url </label>
                <input type = "text" class = "form-control" id = "image_url" name ="image_url">
            <button type="submit" class="mb-3 btn btn-primary"> Add </button>
        </form>
    </div>
    
    <a href = "/home" class = "mt-2 btn btn-primary"> Back </a>
</html>