<?php

$query = $_GET;
header('Location: pages/login.php' . ($query ? '?' . http_build_query($query) : ''));
exit;
