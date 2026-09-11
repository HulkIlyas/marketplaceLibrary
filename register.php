<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/register.css">

<div style="max-width: 420px; margin: 60px auto;">
    <div class="card">
        <h2 style="text-align:center;">Create your account</h2>
        <div id="alert-message"></div>

        <form id="register-form" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-input" type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-input" type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <p style="text-align:center; margin-top: var(--space-md); font-size: var(--text-sm); color: var(--color-text-muted);">
            Already have an account? <a href="login.php" style="color: var(--color-primary);">Login</a>
        </p>
    </div>
</div>

<script src="assets/js/register.js"></script>