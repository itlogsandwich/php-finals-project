<x-layouts.main>
<div class="d-flex flex-column">
    @foreach ($users as $user)
    <div class="sr-listing-box">
        <div class="row g-0 sr-listing-body">
            
            <div class="col-md-6 sr-info-panel">
                <h3 class="sr-title">{{ $user->id }}</h3> 
                <p class="sr-title">{{ $user->name }}</p>
                
            </div>
            
            <div class="col-md-3 sr-action-panel">
                <form method="post" action="{{ route('admin.remove', ['user_id' => $user->id]) }}" onsubmit="return confirm('Are you sure you want to remove this listing?')" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="sr-btn-remove"> Remove </button>
                </form> 
            </div>
        </div>
    </div>
    @endforeach
</div>
</x-layouts.main>