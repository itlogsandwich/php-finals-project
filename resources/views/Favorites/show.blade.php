<x-layouts.main>
    <div class = "container mt-5">

    <h1> Favorites </h1>
    <!-- NEEDS FIXING-->
    <!-- ALERTS BASED ON WHETHER LISTING WAS A SUCCESS OR NOT -->

    @if (session()->has('success'))
        <x-forms.alert type = 'success' :message = "session('success')" />
    @endif

    @if (session()->has('error'))
        <x-forms.alert type = 'danger' :message = "session('error')" />
    @endif
        <div class = "justify-content">
            @foreach ($favorites as $favorite)
            <div class = "card m-2" style = "background-color: rgba(255,255,255, 0.4); width: 50rem;">
                <div class = "row g-0">
                    <div class = "col-md-4">
                        <img src = "{{asset('storage/' . $favorite->listing->product->image_path)}}" class = "card-img-top" alt = "product image">
                    </div>
                    <div class = "col-md-4">
                        <div class = "card-body">
                            <h3 class ="card-title"> {{$favorite->listing->product->name}} </h3>
                            <p class = "card-text fs-5"> {{$favorite->listing->product->description}} </p>
                            <p class = "card-text fs-5"> {{ucfirst($favorite->listing->product->category)}} </p>
                            <p class = "card-text fs-5"> {{$favorite->listing->product->price}} </p>
                        </div>
                    </div>
                    <div class =  "col-md-4">
                        <form method = "post" action = "{{route('favorite.remove', ['favorite_id' => $favorite->id])}}" onsubmit = "return confirm('Are you sure you want unfavorite?')" class = "mt-2">
                            @csrf
                            @method('DELETE')
                            <button type ="submit" class = "btn btn-danger"> Remove </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</x-layouts.main>