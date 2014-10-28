<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Inscription à la newsletter</h2>
    <div>Pour confirmer votre inscription sur www.droitdutravail.ch veuillez suivre ce lien
        <a style="color: #000; font-size: 15px;" href="{{ URL::to('inscription/activation', array($token)) }}">Confirmer l'adresse email</a>
    </div>
    <p><a style="color: #444; font-size: 13px;" href="http://www.droitdutravail.ch">www.droitdutravail.ch</a></p>
</body>
</html>
