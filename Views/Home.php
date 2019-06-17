<!DOCTYPE html>

<head>
   <title>Tiwitter</title>
   <meta charset="utf-8" />
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="stylesheet" href="../css/Home.css" />

</head>

<body>
    <div class="centered wrapper"><h1>Tiwitter</h1></div>

    <div class="centered"><h2>Identité : <a id="Name" href="/user"><?php  echo  $params['app']->getSessionParameters('user')['username']; ?></a></h2></div>
    <?php

    if(isset($params['tiwitPosted'])) {
        echo "
           <p style='color: green' align='center'>
           Tiwit posté !
           </p>
        ";
    }
?>
    <script type="text/javascript">
        var objectList = <?php echo $params['objectList'] ?>;
    </script>
    <form action="/home/tiwit" method="post">
    <div class="centeredTexteArea">

        <div class="group">
            <input type="text" rows="6" maxlength="140" name="tiwit" required/>
            <span class="highlight"></span><span class="bar"></span>
            <label>Entrez un texte à tiwiter (140 caractères max)</label>
        </div>

         </div>
         <div class="centeredButton">
         <!--<form action="/home/tiwit" method="post">-->
    <button class="buttonTiwiter">Tiwiter</button>
    </form>
    </div>

</body>
<footer>
    <div class="centeredButton">
    <form action="/">
        <button class="button">Se déconnecter</button>
    </form>
    </div>
</footer>
</html>

