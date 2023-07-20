<?php if (!empty($errors)) : ?>
    <?php print_r($errors); ?>
<?php endif; ?>

<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>" id="<?= $config["config"]["id"] ?>" class="<?= $config["config"]["class"] ?>">

    <?php foreach ($config["inputs"] as $name => $configInput) : ?>
        <label for="<?= $name ?>"><?= $configInput["label"] ?></label>

        <?php if ($name === "role" && $configInput["type"] === "select") : ?>
            <select name="<?= $name ?>" id="<?= $configInput["id"] ?>" class="<?= $configInput["class"] ?>" <?= $configInput["required"] ? "required" : "" ?>>
                <?php foreach ($configInput["options"] as $value => $label) : ?>
                    <option value="<?= $value ?>" <?= isset($configValues[$name]) && $configValues[$name] === $value ? "selected" : "" ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php elseif ($configInput["type"] === "textarea") : ?>
            <textarea name="<?= $name ?>" rows="5" cols="33" placeholder="<?= $configInput["placeholder"] ?? "" ?>" id="<?= $configInput["id"] ?? "" ?>" class="<?= $configInput["class"] ?? "" ?>" <?= $configInput["required"] ? "required" : "" ?>>
            <?php if (isset($configValues[$name])) : ?>
                <?= $configValues[$name] ?>
            <?php endif; ?>
        </textarea>
        <?php else : ?>
            <input name="<?= $name ?>" placeholder="<?= $configInput["placeholder"] ?>" class="<?= $configInput["class"] ?>" id="<?= $name ?>" type="<?= $configInput["type"] ?>" <?= $configInput["required"] ? "required" : "" ?> <?php if (isset($configValues[$name])) : ?> value="<?= $configValues[$name] ?>" <?php endif; ?>>
        <?php endif; ?>

        <br>
    <?php endforeach; ?>

    <?php if ($_SERVER['REQUEST_URI'] === '/login') : ?>
        <a href="reset_password_email" class="forgot-password-link">
            Mot de passe oublié ?
        </a>
    <?php endif; ?>

    <input type="submit" name="submit" class="form-submit" value="<?= $config["config"]["submit"] ?>">

    <?php if ($_SERVER['REQUEST_URI'] === '/login') : ?>
        <input type="button" class="form-submit" value="<?= $config["config"]["not-register"] ?>" onclick="window.location.href = '/register'">
    <?php endif; ?>

    <input type="reset" class="form-reset" value="<?= $config["config"]["reset"] ?>">

</form>