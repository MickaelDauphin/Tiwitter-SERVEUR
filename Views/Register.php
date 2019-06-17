<!DOCTYPE html>

<head>
    <title>Tiwitter</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="../css/Register.css" />
    <!--<link rel="icon" href="../images/logo.ico"/>-->
</head>

<body>

<div class="centered wrapper"><h1>S'enregistrer</h1></div>

<?php if(isset($params['!registered'])) {
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

if (isset($params['userExist']))
{
    echo "
           <p style='color: red' align='center'>
           Cet utilisateur existe déjà.
           </p>
        ";
}
?>


    <form action="/tryRegister" method="post" autocomplete="off">

        <!-- Prénom -->
        <div class="group">
            <input type="text" id="input-1" name="firstName" minlength="3" maxlength="40" required />
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez vore prénom</label>
        </div>
        <!-- Nom -->
        <div class="group">
            <input type="text" id="input-2" name="familyName" minlength="3" maxlength="40" required/>
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez vore nom</label>
        </div>
        <!-- Username -->
        <div class="group">
            <input class="input__field input__field--kaede" type="text" id="input-3" name="username" minlength="4" maxlength="40" required />
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez vore nom d'utilisateur</label>
        </div>
        <!-- Password -->
        <div class="group">
            <input class="input__field input__field--kaede" type="password" id="input-4" name="password" minlength="6" maxlength="80" required/>
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez un mot de passe</label>
        </div>
        <!-- Password Re -->
        <div class="group">
            <input class="input__field input__field--kaede" type="password" id="input-5" name="passwordConfirm" minlength="6" maxlength="80" required />
            <span class="highlight"></span><span class="bar"></span>
            <label>Confirmez le mot de passe</label>
        </div>
        <!-- Email -->
        <div class="group">
            <input class="input__field input__field--kaede" type="text" id="input-6" name="email" minlength="4" maxlength="80" required/>
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez un email</label>
        </div>

        <!-- Button -->
        <button class="button">Confirmer</button>
    </form>
    <form action="/">
        <button class="button">Retour</button>
    </form>

<footer>
    <p></p>
</footer>


</body>

</html>
