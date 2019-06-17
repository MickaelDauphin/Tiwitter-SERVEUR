<!DOCTYPE html>

<head>
    <title>Tiwitter</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="../css/User.css" />
</head>

<body>
<div class="centered wrapper"><h1>Tiwitter - Infos utilisateur</h1></div>



<?php if(isset($params['error'])) {
    echo "
           <p style='color: red' align='center'>
           Une erreur est survenue, veuillez réessayer.
           </p>
        ";
}

if (isset($params['passwordError']))
{
    echo "
           <p style='color: red' align='center'>
           Les mots de passes sont différents, veuillez vérifier votre saisie.
           </p>
        ";
}

if (isset($params['success']))
{
    echo "
           <p style='color: green' align='center'>
           Modifications correctement prises en comptes !
           </p>
        ";
}
?>

<br/>
<h2 align="center">Identité : <?php $user = $params['app']->getSessionParameters('user'); echo $user['username']; ?> </h2>

<form action="/user/update" method="post">
    <!-- Username -->
    <div class="group">
        <input type="text" id="input-1" value="<?php echo $user['username']; ?>" name="username" minlength="4" maxlength="40" required />
        <span class="highlight"></span><span class="bar"></span>
        <label>Entrez votre nom d'utilisateur</label>
    </div>
    <!-- Nom -->
    <div class="group">
        <input type="text" id="input-2" value="<?php echo $user['familyName']; ?>" name="familyName" minlength="3" maxlength="40" required/>
        <span class="highlight"></span><span class="bar"></span>
        <label>Entrez votre nom</label>
    </div>
    <!-- Prénom -->
    <div class="group">
        <input type="text" id="input-3" value="<?php echo $user['firstName']; ?>" name="firstName" minlength="3" maxlength="40" required/>
        <span class="highlight"></span><span class="bar"></span>
        <label>Entrez votre prénom</label>
    </div>
    <!-- Email -->
    <div class="group">
        <input type="text" id="input-4" value="<?php echo $user['email']; ?>" name="email" minlength="4" maxlength="80" required />
        <span class="highlight"></span><span class="bar"></span>
        <label>Entrez votre email</label>
    </div>
    <!-- Password -->
    <div class="group">
        <input type="password" id="input-5" value="" name="password" minlength="6" maxlength="80"/>
        <span class="highlight"></span><span class="bar"></span>
        <label>Entrez votre nouveau mot de passe (si changement)</label>
    </div>
    <!-- Password Re -->
    <div class="group">
        <input type="password" id="input-6" value="" name="passwordConfirm" minlength="6" maxlength="80"/>
        <span class="highlight"></span><span class="bar"></span>
        <label>Confirmez votre nouveau mot de passe (si changement)</label>
    </div>

    <button class="button">Enregistrer les modifications</button>
</form>

<form action="/home">
    <button class="button">Retour</button>
</form>


<footer>
    <p></p>
</footer>


</body>

</html>

