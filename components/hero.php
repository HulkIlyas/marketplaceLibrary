<section class="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <span class="hero-subtitle">BOOKS DESERVE A SECOND CHAPTER</span>

            <h1>
                Give books
                <span>a second life.</span>
            </h1>

            <p>Buy, sell and exchange beloved books with readers in your community.</p>

            <div class="hero-buttons">
                <a href="<?= htmlspecialchars($basePath ?? '') ?>pages/books.php" class="btn btn-primary">
                    Explore Books
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="<?= htmlspecialchars($basePath ?? '') ?>profile.php#sell" class="btn btn-secondary">Sell Your Books</a>
            </div>
        </div>

        <div class="hero-image">
            <img
                class="hero-photo"
                src="<?= htmlspecialchars($basePath ?? '') ?>assets/images/hero/hero-reading-room.webp"
                alt="A cozy independent bookstore reading room"
                width="1400"
                height="933"
                fetchpriority="high"
            />
            <div class="hero-market-badge">
                <i class="fa-solid fa-arrows-rotate"></i>
                Buy · Sell · Exchange
            </div>
            <div class="hero-note">
                <i class="fa-solid fa-heart"></i>
                <strong>10k+</strong>
                <small>books waiting</small>
            </div>
        </div>

        <div class="hero-proof">
            <span>
                <strong>10k+</strong>
                listings
            </span>
            <span>
                <strong>500+</strong>
                readers
            </span>
            <span>
                <strong>3 ways</strong>
                to discover
            </span>
        </div>
    </div>
</section>
