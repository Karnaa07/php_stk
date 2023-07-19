<?php if (!empty($errors)): ?>
    <?php print_r($errors); ?>
<?php endif; ?>

<form method="<?= $config["config"]["method"] ?>"
      action="<?= $config["config"]["action"] ?>"
      enctype="<?= $config["config"]["enctype"] ?>"
      id="<?= $config["config"]["id"] ?>"
      class="<?= $config["config"]["class"] ?>">

    <?php foreach ($config["inputs"] as $name => $configInput): ?>
        <label for="<?= $name ?>"><?= $configInput["label"] ?></label>
        <input name="<?= $name ?>"
               placeholder="<?= $configInput["placeholder"] ?>"
               class="<?= $configInput["class"] ?>"
               id="<?= $name ?>"
               type="<?= $configInput["type"] ?>"
                <?php if (isset($configValues[$name])): ?>
                    value="<?= $configValues[$name] ?>"
                <?php endif; ?>

               <?= $configInput["required"] ? "required" : "" ?>><br>
    <?php endforeach; ?>



    <?php if ($_SERVER['REQUEST_URI'] === '/login'): ?>
        <a href="reset_password_email" class="forgot-password-link">
            Mot de passe oublié ?
        </a>
    <?php endif; ?>

    <!-- <?php if ($formErrors): ?>
        <?php foreach ($formErrors as $error): ?>
            <div class="text-danger">
                <?= $error ?>
            </div>  
        <?php endforeach; ?>
    <?php endif; ?> -->

    <input type="submit" name="submit" class="form-submit" value="<?= $config["config"]["submit"] ?>">

    <?php if ($_SERVER['REQUEST_URI'] === '/login'): ?>
        <input type="button" class="form-submit" value="<?= $config["config"]["not-register"] ?>" onclick="window.location.href = '/register'">
    <?php endif; ?>

    <input type="reset" class="form-reset" value="<?= $config["config"]["reset"] ?>">

</form>
