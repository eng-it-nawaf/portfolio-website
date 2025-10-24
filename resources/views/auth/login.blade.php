<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link rel="stylesheet" href="admin/css/login.css" />
</head>
<body>
  <img src="images/4.jpg" alt="Logo" class="logo-background" />
  <div class="container">
    <!-- Left Section -->
    <div class="left-section">
      <!-- SVG Background Decorations -->
      <svg class="bg-decor" width="100%" height="100%">
        <defs>
          <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#2fbbf7; stop-opacity:1" />
            <stop offset="100%" style="stop-color:#07f1e9; stop-opacity:1" />
          </linearGradient>
        </defs>
        <circle cx="20%" cy="30%" r="80" fill="url(#grad)" opacity="0.2">
          <animate attributeName="r" values="60;80;60" dur="6s" repeatCount="indefinite" />
        </circle>
        <circle cx="80%" cy="70%" r="60" fill="url(#grad)" opacity="0.2">
          <animate attributeName="r" values="40;60;40" dur="8s" repeatCount="indefinite" />
        </circle>
      </svg>

      <div class="welcome-box">
        <h1>Welcome to website</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
          tincidunt ut laoreet dolore magna aliquam erat volutpat.
        </p>
      </div>
    </div>

    <!-- Right Section -->
    <div class="right-section">
      <div class="login-box">
        <h2>USER LOGIN</h2>
        
        <!-- إضافة رسائل الخطأ -->
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          
          <div class="input-group">
            <span class="icon">&#128100;</span>
            <input type="email" name="email" placeholder="Email" required autofocus />
          </div>

          <div class="input-group">
            <span class="icon">&#128274;</span>
            <input type="password" name="password" placeholder="Password" required />
          </div>

          <div class="options">
            <label><input type="checkbox" name="remember" /> Remember</label>
            <a href="{{ route('password.request') }}">Forgot password?</a>
          </div>

          <button type="submit">LOGIN</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>