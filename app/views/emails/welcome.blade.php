<!DOCTYPE html>
<html>
<head>
  <title>Bievenu Chez ESIGE</title>
  <style>
    /* CSS for styling the email goes here */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    p {
      font-size: 16px;
      line-height: 1.5;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Bonjour, {{$student->fname.' '.$student->lname}}.</h3>
    <p>Nous sommes ravis de vous avoir à bord. Nous savons que vous allez adorer utiliser notre plateforme.</p>
    <p>S'il vous plaît, réinitialisez votre mot de passe en utilisant ce lien pour accéder à notre plateforme d'études, <a href="{{ URL::to('password/reset', array($student->token)) }}">Cliquez ici.</a></p>
    <p>N.B: Ce lien expirera dans {{ Config::get('auth.reminder.expire', 60) }} minutes.</p><br>
    <p>Si vous avez des questions ou avez besoin d'aide pour démarrer, veuillez nous contacter.</p>
    <p>Meilleur, <br>L'équipe</p>
  </div>
</body>
</html>
