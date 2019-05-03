<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


</head>

<body>

  <!-- <?php require_once 'process.php'; ?> -->


    <div class="container">
     <!-- Message d'alerte -->
    <?php
    if (isset($_SESSION['message'])):
     ?>
     <div class="alert alert-<?=$_SESSION['msg_type']?>">
       <?php
       echo $_SESSION['message'];
       unset($_SESSION['message']);
        ?>
      </div>
    <?php endif; ?>

    <div class="container-fluid">

      <?php require_once 'Requete.php'; ?>

        <div class="row ">
            <div class="col-lg-3 sidebar">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-7 profile-sb">
                        <div class="user-info">
                            <div class="user-avatar"><img alt="User Pic" class="img-circle" width=100px height=100px
                                    src="https://images.unsplash.com/photo-1533075377664-f5c0cbc5a91c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80"></div>
                            <div class="user-info-name"><span>Jean Jacques</span></div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-7 profile-sb user-nav">
                        <ul class="nav-menu">
                            <li class="nav-menu-item">
                                <span>Vendeurs</span>
                            </li>
                            <li class="nav-menu-item highlight">
                                <span>Produits</span>
                            </li>
                            <li class="nav-menu-item">
                                <span>Vos informations</span>
                            </li>
                        </ul>
                    </div>
                </div>






            </div>


            <div class="col-lg-9">
                <div class="row">
                    <div class="col title">
                        <h1>Produits</h1>

                    </div>
                </div>
                <?php
                while ($data = mysqli_fetch_assoc($result)):
                  ?>
                <div class="row">

                    <div class="col-lg-9 content ">

                        <h1>Produit n° <?php echo $data['ID'];?></h1>
                        <h4>Mis en ligne le 02/02/2019</h4>
                        <div class="trait"></div>
                        <div class="row fiche-produit">
                            <div class="col-md-3" >
                              <?php
                              $imageData = base64_encode(file_get_contents($data['Photo']));
                              ?>
                              <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.$imageData.'">';?> </div>
                            <div class="col-md-8">
                                <div class="row info-produit">

                                    <div class="prod-name"><?php echo $data['Nom'];?> </div>
                                    <br>
                                    <div class="prod-desc"><?php echo $data['Description'];?></div>
                                    <br>

                                </div>

                                <div class=" produit-qty">
                                    <div class="content-left">
                                        Quantité stockée: <span style="font-weight:900;"><?php echo $data['Quantite'];?></span> unités
                                    </div>
                                    <br>
                                    <div class="content-left">
                                        Prix : <span style="font-weight:900;"><?php echo $data['Prix'];?></span> €
                                    </div>
                                    <div class="content-right ">
                                        <a href="items.php?edit= <?php echo $data['ID'];?>" class="btn btn-warning btn-md btn-cst-c1">Modifier</a>                                    </div>

                                </div>
                                <br> <br> <br>
                                <div class=" produit-dlt content-right">
                                            <a href="process.php?delete= <?php echo $data['ID'];?>" class="btn btn-danger btn-md">Supprimer l'article</a>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
              <?php endwhile; ?>



            </div>
        </div>


    </div>

</body>
