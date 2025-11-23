<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JanKamelDroga Anonymous Market</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f5f5f0; 
            font-family: 'Arial', sans-serif;
        }
        .navbar .form-control-sm {
            padding: 0 8px;
        }
        
        .navbar-brand .logo-img {
            height: 40px;
            width: auto;
            margin-right: 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background-color:#486b40; border-bottom:4px solid #3b5734; padding: 5px 15px;">
        <div class="container-fluid">
            
            <a href="{{ route('home') }}" class="navbar-brand" style="color:#fff; font-family:'Georgia', serif; font-size: 24px; font-weight:bold;">
                
                    <img src="{{ asset('assets/drags.png') }}" 
                     alt="JanKamelDroga Logo" 
                     class="logo-img" 
                     onerror="this.onerror=null;" this.src="'https://placehold.co/40x30/cc0000/FFFFFF?text=X';" 
                     title="JanKamelDroga">
                     
                JanKamelDroga <span style="font-size:12px; color:#aacc99;">anonymous market</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#srNavbar" aria-controls="srNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="srNavbar">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('conversation.show') }}" style="color:#e0e0e0; font-weight:bold;">
                                Messages 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listing.show') }}" style="color:#e0e0e0;">Account</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-3">
                    
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm rounded-0" type="search" placeholder="search" 
                                style="border:none; height: 28px;">
                        <button class="btn btn-sm btn-light rounded-0" type="submit" style="height: 28px; line-height: 1;">Go</button>
                    </form>

                    <div style="color:white; font-size: 13px;">
                        @auth
                            <span style="color:#ffd700; font-weight:bold; margin-right: 10px;">
                                ฿0.000000
                            </span>
                            
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link p-0" style="color:#ccc; text-decoration:underline; font-size:12px; vertical-align: baseline;">
                                    logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="color:#fff; text-decoration:underline;">login</a>
                            <span style="color:#999;">or</span>
                            <a href="{{ route('register') }}" style="color:#fff; text-decoration:underline;">register</a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <!-- Sub-Navbar / Logged In Info -->@auth
    <div style="background-color: #ddd; border-bottom: 1px solid #ccc; padding: 5px 20px; font-size: 12px; color: #555;">
        Logged in as: <strong>{{ Auth::user()->name }}</strong> &nbsp;|&nbsp; 
        
        <a href="{{ route('profile.edit') }}" style="color:#486b40;">Settings</a> &nbsp;|&nbsp; 
        
        <a href="{{ route('listing.show') }}" style="color:#486b40;">Profile</a>
    </div>
    @endauth

    <!-- Main Content Area --><main class="py-4 container">
        @yield('content')
    </main>

    <!-- Bootstrap JS (needed for navbar-toggler/collapse) --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>