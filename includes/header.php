<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Library</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/api.js"></script>
</head>

<body>

  

    <script>
        const navMenu = document.getElementById('navMenu');
        if (Auth.isAuthenticated()) {
            navMenu.innerHTML = `<button onclick="Auth.logout()">Logout</button>`;
        } else {
            navMenu.innerHTML = `<a href="login.php"><button>Login</button></a>`;
        }
    </script>
    <main class="container">