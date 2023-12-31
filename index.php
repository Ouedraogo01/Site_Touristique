<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Transparent Forms</title>
</head>

<body>
    <div class="container">
        <nav>
            <a href="#" class="logo" id="logo">Coding</a>
            <ul>
                <li class="nav-item"><a href="#" class="nav-link">lien 1</a></li>
                <li class="nav-item"><a href="#" class="nav-link">lien 2</a></li>
                <li class="nav-item"><a href="#" class="nav-link">lien 3</a></li>
                <li class="nav-item"><a href="#" class="nav-link">lien 4</a></li>
                <li class="nav-item">
                    <button type="button" , role="button" class="btn" id="displayForm">Se Connecter</button>
                </li>
            </ul>
        </nav>

        <section>
            <div class="sec-container">
                <div class="formWrapper">
                    <div class="card">
                        <div class="card-header">
                            <div id="forLogin" class="form-header active">Se connecter</div>
                            <div id="forRegister" class="form-header">S'inscrire</div>
                        </div>
                        <div class="card-body" id="formContainer">
                            <form action="" id="loginForm">
                                <input type="text" class="form-control" placeholder="@Utilisateur" />
                                <input type="password" class="form-control" placeholder="Mot de passe" />
                                <label for="remember">
                                    <input type="checkbox" class="form-check" id="remember" />
                                    Se Souvenir de moi
                                </label>
                                <button class="formButton">Connexion</button>
                            </form>

                            <form action="" id="registerForm" class="toggleForm">
                                <input type="text" class="form-control" placeholder="@utilisateur..." />
                                <input type="text" class="form-control" placeholder="Mot de passe..." />
                                <input type="text" class="form-control" placeholder="Confirmer mot de passe..." />
                                <label for="remember">
                                    <input type="checkbox" class="form-check" id="privacy" />
                                    J'accepte les termes de l'accord
                                </label>
                                <button class="formButton">Inscription</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        function _(e) {
            return document.getElementById(e);
        }
        let displayform = _('displayForm');
        let forlogin = _('forLogin');
        let loginForm = _('loginForm');
        let forRegister = _('forRegister');
        let registerForm = _('registerForm');
        let formContainer = _('formContainer');
        displayform.addEventListener('click', showForm);

        forlogin.addEventListener('click', (e) => {
            e.preventDefault;
            forRegister.classList.remove('active');
            forlogin.classList.add('active');
            if (loginForm.classList.contains('toggleForm')) {
                formContainer.style.transform = 'translate(0%)';
                formContainer.style.transition = 'transform .5s';
                loginForm.classList.remove('toggleForm');
                registerForm.classList.add('toggleForm');
            }
        });

        forRegister.addEventListener('click', (e) => {
            e.preventDefault;
            forlogin.classList.remove('active');
            forRegister.classList.add('active');
            if (registerForm.classList.contains('toggleForm')) {
                formContainer.style.transform = 'translate(-100%)';
                formContainer.style.transition = 'transform .5s';
                registerForm.classList.remove('toggleForm');
                loginForm.classList.add('toggleForm');
            }
        });

        function showForm() {
            document.querySelector('.formWrapper .card').classList.toggle('show');
        }
    </script>
</body>

</html>