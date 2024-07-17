<?php
/**
 * @var \App\Kernel\Session\SessionInterface $session,
 * @var \App\Kernel\View\ViewInterface $view,
 */
?>


<?php $view->component('start'); ?>

    <h1> Add movie page </h1>

<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <input type="text" name="name">
    </div>
    <?php if ($session->has('name')) { ?>
    <ul>
        <?php foreach ($session->getFlash('name') as $error) { ?>
        <li style="color:red;"><?= $error ?> </li>
        <?php } ?>
    </ul>
    <?php } ?>


    <div>
        <button>add</button>
    </div>
</form>
<?php $view->component('end'); ?>

