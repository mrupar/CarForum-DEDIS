<!DOCTYPE html>
<html>
   <head>
      <title>Laravel</title>
      <link href = "https://fonts.googleapis.com/css?family=Lato:100" rel = "stylesheet" 
         type = "text/css">
      
      <style>
         html, body {
            height: 100%;
         }
         body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
         }
         .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
         }
         .content {
            text-align: center;
            display: inline-block;
         }
         .title {
            font-size: 96px;
         }
      </style>
   </head>
   
   <body>
      <div class = "container">
         
         <div class = "content">
            <div class = "title">Welcome to Car Forum</div>
         </div>
         <div class="card">
               @auth
                  <div style="display:flex; align-items:center; justify-content:space-between">
                     <div>
                        <div style="font-weight:600">Hello, {{ Auth::user()->name }}</div>
                        <div class="muted small">Member since {{ Auth::user()->created_at->format('M Y') }}</div>
                     </div>
                  </div>
                  <div style="margin-top:12px" class="actions">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-ghost" type="submit">Logout</button>
                     </form>
                  </div>
               @else
                  <h3 style="margin:0 0 8px">Sign in</h3>

                  @if(session('status'))
                     <div class="small" style="margin-bottom:8px">{{ session('status') }}</div>
                  @endif

                  <form method="POST" action="{{ route('login') }}">
                     @csrf
                     <div style="display:flex; flex-direction:column; gap:12px; text-align:center;">

                        <div style="margin-bottom:12px;">
                            <label class="small">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus />
                            @error('email') 
                                <div class="small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom:12px;">
                            <label class="small">Password</label>
                            <input type="password" name="password" required />
                            @error('password') 
                                <div class="small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-top:8px;">
                            <label style="display:flex; align-items:center; gap:6px;">
                                <input type="checkbox" name="remember">
                                <span class="small">Remember me</span>
                            </label>

                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>

                     </div>
                  </form>

                  @if (Route::has('register'))
                     <div style="margin-top:12px" class="small">Don't have an account? <a href="{{ route('register') }}">Register</a></div>
                  @endif
               @endauth
            </div>
			
      </div>
   </body>
</html>