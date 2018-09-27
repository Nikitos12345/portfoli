<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="<?= User::LOGIN?>" style="display: block; margin: 10px 0; " placeholder="Name">
    <input type="password" name="<?= User::PASSWORD?>" style="display: block; margin: 10px 0;" placeholder="******">
    <input type="email" name="<?= User::EMAIL?>" placeholder="You email">
    <input type="submit" name="register" style="display: block; margin: 10px 0;" value="Зарегистрироваться">
</form>