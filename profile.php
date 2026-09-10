<?php require_once 'includes/header.php'; ?>

<script>Auth.requireAuth();</script>

<style>
  :root{
    --green-950:#12281a;
    --green-900:#1c3d24;
    --green-700:#2c5530;
    --green-600:#356b3b;
    --clay:#d1852f;
    --clay-dark:#b56d22;
    --cream:#faf3e6;
    --cream-deep:#f2e7d3;
    --paper:#fffdf9;
    --ink:#251d14;
    --ink-soft:#5c5142;
    --taupe:#8d8272;
    --line:#e6dcc7;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  body{
    font-family:'Karla', sans-serif;
    background:var(--cream);
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,.serif{font-family:'Fraunces', serif;}

  /* ---------- top bar ---------- */
  .topbar{
    display:flex; align-items:center; justify-content:space-between;
    padding:20px 40px;
    background:var(--green-950);
    color:var(--cream);
  }
  .brand{
    display:flex; align-items:center; gap:10px;
    font-family:'Fraunces', serif; font-weight:600; font-size:20px;
    color:var(--cream);
  }
  .brand svg{flex-shrink:0;}
  .top-actions{display:flex; align-items:center; gap:22px; font-size:14px;}
  .top-actions a{color:var(--cream-deep); text-decoration:none; opacity:.85;}
  .top-actions a:hover{opacity:1;}
  .icon-btn{
    width:36px; height:36px; border-radius:50%;
    background:rgba(250,243,230,.12);
    display:flex; align-items:center; justify-content:center;
    color:var(--cream); position:relative; cursor:pointer;
  }
  .icon-btn .dot{
    position:absolute; top:-2px; right:-2px;
    width:9px; height:9px; border-radius:50%;
    background:var(--clay); border:2px solid var(--green-950);
  }

  /* ---------- hero / cover ---------- */
  .cover{
    position:relative;
    height:150px;
    background:
      linear-gradient(180deg, rgba(18,40,26,.55), rgba(18,40,26,.72)),
      repeating-linear-gradient(90deg, #2a4a30 0 46px, #23412a 46px 92px);
    overflow:hidden;
  }
  .cover .shelf-books{
    position:absolute; bottom:0; left:0; right:0;
    display:flex; align-items:flex-end; height:100%;
    padding:0 6%;
    opacity:.5;
  }
  .cover .spine{
    width:26px; margin-right:3px; border-radius:2px 2px 0 0;
  }

  /* ---------- shell ---------- */
  .shell{
    max-width:960px;
    margin:0 auto;
    padding:0 24px 80px;
  }

  /* ---------- profile card header ---------- */
  .profile-card{
    background:var(--paper);
    border-radius:20px;
    box-shadow:0 20px 40px -18px rgba(18,40,26,.25);
    margin-top:-64px;
    padding:32px 36px 28px;
    position:relative;
    border:1px solid var(--line);
  }
  .profile-top{
    display:flex; align-items:flex-end; gap:22px; flex-wrap:wrap;
  }
  .avatar{
    width:104px; height:104px; border-radius:16px;
    background:linear-gradient(160deg, var(--clay), var(--clay-dark));
    display:flex; align-items:center; justify-content:center;
    font-family:'Fraunces', serif; font-size:38px; font-weight:600;
    color:var(--cream); flex-shrink:0;
    box-shadow:0 8px 20px -6px rgba(213,123,44,.5);
    border:4px solid var(--paper);
    margin-top:-56px;
  }
  .profile-id{flex:1; min-width:200px;}
  .profile-id h1{font-size:27px; font-weight:600; color:var(--green-950); margin-bottom:3px;}
  .profile-id .handle{color:var(--taupe); font-size:14px;}
  .badge-row{display:flex; gap:8px; margin-top:10px; flex-wrap:wrap;}
  .badge{
    font-size:12px; padding:4px 10px; border-radius:20px;
    display:flex; align-items:center; gap:5px; font-weight:600;
  }
  .badge.verified{background:#e7f2e8; color:var(--green-700);}
  .badge.top{background:#fbeada; color:var(--clay-dark);}
  .badge.member{background:var(--cream-deep); color:var(--ink-soft);}
  .edit-btn{
    padding:11px 20px; border-radius:10px;
    border:1.5px solid var(--green-700); background:transparent;
    color:var(--green-700); font-family:'Karla',sans-serif; font-weight:700; font-size:14px;
    cursor:pointer; white-space:nowrap;
  }
  .edit-btn:hover{background:var(--green-700); color:var(--cream);}

  .stat-row{
    display:grid; grid-template-columns:repeat(4,1fr);
    gap:14px; margin-top:26px;
    padding-top:24px; border-top:1px solid var(--line);
  }
  .stat{text-align:center;}
  .stat .num{font-family:'Fraunces',serif; font-size:26px; font-weight:600; color:var(--green-950);}
  .stat .lbl{font-size:12.5px; color:var(--taupe); margin-top:2px;}

  /* ---------- tabs ---------- */
  .tabs{
    display:flex; gap:6px; margin:28px 0 20px;
    border-bottom:1px solid var(--line);
  }
  .tab{
    padding:12px 18px; font-size:14.5px; font-weight:700;
    color:var(--taupe); cursor:pointer; border-bottom:2.5px solid transparent;
    display:flex; align-items:center; gap:7px;
  }
  .tab.active{color:var(--green-700); border-bottom-color:var(--clay);}

  /* ---------- section layout ---------- */
  .grid-2{display:grid; grid-template-columns:1.55fr 1fr; gap:22px;}
  .panel{
    background:var(--paper); border:1px solid var(--line); border-radius:16px;
    padding:22px 24px;
  }
  .panel h2{font-size:17px; color:var(--green-950); font-weight:600; margin-bottom:4px;}
  .panel .sub{font-size:13px; color:var(--taupe); margin-bottom:16px;}

  /* book row */
  .book-row{
    display:flex; gap:14px; align-items:center;
    padding:13px 0; border-bottom:1px solid var(--line);
  }
  .book-row:last-child{border-bottom:none;}
  .cover-mini{
    width:40px; height:56px; border-radius:3px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:10px; font-weight:700; text-align:center; padding:3px;
    font-family:'Fraunces',serif; line-height:1.15;
  }
  .book-info{flex:1; min-width:0;}
  .book-title{font-weight:700; font-size:14.5px; color:var(--ink);}
  .book-meta{font-size:12.5px; color:var(--taupe); margin-top:2px;}
  .book-status{
    font-size:11.5px; font-weight:700; padding:4px 10px; border-radius:20px; white-space:nowrap;
  }
  .status-active{background:#e7f2e8; color:var(--green-700);}
  .status-pending{background:#fdf1de; color:var(--clay-dark);}
  .status-done{background:var(--cream-deep); color:var(--ink-soft);}
  .status-due{background:#fbe6e2; color:#a8462f;}

  /* sidebar */
  .info-line{
    display:flex; justify-content:space-between; align-items:center;
    padding:11px 0; border-bottom:1px solid var(--line); font-size:14px;
  }
  .info-line:last-child{border-bottom:none;}
  .info-line .k{color:var(--taupe); display:flex; align-items:center; gap:9px;}
  .info-line .v{font-weight:700; color:var(--ink);}

  .review-item{padding:14px 0; border-bottom:1px solid var(--line);}
  .review-item:last-child{border-bottom:none;}
  .review-head{display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;}
  .stars{color:var(--clay); font-size:13px; letter-spacing:1px;}
  .review-text{font-size:13.5px; color:var(--ink-soft); line-height:1.5;}
  .review-from{font-size:12px; color:var(--taupe); margin-top:5px;}

  .genre-chip{
    display:inline-flex; padding:6px 13px; border-radius:20px;
    background:var(--cream-deep); color:var(--ink-soft);
    font-size:12.5px; font-weight:600; margin:0 8px 8px 0;
  }

  a.link-btn{
    display:block; text-align:center; margin-top:16px;
    color:var(--green-700); font-weight:700; font-size:13.5px; text-decoration:none;
  }

  /* Form styling matching design system */
  .form-field { margin-bottom:12px; }
  .form-field label { font-size:12.5px; font-weight:700; color:var(--ink-soft); display:block; margin-bottom:4px; }
  .form-field input { 
    width:100%; padding:10px 14px; border:1px solid var(--line); 
    border-radius:8px; background:var(--paper); font-family:'Karla', sans-serif;
    color:var(--ink); font-size:14px; outline:none;
  }
  .form-field input:focus { border-color:var(--clay); }

  @media (max-width:760px){
    .grid-2{grid-template-columns:1fr;}
    .stat-row{grid-template-columns:repeat(2,1fr); row-gap:18px;}
    .topbar{padding:16px 20px;}
    .profile-card{padding:24px 20px 22px;}
  }
</style>

<div class="topbar">
  <div class="brand">
    <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
      <path d="M13 4C10 2 6 2 3 3.5V19C6 17.5 10 17.5 13 19.5" stroke="#2c5530" stroke-width="1.8" stroke-linejoin="round" fill="#2c5530" fill-opacity=".9"/>
      <path d="M13 4C16 2 20 2 23 3.5V19C20 17.5 16 17.5 13 19.5" stroke="#d1852f" stroke-width="1.8" stroke-linejoin="round" fill="#d1852f" fill-opacity=".9"/>
    </svg>
    BookPlace
  </div>
  <div class="top-actions">
    <a href="#">Browse</a>
    <a href="#">Sell</a>
    <a href="#">Messages</a>
    <div class="icon-btn">
      🔔<span class="dot"></span>
    </div>
  </div>
</div>

<div class="cover">
  <div class="shelf-books">
    <div class="spine" style="height:62%;background:#3a6b41;"></div>
    <div class="spine" style="height:78%;background:#c9762e;"></div>
    <div class="spine" style="height:55%;background:#4a7350;"></div>
    <div class="spine" style="height:70%;background:#8a5a3a;"></div>
    <div class="spine" style="height:60%;background:#c9762e;"></div>
    <div class="spine" style="height:82%;background:#3a6b41;"></div>
    <div class="spine" style="height:50%;background:#6b5a45;"></div>
    <div class="spine" style="height:74%;background:#4a7350;"></div>
    <div class="spine" style="height:65%;background:#c9762e;"></div>
    <div class="spine" style="height:58%;background:#3a6b41;"></div>
    <div class="spine" style="height:80%;background:#8a5a3a;"></div>
    <div class="spine" style="height:63%;background:#4a7350;"></div>
  </div>
</div>

<div class="shell">

  <div class="profile-card">
    <div class="profile-top">
      <div class="avatar" id="userAvatar">MC</div>
      <div class="profile-id">
        <h1 id="userName">Maya Chen</h1>
        <div class="handle">@<span id="userHandle">mayareads</span> · <span id="userLocation">Marrakesh, Morocco</span></div>
        <div class="badge-row">
          <span class="badge verified">✓ Verified seller</span>
          <span class="badge top">★ Top rated</span>
          <span class="badge member">Member since 2023</span>
        </div>
      </div>
      <button class="edit-btn">Edit profile</button>
    </div>

    <div class="stat-row">
      <div class="stat"><div class="num" id="statBought">142</div><div class="lbl">Books bought</div></div>
      <div class="stat"><div class="num" id="statSold">37</div><div class="lbl">Books sold</div></div>
      <div class="stat"><div class="num" id="statRating">4.9</div><div class="lbl">Seller rating</div></div>
      <div class="stat"><div class="num" id="statOnLoan">6</div><div class="lbl">On loan</div></div>
    </div>
  </div>

  <div class="tabs">
    <div class="tab active">📚 Overview</div>
    <div class="tab">🛒 Purchases</div>
    <div class="tab">🏷️ Listings</div>
    <div class="tab">📅 Bookings</div>
    <div class="tab">🤝 Borrowed</div>
  </div>

  <div class="grid-2">

    <!-- LEFT COLUMN -->
    <div style="display:flex; flex-direction:column; gap:20px;">

      <div class="panel">
        <h2>Add New Book</h2>
        <div class="sub">Add a new book to your library catalog</div>
        <div id="bookError" style="display:none; color:#a8462f; font-size:13px; font-weight:700; margin-bottom:10px;"></div>
        <form id="addBookForm">
          <div class="form-field">
            <label for="bookTitle">Title</label>
            <input type="text" id="bookTitle" placeholder="e.g. Domain-Driven Design" required>
          </div>
          <div class="form-field">
            <label for="bookAuthor">Author</label>
            <input type="text" id="bookAuthor" placeholder="e.g. Eric Evans" required>
          </div>
          <button type="submit" class="edit-btn" style="background:var(--green-700); color:var(--cream); margin-top:6px;">Add Book</button>
        </form>
      </div>

      <div class="panel">
        <h2>Currently borrowed</h2>
        <div class="sub">Books out on loan from your shelf and to your shelf</div>

        <div class="book-row">
          <div class="cover-mini" style="background:#2c5530;">The<br>Great<br>Adventure</div>
          <div class="book-info">
            <div class="book-title">The Great Adventure</div>
            <div class="book-meta">Lent to Sofia R. · due back Sep 18</div>
          </div>
          <div class="book-status status-active">On loan</div>
        </div>

        <div class="book-row">
          <div class="cover-mini" style="background:#8a5a3a;">Learn<br>React</div>
          <div class="book-info">
            <div class="book-title">Learn React</div>
            <div class="book-meta">Borrowed from Omar K. · due Sep 12</div>
          </div>
          <div class="book-status status-due">Due soon</div>
        </div>

        <div class="book-row">
          <div class="cover-mini" style="background:#d1852f;">Design<br>Patterns</div>
          <div class="book-info">
            <div class="book-title">Design Patterns</div>
            <div class="book-meta">Borrowed from the Central Library</div>
          </div>
          <div class="book-status status-active">On loan</div>
        </div>

        <a href="#" class="link-btn">View all borrowed books →</a>
      </div>

      <div class="panel">
        <h2>Library Catalog & Listings</h2>
        <div class="sub">Books currently listed in the system</div>

        <div id="booksContainer">
          <p style="font-size:13.5px; color:var(--taupe);">Loading books...</p>
        </div>

        <a href="#" class="link-btn">Manage all listings →</a>
      </div>

      <div class="panel">
        <h2>Recent reviews</h2>
        <div class="sub">What other readers say about trading with you</div>

        <div class="review-item">
          <div class="review-head">
            <span class="stars">★★★★★</span>
          </div>
          <div class="review-text">Book arrived exactly as described, and Maya packaged it really carefully. Smooth handoff too.</div>
          <div class="review-from">— Karim B., bought Atomic Habits</div>
        </div>

        <div class="review-item">
          <div class="review-head">
            <span class="stars">★★★★★</span>
          </div>
          <div class="review-text">Returned my borrowed copy a day early and left it in great shape. Would lend to again.</div>
          <div class="review-from">— Omar K., lent Learn React</div>
        </div>
      </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div style="display:flex; flex-direction:column; gap:20px;">

      <div class="panel">
        <h2>Account details</h2>
        <div class="info-line">
          <span class="k">🆔 User ID</span>
          <span class="v" id="userId">-</span>
        </div>
        <div class="info-line">
          <span class="k">✉️ Email</span>
          <span class="v" id="userEmail">-</span>
        </div>
        <div class="info-line">
          <span class="k">📍 Location</span>
          <span class="v">Marrakesh, MA</span>
        </div>
        <div class="info-line">
          <span class="k">💳 Payout method</span>
          <span class="v">•••• 4821</span>
        </div>
        <div class="info-line">
          <span class="k">📖 Library card</span>
          <span class="v">Linked</span>
        </div>
      </div>

      <div class="panel">
        <h2>Upcoming booking</h2>
        <div class="sub">Reserved copies awaiting pickup</div>
        <div class="book-row" style="border:none; padding-top:0;">
          <div class="cover-mini" style="background:#c9762e;">Educated</div>
          <div class="book-info">
            <div class="book-title">Educated — Tara Westover</div>
            <div class="book-meta">Pickup at Gueliz branch · Sep 11, 4:00 PM</div>
          </div>
        </div>
      </div>

      <div class="panel">
        <h2>Favorite genres</h2>
        <div class="sub">Used to personalize your recommendations</div>
        <div>
          <span class="genre-chip">Literary fiction</span>
          <span class="genre-chip">Self-improvement</span>
          <span class="genre-chip">Sci-fi</span>
          <span class="genre-chip">Design & tech</span>
          <span class="genre-chip">History</span>
          <span class="genre-chip">Memoir</span>
        </div>
      </div>

      <div class="panel">
        <h2>Wallet</h2>
        <div class="info-line">
          <span class="k">Store credit</span>
          <span class="v" style="color:var(--green-700);">120.00 MAD</span>
        </div>
        <div class="info-line">
          <span class="k">Pending payout</span>
          <span class="v">85.00 MAD</span>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="assets/js/profile.js"></script>

<?php require_once 'includes/footer.php'; ?>