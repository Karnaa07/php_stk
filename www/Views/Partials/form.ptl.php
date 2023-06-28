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
               <?= $configInput["required"] ? "required" : "" ?>><br>

    <?php endforeach; ?>

    <input type="submit" name="submit" class="form-submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" class="form-reset" value="<?= $config["config"]["reset"] ?>">

</form>
