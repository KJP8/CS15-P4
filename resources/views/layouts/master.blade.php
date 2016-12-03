<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Nutritionist at Your Fingertips</title>
    
    {{-- Link to Bootstrap CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/master.css">
    
    {{-- Yield any page with specific CSS files or anything else you might want in the <head> --}}
    @yield('head')
</head>
    
<body>
    {{-- Bootstrap CSS/JS sticky nav bar--}}
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href='/'>Main Page</a></li>
                <li><a href='#'>Home</a></li>
            </ul>
            {{-- Add logic here for logged in users and admins --}}
            <ul class='nav navbar-nav pull-right'>
            @if(Auth::check())
                <li><a href='/logout'>Sign Out</a></li>
            @else
                <li class="{{ Request::path() == 'login' ? 'active' : '' }}"><a href='/login'>Log In</a></li>
                <li class="{{ Request::path() == 'register' ? 'active' : '' }}"><a href='/register'>Sign Up</a></li>
            @endif
        </ul>
        </div>
    </nav>
    
    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>
        
    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')
    
    {{-- Link to jQuery --}}
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    {{-- Link to Bookstrap JS --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>