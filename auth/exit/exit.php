<?php
    setcookie('name', $user['name'], time() - 3600 * 24, "/");
    setcookie('user_id', $user['id'], time() - 3600 * 24, "/");
    header ("Location: /");
?>