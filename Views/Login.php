<!DOCTYPE html>

<head>
   <title>Tiwitter</title>
   <meta charset="utf-8" />
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="stylesheet" href="../css/Login.css" />
    <!--<link rel="icon" href="../images/logo.ico"/>-->
</head>


<body>

<div class="centered wrapper"><h1>Tiwitter</h1></div>

   <!--<img src="images/icon_log.svg" alt="image" title="icon_login" width="30%"/>-->

    <?php

    if(isset($params['accessDenied'])) {
        echo "
           <p style='color: red' align='center'>
           Identifiants incorrects !
           </p>
        ";
    }

    if(isset($params['registered'])) {
        echo "
           <p style='color: green' align='center'>
           Vous avez bien été enregistré !
           </p>
        ";
    }
    ?>
       <form action="/login", method="post">
           <div class="group">
               <input type="username" name="username" required>
               <span class="highlight"></span><span class="bar"></span>
               <label>Nom d'utilisateur</label>
           </div>
           <div class="group">
                <input type="password" name="password" required>
                <span class="highlight"></span><span class="bar"></span>
               <label>Mot de passe</label>
           </div>
           <div class="centered">
               <button class="button">Se connecter</button>
           </div>
       </form>
   <form action="/register">
       <div class="centered">
           <button class="button">S'enregistrer</button>
       </div>
    </form>

   <footer>
      <p></p>
   </footer>


</body>

</html>
