<?php
ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_DEPRECATED);
	 session_start(); 
	@$email=$_POST["Email"];
	@$pass=$_POST["Pass"];
    @$valider=$_POST["submit"];
	$message="";
	if(isset($valider)){
		include("../executable/connexion.php");
		$res=$pdo->prepare("SELECT * FROM user1 WHERE mail=? AND mot_de_passe=?  limit 1");
		$res->setFetchMode(PDO::FETCH_ASSOC);
		$res->execute(array($email,md5($pass)));
		$tab=$res->fetchAll();
        /* var_dump(count($tab)==0);
        die; */
		if(count($tab)==0){
            $message="<li>Mauvais login ou mot de passe!</li>";
            
        }
       
			
		else
        {
			$_SESSION["autoriser"]="oui";
        $messagePrenomNom=$_SESSION["nomPrenom"]=($tab[0]["nom"]." ".$tab[0]["prenom"]);
        $messageMatricule=$_SESSION["LeMatricule"]=strtoupper($tab[0]["matricule"]);
        $messageEmail=$_SESSION["LeEmail"]=($tab[0]["mail"]);
        $messagePhoto=$_SESSION["LaPhoto"]=$tab[0]["photo"];
        $messageId=$_SESSION["Id"]=$tab[0]["id"];
        $_SESSION["etat"]=$tab[0]["etat"];


        $_SESSION["LeRole"]=strtoupper($tab[0]["role"]);
       /*     var_dump( $_SESSION["Id"]);
        die  ;   */
        // $message.="connection reussi";
        if($_SESSION["LeRole"]=="ADMIN")
        {
            header("Location:PAgeadmin.php?id=$person->id ");
        } else if($_SESSION["LeRole"]=="USER")
             {
                header("Location:pageUser.php");
             }
		}}
 /*    }
    $tab=$res->fetchAll();
    // var_dump($tab);
    // exit;

    if(count($tab)>0)
    {
        
    }
    else{
        $message1="<li>Mauvais login ou mot de passe!</li>";

    } */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="essai.css">
    <title>Document</title>
</head>
<body>
    <div class="page-connection-3 screen">
    <div class="desktop-8"> </div>
    <div class="overlap-group">
        <img class="rectangle-1" src="../img/iconere.jpeg" alt="Rectangle-1">
        <div class="rectangle-31"></div>
        <img class="rectangle-2" src="../img/pr9.webp" alt="Rectangle-2">
        <h1 class="title ibmplexsans-blod-black-32px">Formulaire de connection</h1>
        <form action="" method="post" id="myform">
        <div class="rectangle-7">
            <input type="email" name="Email" id="Email">
        </div>
        <div id="messagerC3"></div>
        <div id="messagerC5"></div>
        <?php if(!empty($message)){ ?>
		<div class="messagerr3"><?php echo $message ?></div>
		<?php } ?>
        
        <div class="rectangle-9">
            <input type="password" name="Pass" id="Password">
        </div>
        <div class="email ibmplexsans-bold-black-20px">Email</div>
        <div class="mot-de-passe ibmplexsans-bold-black-20px">Mot de passe</div>
        <div class="glass"></div>
        <!-- <div ></div> -->
        <input class="se-connecter ibmplexsans-bold-black-32px" type="submit"  name="submit" value="Seconnecter">
         <a href="../view/essai2.php"><div class="connecter">S'inscrire</div></a>
        </form>
    </div>
    </div>
</body>
<script src="../executable/pc.js"></script>
</html>