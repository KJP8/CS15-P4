<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>The Grocery List App</title>
    
    {{-- Link to Bootstrap CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link rel="stylesheet" href="/css/master.css">
    
    {{-- Yield any page with specific CSS files or anything else you might want in the <head> --}}
    @yield('head')
</head>
    
<body>
    {{-- Bootstrap CSS sticky nav bar--}}
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <!-- Required attribution to Nutritionix API -->
                    <li id="nutritionixImage"><a href="https://www.nutritionix.com/business/api"><img src="https://d3jpl91pxevbkh.cloudfront.net/nutritionix/image/upload/v1363458498/attribution_jqfdgy.png" alt="Nutritionix"></a></li>
                @endif
                
                <li class="navText"><a href='/'>Main Page</a></li>
                    
                @if(Auth::check())
                    <li class="navText"><a href='/home'>Home</a></li>
                    <li class="navText"><a href='/grocery-list/{{ Auth::user()->id }}'>My Grocery List</a></li>
                @endif
            </ul>
                
            {{-- Logic for logged in users and admins --}}
            <ul class='nav navbar-nav pull-right'>
                @if(Auth::check())
                    <li class="navText"><a href='/logout'>Sign Out</a></li>
                @else
                    <li class="{{ Request::path() == 'login' ? 'active' : '' }} navText"><a href='/login'>Log In</a></li>
                    <li class="{{ Request::path() == 'register' ? 'active' : '' }} navText"><a href='/register'>Sign Up</a></li>
                @endif
            </ul>
        </div>
    </nav>
    
    {{-- Show flash message --}}
    @if(Session::get('flash_message') != null)
        <div class='flash_message'>{{ Session::get('flash_message') }}</div>
    @endif
    
    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>
        
    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')
</body>
</html>