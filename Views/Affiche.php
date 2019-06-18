<!DOCTYPE html>

<head>
    <title>Tiwitter</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="../css/Affiche.css" />

</head>

<body>
<div class="centered wrapper"><h1>Tiwitter</h1></div>

<div class="centered"><h2>Identité : <a id="Name" href="/user" style="color:#fe5353"><?php  echo  $params['app']->getSessionParameters('user')['username']; ?></a></h2></div><?php

if(isset($params['tiwitPosted'])) {
    echo "
           <p style='color: green' align='center'>
           Tiwit posté !
           </p>
        ";
}
?>

<div class="blanc">
<table>
    <?php

    foreach ($params['tiwits'] as $tiwit) :?>
    <tr>
        <p class="tiwits">
            Tiwit de <p2 class="pseudo"><?= $tiwit->getUtilisateur(); ?></a></p2>
            <?php echo ":"?>
            <br>
            <?= $tiwit->getContenu(); ?>
            <br>
            <form>
            <button class="LikeButton" href="" ">Like</button>
            <form action="/Home/userfollowed"><button class="RetiwitButton" href="" >Retiwit</button></form>
        </form>
            <br><br>
        </p>

    </tr>

    <?php endforeach; ?>

</table>
</div>

</body>
<div class="centeredButton">
    <form action="/Home">
        <button class="buttonReturn">Retour </button>
    </form>
</div>
<footer>
    <br><br><br>
    <div class="centeredButton">
        <form action="/">
            <button class="buttonDisconnect">Se déconnecter</button>
        </form>
    </div>
</footer>
</html>

