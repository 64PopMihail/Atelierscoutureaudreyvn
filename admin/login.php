<?php 
include 'config/bdd.php';
include 'config/config.php';
// var_dump(loginVerify());
if (loginVerify()===true) {
    header('location:'.URLADMIN.'index.php');
    die;
}
$title = 'Connexion';
include 'inc/top.php';

?>
<div class="container-fluid bg-gradient-dark vh-100">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image animated--fade-in"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenu(e)!</h1>
                                        
                                        <?php 
                                        if (isset($_SESSION['errors'])) {
                                            // var_dump($_SESSION['errors']);
                                            superAlert('danger','Veuillez remplir tous les champs');
                                            unset($_SESSION['errors']);
                                        }
                                        if (isset($_SESSION['login'])&& $_SESSION['login']===false) {
                                            // var_dump($_SESSION['errors']);
                                            superAlert('danger','L\'identifiant et/ou mot sont incorrects');
                                            unset($_SESSION['login']);
                                        }
                                        ?>
                                    </div>
                                    <form class="user" action="action.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="mail" class="form-control form-control-user"
                                                id="mail" aria-describedby="emailHelp"
                                                placeholder="Votre adresse email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="mdp" class="form-control form-control-user"
                                                id="mdp" placeholder="Mot de passe">
                                        </div>
                                    
                                        <button type="submit" class="btn btn-dark btn-user btn-block" name="btn-login">Se connecter</button>
                                     
                                    </form>
                                    <hr>
                                        <div class="text-center">
                                            <a class="small text-gray-900" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small text-gray-900" href="register.html">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
<?php 
include 'inc/bottom.php';