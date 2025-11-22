<x-layouts.main> 
    <div class = "container mt-5 border rounded-2">
        <h1> Product Listing </h1>
        <form method = "post" action = "{{route('listing.update', ['product_id' => $product->id])}}" enctype = "multipart/form-data" class = "mt-4">
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
                    <option value = "food"> Food </option>
                    <option value = "medication"> Medication </option>
                    <option value = "tools"> Tools </option>
                    <option value = "miscellaneous"> Miscellaneous</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label"> Price </label>
                <input type="number" class="form-control" id="price" name = "price">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile" name = "image_path", accept ="image/*">
            </div>
            <button type="submit" class="mt-3 mb-2 btn btn-primary"> Edit </button>
        </form>
    </div>

    <a href = "/listing/show" class = "mb-2 btn btn-primary"> Back </a>
</x-layouts.main>
