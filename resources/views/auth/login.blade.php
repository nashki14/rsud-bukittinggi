<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #0a1628;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-plus { font-size: 2rem; color: #c9a84c; }
        .logo-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: #0a1628;
            display: block;
            margin-top: .25rem;
        }
        .logo-sub { font-size: .8rem; color: #9b9aa0; }
        h2 { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #0a1628; margin-bottom: 1.5rem; }
        label { display: block; font-size: .875rem; font-weight: 600; color: #2e2d33; margin-bottom: .375rem; }
        input[type=email], input[type=password] {
            width: 100%; padding: .75rem 1rem;
            border: 1.5px solid #e2e1e4; border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: .9375rem;
            outline: none; transition: .3s;
            margin-bottom: 1rem;
        }
        input:focus { border-color: #c9a84c; box-shadow: 0 0 0 3px rgba(201,168,76,.12); }
        .error { color: #c0392b; font-size: .8125rem; margin-bottom: .75rem; padding: .75rem 1rem; background: #fdecea; border-radius: 6px; }
        button {
            width: 100%; padding: .875rem;
            background: #c9a84c; color: #0a1628;
            border: none; border-radius: 50px;
            font-family: 'DM Sans', sans-serif; font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: .3s;
        }
        button:hover { background: #e8c97a; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="logo">
        <div class="logo-plus">✚</div>
        <span class="logo-name">{{ config('app.name', 'RS Medika Prima') }}</span>
        <span class="logo-sub">Panel Administrasi</span>
    </div>
    <h2>Masuk ke Dashboard</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Masuk →</button>
    </form>
</div>
</body>
</html>