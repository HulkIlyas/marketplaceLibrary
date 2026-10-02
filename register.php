<?php

$query = $_GET;
header('Location: pages/register.php' . ($query ? '?' . http_build_query($query) : ''));
exit;
