<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["yt_username"]) && !empty($_POST["yt_password"]) && !empty($_POST["yt_email"]) && !empty($_POST["yt_firstname"]) && 
        !empty($_POST["yt_lastname"]) && !empty($_POST["yt_confirm_password"]) && !empty($_POST["yt_allow"]))
    {
        $errors = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        # USERNAME
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['yt_username'])) {
            $errors[] = "Nome utente non valido";
        } else {
            $yt_username = mysqli_real_escape_string($conn, $_POST['yt_username']);
            $query = "SELECT username FROM ytm_users WHERE username = '$yt_username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $errors[] = "Nome utente già in uso";
            }
        }

        # PASSWORD
        if (strlen($_POST["yt_password"]) < 8) {
            $errors[] = "Password troppo corta (min. 8 caratteri)";
        }

        # CONFERMA PASSWORD
        if (strcmp($_POST["yt_password"], $_POST["yt_confirm_password"]) != 0) {
            $errors[] = "Le password non corrispondono";
        }

        # EMAIL
        if (!filter_var($_POST['yt_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email non valida";
        } else {
            $yt_email = mysqli_real_escape_string($conn, strtolower($_POST['yt_email']));
            $res = mysqli_query($conn, "SELECT email FROM ytm_users WHERE email = '$yt_email'");
            if (mysqli_num_rows($res) > 0) {
                $errors[] = "Email già registrata";
            }
        }

        # REGISTRAZIONE
        if (count($errors) == 0) {
            $yt_firstname = mysqli_real_escape_string($conn, $_POST['yt_firstname']);
            $yt_lastname = mysqli_real_escape_string($conn, $_POST['yt_lastname']);
            $yt_password = mysqli_real_escape_string($conn, $_POST['yt_password']);
            $yt_password = password_hash($yt_password, PASSWORD_BCRYPT);

            $query = "INSERT INTO ytm_users(username, password, name, surname, email) 
                      VALUES('$yt_username', '$yt_password', '$yt_firstname', '$yt_lastname', '$yt_email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["ytmusic_username"] = $_POST["yt_username"];
                $userid = mysqli_insert_id($conn);
                $_SESSION["ytmusic_user_id"] = $userid;
                $query1 = "INSERT INTO profilo (immagine, ID_utente) values ('Immagini/default.jpg' , '$userid')";
                mysqli_query($conn, $query1);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $errors[] = "Errore durante la registrazione";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["yt_username"])) {
        $errors = array("Compila tutti i campi richiesti");
    }
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati - YT Music</title>
    <link rel="stylesheet" href="signup.css">
    <script src="signup.js" defer></script>
    <link rel="icon" type="image/png" href="Immagini/logo1.png">
</head>
<body>
    <header>
        <div class="logo">YT Music
        <img src= "Immagini/ytmusic.png">
        </div>
    </header>

    <main class="container">
        <section class="form-wrapper">
            <h1>Crea un account YT Music</h1>
            <p class="subtitle">Scopri, ascolta e ama la tua musica preferita</p>

            <form name="yt_signup" method="post" autocomplete="off" class="signup-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="yt_firstname">Nome</label>
                        <input type="text" name="yt_firstname" id="yt_firstname" 
                            value="<?php if (isset($_POST['yt_firstname'])) echo htmlspecialchars($_POST['yt_firstname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="yt_lastname">Cognome</label>
                        <input type="text" name="yt_lastname" id="yt_lastname"
                            value="<?php if (isset($_POST['yt_lastname'])) echo htmlspecialchars($_POST['yt_lastname']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="yt_username">Nome utente</label>
                    <input type="text" name="yt_username" id="yt_username"
                        value="<?php if (isset($_POST['yt_username'])) echo htmlspecialchars($_POST['yt_username']); ?>" required>
                        <span id="errore_user"></span>
                </div>

                <div class="form-group">
                    <label for="yt_email">Email</label>
                    <input type="email" name="yt_email" id="yt_email"
                        value="<?php if (isset($_POST['yt_email'])) echo htmlspecialchars($_POST['yt_email']); ?>" required>
                        <span id="errore_mail"></span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="yt_password">Password</label>
                        <input type="password" name="yt_password" id="yt_password" required>
                    </div>
                    <div class="form-group">
                        <label for="yt_confirm_password">Conferma Password</label>
                        <input type="password" name="yt_confirm_password" id="yt_confirm_password" required>
                    </div>
                </div>

                <div class="form-group checkbox">
                    <input type="checkbox" name="yt_allow" id="yt_allow" value="1"
                        <?php if (isset($_POST["yt_allow"])) echo $_POST["yt_allow"] ? "checked" : ""; ?>>
                    <label for="yt_allow">Accetto i <a href="#">termini e condizioni</a> di YT Music</label>
                </div>

                <?php if (isset($errors)) {
                    foreach ($errors as $err) {
                        echo "<div class='error-msg'><span>$err</span></div>";
                    }
                } ?>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Registrati</button>
                </div>
            </form>

            <div class="redirect-login">
                Hai già un account? <a href="login.php">Accedi</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> YT Music. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>
