<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Halo, {{ $user->nama }}</h1>
    <img src="https://media1.tenor.com/images/7a9d591fddca2f269bb38e322a27834d/tenor.gif?itemid=3461065" alt="">
    <p>
        terima kasih karena sudah menjadi member dari website kami <br>
        silahkan klik tombol dibawah untuk masuk ke halaman login website kami
    </p>

    <a href="http://localhost:8000/login" style="color: white; text-decoration: none">
        <button style="background: #0069D9; color: white; border-radius:4px; padding: 6px 12px;">
            Link Web
        </button>
    </a>
</body>
</html>