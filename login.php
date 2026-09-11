<?php require_once 'includes/header.php'; ?>

<script>Auth.redirectIfAuthenticated();</script>

<div class="card auth-card">
    <h2>Welcome Back</h2>
    <div id="errorAlert" class="alert alert-danger"></div>
    
    <form id="loginForm">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" required value="admin@marketplace.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" required value="password123">
        </div>
        <button type="submit" class="btn-primary">Sign Ixn</button>
    </form>
</div>

<script src="assets/js/login.js"></script>

<?php require_once 'includes/footer.php'; ?>