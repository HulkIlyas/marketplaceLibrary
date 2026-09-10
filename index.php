<?php require_once 'includes/header.php'; ?>
<script>
    if (Auth.isAuthenticated()) {
        window.location.href = 'profile.php';
    } else {
        window.location.href = 'login.php';
    }
</script>
<?php require_once 'includes/footer.php'; ?>