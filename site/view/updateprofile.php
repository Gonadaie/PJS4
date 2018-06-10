<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: ../view/logout.php');
}

include("../controller/updateprofile.php");
$info_student = json_decode($json_array);
$student = $info_student->student;

?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>Mon profile</title>
		<!--		<CSS>				-->
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/signup_login.css">


        <script src="../scripts/jquery.min.js"></script>
        <script src="../scripts/croppie.js"></script>


        <!--		<font>				-->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<!--		<bootstrap>				-->

        <script src="../scripts/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <link rel="stylesheet" href="../styles/croppie.css">

        <!--		<fav icon>				-->
		<link rel="apple-touch-icon" sizes="180x180" href="../favicon_package_v0.16/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../favicon_package_v0.16/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../favicon_package_v0.16/favicon-16x16.png">
		<link rel="manifest" href="../favicon_package_v0.16/site.webmanifest">
		<link rel="mask-icon" href="../favicon_package_v0.16/safari-pinned-tab.svg" color="#4152bc">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="theme-color" content="#e6f0f5">


	</head>

	<body>
		<div class="menu">
			<a href="../view/swipe.php" class="menu_inactive">swipe</a>
			<a href="../view/updateprofile.php" class="menu_active">mon compte</a>
			<a href="#" class="menu_inactive">messages</a>
			<a href="../view/logout.php" class="menu_inactive">log out</a>
		</div>
		<div class="back"></div>

		<form action="#" id="imageForm" method="post" enctype="multipart/form-data"> <!imageForm->
			<label for="fileToUpload">
					<div class="picture_profile img_profile modify-image"><div class="hover_modify">Modifier la photo</div><img src="<?= htmlspecialchars($student->pic); ?>" alt=""></div>
 			</label>
			<input type="file" accept="image/x-png, image/gif, image/jpeg" name="fileToUpload" id="fileToUpload">
		</form>






		<div class="cloud_profile"><img src="../images/cloud.svg" alt=""></div>
		<div class="year_email_profile">
			<span class="DUT">DUT
			<?= $student->year ?> -</span>

			<?= $student->email ?>@etu.parisdescartes.fr</div>
			<div class = "delete_user><a href="#">Supprimer mon profil</a></div>
		<div class="stats_profile">
			<div>
				<?= $info_student->match ?> matchs</div>
			<div>0 parainage</div>
		</div>
	
		<div class="name_profile">
			<?= $student->surname ?>
		</div>
		<div class="adj_profile">
			<?= $student->adj1 ?> -
				<?= $student->adj2 ?> -
					<?= $student->adj3 ?>
		</div>
		<div class="description_profile old_description">
			<?= htmlspecialchars($student->description); ?>
		</div>
			<textarea class="description_profile new_description" name="description" rows="4" cols="7" maxlength="280"><?= htmlspecialchars($student->description); ?></textarea>
		</form>
		<div class="edit_profile">
			<img class="edit" src="../images/edit.png" alt="edit">
			<img class="confirm" src="../images/checked.png" alt="edit">
			<img class="cancel" src="../images/cancel-button-3.png" alt="edit">
		</div>
		<?php foreach ($errorMessages as $errorMessage): ?>
		<p>
			<?= $errorMessage ?>
		</p>
		<?php endforeach ?>

        <!--		<js>				-->
		<script src="../scripts/updateprofile.js"></script>

	</body>

	</html>







<!apparait pour couper la photo-->

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>  <!boutton exit-->
                <h4 class="modal-title">Title</h4>
            </div>

            <div class="modal-body">
                <div class="row">


                    <div class="col-md-8 text-center">
                        <!--	image_demo-->
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>

                    <div class="col-md-4" style="padding-top:30px;">  <!à effacer????!!-->
                        <br />
                        <br />
                        <br/>


                        <!--	bouton final -->

                        <button class="btn btn-success crop_image">Crop & Upload Image</button>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $image_crop = $('#image_demo').croppie({ <!--	image demo dans la forme coupée, affichage niveau coupage-->
            enableExif: true,
            viewport: {
                width:200,  <!--dimensions caré pour couper-->
                height:200,
                type:'circle' //square
            },
            boundary:{ <!--	conteneur zone de coupage-->
                width:300,
                height:300
            }
        });

        $('#fileToUpload').on('change', function(){     <!--	nom immage originale bloc base-->
            <!--	quand on choisi l'immage ce code s'execute-->

            var reader = new FileReader();   <!--	stocket tous les infos de l'immage-->
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }

            reader.readAsDataURL(this.files[0]); <!--	afficher l'immage choisie dans la zone de coupage!!!!-->

            $('#uploadimageModal').modal('show'); <!--	afficher toute la fenetre de coupage!!!!-->


        });




        <!--	click sur le bouton final!!!!-->

        $('.crop_image').click(function(event){      <!--	fonction qui s'execute quand on click sur le bouton final!!!!-->
            $image_crop.croppie('result', {    <!--	methode pour obtenir l'immage coupée!!!!-->
                type: 'canvas',
                size: 'viewport' <!--	la taille de limmage va être la taille de la zone de coupage !!!!-->

            }).then(function(response){ <!--fonction qui envoie l'immage coupée finale !!!!-->
                $.ajax({
                    url:"../controller/updateprofile.php",  <!--	appel fichier php pour enregistrer immage-->
                    type: "POST",      <!--	envoie réponse au server!!!!-->
                    data:{"image": response}, <!--	ce qu'on veut envoyer au serveur, une immage qui est contenue dans la réponse pour le serveur!!!!-->


                    success:function(data) <!--	fonction qui reçoit des données du serveur!!!!-->
                    {
                        $('#uploadimageModal').modal('hide'); <!--	cacher la fenetre de coupage !!!!-->
                    }
                });
            })
        });


    });
</script>
