<?php
/**
 * @var \App\Kernel\Session\SessionInterface $session ,
 * @var \App\Kernel\View\ViewInterface $view ,
 *                                     *
 */
?>

<?php $view->component('start'); ?>
    <form action="login" method="post">

        <?php if ($session->has('error')) { ?>
            <ul>
                <?php foreach ($session->getFlash('error') as $error) { ?>
                    <li style="color:red;"><?= $error ?> </li>
                <?php } ?>
            </ul>
        <?php } ?>

        <p></p><s></s><p>email</p>
        <input type="text" name="email")>

        <p></p><s></s><p>password</p>
        <input type="password" name="password")>
        <p></p>
        <button>Login</button>
    </form>

<?php $view->component('end'); ?>

