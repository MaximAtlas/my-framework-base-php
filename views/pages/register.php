<?php
/**
 * @var \App\Kernel\Session\SessionInterface $session ,
 * @var \App\Kernel\View\ViewInterface $view ,
 *                                     *
 */
?>

<?php $view->component('start'); ?>
<form action="register" method="post">
    <p></p> <s></s><p>email</p>
    <input type="text" name="email">
    <?php if ($session->has('email')) { ?>
        <ul>
            <?php foreach ($session->getFlash('email') as $error) { ?>
                <li style="color:red;"><?= $error ?> </li>
            <?php } ?>
        </ul>
    <?php } ?>
    <p></p><s></s><p>password</p>
    <input type="password" name="password")>
    <p></p>
    <?php if ($session->has('password')) { ?>
        <ul>
            <?php foreach ($session->getFlash('password') as $error) { ?>
                <li style="color:red;"><?= $error ?> </li>
            <?php } ?>
        </ul>
    <?php } ?>
    <button>Register</button>
</form>

<?php $view->component('end'); ?>
