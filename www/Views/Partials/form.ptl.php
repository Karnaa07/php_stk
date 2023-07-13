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

        <?php if ($configInput["type"] === "textarea"): ?>
            <textarea 
                name="<?= $name?>" 
                rows = "5" 
                cols = "33"
                placeholder="<?= $configInput["placeholder"]??"" ?>"
                id="<?= $configInput["id"]??"" ?>"
                class="<?= $configInput["class"]??"" ?>" >
            </textarea>
        <?php else: ?>
            <input name="<?= $name ?>"
                placeholder="<?= $configInput["placeholder"] ?>"
                class="<?= $configInput["class"] ?>"
                id="<?= $name ?>"
                type="<?= $configInput["type"] ?>"
                <?= $configInput["required"] ? "required" : "" ?>><br>
        <br>
        <?php endif; ?>


    <?php endforeach; ?>

    <?php if ($_SERVER['REQUEST_URI'] === '/login'): ?>
        <a href="/forgot_password" class="forgot-password-link">
            Mot de passe oublié ?
        </a>
    <?php endif; ?>

    <input type="submit" name="submit" class="form-submit" value="<?= $config["config"]["submit"] ?>">

    <?php if ($_SERVER['REQUEST_URI'] === '/login'): ?>
        <input type="button" class="form-submit" value="<?= $config["config"]["not-register"] ?>" onclick="window.location.href = '/register'">
    <?php endif; ?>

    <input type="reset" class="form-reset" value="<?= $config["config"]["reset"] ?>">

</form>
