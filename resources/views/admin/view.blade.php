<x-layouts.main>
    <style>
        /* --- Phantom Route Color Palette --- */
        /* Dark Header/Button Color: #385e38 (Dark Olive Green) */
        /* Light Background/Body Color: #f0f5e8 (Off-White / Light Green Tint) */
        
        /* ------------------------------------ */
        /* 1. LAYOUT & CENTERING */
        /* ------------------------------------ */
        .admin-container {
            max-width: 1100px; /* Max width for a clean look */
            margin: 0 auto; /* Center the entire content block */
            padding: 20px;
        }

        /* ------------------------------------ */
        /* 2. HEADER & SEARCH STYLES */
        /* ------------------------------------ */
        .phantom-header-bar {
            background-color: #385e38;
            color: #f0f5e8;
            padding: 15px 30px; /* Increased padding for professional feel */
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            box-shadow: 0 4px 6px -6px #333; /* Subtle shadow */
        }
        .phantom-title {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 400;
        }
        .current-balance {
            font-size: 1.1rem;
            font-weight: bold;
        }

        /* Search/Filter Box (Retains the "Shop by Category" style) */
        .shop-by-category-box {
            border: 1px solid #385e38;
            background-color: #f0f5e8;
            max-width: 100%; /* Take full container width */
            margin-bottom: 30px;
        }
        .shop-category-header {
            background-color: #385e38;
            color: #f0f5e8;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* ------------------------------------ */
        /* 3. USER LISTING ITEMS */
        /* ------------------------------------ */
        .sr-listing-box {
            background-color: #ffffff; /* Use pure white for contrast */
            border: 1px solid #c8d4c8; /* Lighter border for clean look */
            border-radius: 3px;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .sr-listing-box:hover {
            box-shadow: 0 2px 10px rgba(56, 94, 56, 0.15);
        }

        .sr-info-panel, .sr-price-panel, .sr-action-panel {
            padding: 15px !important;
        }
        .sr-info-panel {
            border-right: 1px solid #eee; /* Separator for clean structure */
        }
        .sr-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #385e38;
            margin-bottom: 5px;
        }
        .sr-details {
            font-size: 0.9rem;
            color: #555;
            margin: 2px 0;
        }
        .sr-balance {
            font-weight: bold;
            color: #008000;
            font-size: 1.1rem;
        }
        .sr-status-locked {
            color: #c90000;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .sr-status-active {
            color: #006400;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* ------------------------------------ */
        /* 4. BUTTONS */
        /* ------------------------------------ */
        .admin-action-btn {
            background-color: #385e38;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            transition: opacity 0.2s, background-color 0.2s;
            line-height: 1.5;
            flex-grow: 1; /* Make buttons grow to fill space */
            margin: 0 4px;
            text-align: center;
        }
        .admin-action-btn:hover {
            opacity: 0.9;
        }
        .sr-btn-remove {
            background-color: #8b0000;
        }
        .sr-btn-unblock {
            background-color: #006400;
        }
        .sr-btn-block {
            background-color: #c90000;
        }
    </style>

    <div class="admin-container">
        
        {{-- Top Bar/Header --}}
        <div class="phantom-header-bar">
            <h2 class="phantom-title">Admin Panel - View Users</h2>
            <div class="current-balance">
                Total Users: {{ $users->count() }}
            </div>
        </div>


        {{-- User Listing Section --}}
        <div class="d-flex flex-column">
            @forelse ($users as $user)
            <div class="sr-listing-box mb-3"> 
                <div class="row g-0 sr-listing-body align-items-center">
                    
                    {{-- User Info Panel (ID, Username, Dates) --}}
                    <div class="col-md-5 sr-info-panel">
                        <h3 class="sr-title">{{ $user->name }} <span class="sr-details">(#{{ $user->id }})</span></h3> 
                        <p class="sr-details">Joined: {{ $user->created_at->format('M d, Y') }}</p>
                       
                    </div>
                    
                    {{-- Status & Balance Panel --}}
                    <div class="col-md-3 sr-price-panel text-center">
                        <p class="sr-balance">₿ {{ number_format($user->balance, 8) }}</p>
                        @if ($user->is_locked)
                            <span class="sr-status-locked">LOCKED</span>
                        @else
                            <span class="sr-status-active">ACTIVE</span>
                        @endif
                    </div>

                    {{-- Action Panel (Buttons for Admin Actions) --}}
                    <div class="col-md-4 sr-action-panel d-flex justify-content-center">
                        
                        {{-- Action 3: Remove/Delete User --}}
                        <form method="post" action="{{ route('admin.user.remove', ['user_id' => $user->id]) }}" 
                              onsubmit="return confirm('Are you sure you want to PERMANENTLY remove this user?')" 
                              class="d-inline d-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-action-btn sr-btn-remove">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="text-center p-5 sr-listing-box">
                    <p class="h5 text-muted">No users found matching the current criteria.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.main>