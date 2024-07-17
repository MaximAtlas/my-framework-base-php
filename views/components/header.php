<?php
/**
 * var \App\Kernel\Auth\AuthInterface $auth
 */
$user = $auth->user();
?>


<header>
    <h3>User: <?= $user['email ']?></h3>
    <button>logout</button>
    <hr>
</header>
</body>