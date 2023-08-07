<?php

    if (isset($_COOKIE['email'])) {
        setcookie('email', '', time() - 2000);
    }
        header('Location: index.html');
?>