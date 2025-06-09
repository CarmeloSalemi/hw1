<?php
// Controlla se l'utente è già autenticato
include 'auth.php';
if (checkAuth()) {
    header('Location: home.php');
    exit;
}

if (!empty($_POST["yt_username"]) && !empty($_POST["yt_password"])) {
    require_once 'dbconfig.php';
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $yt_username = mysqli_real_escape_string($conn, $_POST['yt_username']);

    $query = "SELECT * FROM ytm_users WHERE username = '$yt_username'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($res) > 0) {
        $entry = mysqli_fetch_assoc($res);
        if (password_verify($_POST['yt_password'], $entry['password'])) {
            
            $_SESSION['ytmusic_username'] = $entry['username'];
            $_SESSION['ytmusic_user_id'] = $entry['id'];
            mysqli_free_result($res);
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        }
    }

    $error = "Username e/o password errati.";
} else if (isset($_POST["yt_username"]) || isset($_POST["yt_password"])) {
    $error = "Inserisci username e password.";
}
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi - YT Music</title>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" type="image/png" href="Immagini/logo1.png">
</head>
<body>
    <header>
        <div class="logo">YT Music
        <img src= "Immagini/ytmusic.png">
        </div>
    </header>

    <div class="container">
        <div class="form-wrapper">
            <h1>Accedi al tuo account</h1>
            <p class="subtitle">Bentornato! Inserisci le credenziali per continuare.</p>

            <?php if (isset($error)): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form name="login" method="post" class="login-form">
                <div class="form-group">
                    <label for="yt_username">Username</label>
                    <input type="text" name="yt_username" id="yt_username" 
                        value="<?php echo isset($_POST['yt_username']) ? htmlspecialchars($_POST['yt_username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="yt_password">Password</label>
                    <input type="password" name="yt_password" id="yt_password" 
                        value="<?php echo isset($_POST['yt_password']) ? htmlspecialchars($_POST['yt_password']) : ''; ?>">
                </div>

                <button type="submit" class="submit-btn">Accedi</button>
            </form>

            <div class="redirect-signup">
                <span>Non hai un account?</span>
                <a href="signup.php">Registrati ora</a>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 YT Music. Tutti i diritti riservati.
    </footer>
</body>
</html>
