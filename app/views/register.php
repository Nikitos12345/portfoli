<?php $this->layout('layout') ?>

<?php if (isset($UserId)): ?>
    <?php var_dump($UserId, $_SESSION); ?>
<?php else: ?>
<form action="/newuser" method="post">
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" name="register">
</form>
<?php endif; ?>