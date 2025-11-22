<x-layouts.main> 
        <div>
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
                        <form method = "POST" action = "{{route('conversation.start', ['receiver_id' => $user->id])}}">
                            @csrf   
                            <button class = "mt-2 btn btn-primary rounded-4" style ="width: 100%;"> Contact Seller </button>
                        </form>
                        <form method = "POST" action = "{{route('favorite.add', ['listing_id' => $listing_id])}}">
                            @csrf
                            <button class = "mt-2 btn btn-outline-primary rounded-4" style = "width: 100%"> Favorites </button>
                        </form>
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
</x-layouts.main>