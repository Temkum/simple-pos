<?php

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// session_destroy();
// session_regenerate_id();

redirect('login');
