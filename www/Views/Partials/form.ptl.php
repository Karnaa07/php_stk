<?php if(!empty($errors)): ?>
<?php print_r($errors);?>
<?php endif;?>


<form method="<?= $config["config"]["method"] ?>"
      action="<?= $config["config"]["action"] ?>"
      enctype="<?= $config["config"]["enctype"] ?>"
      id="<?= $config["config"]["id"] ?>"
      class="<?= $config["config"]["class"] ?>">

    <?php foreach ($config["inputs"] as $name=>$configInput): ?>

        <input
                name="<?= $name ?>"
                placeholder="<?= $configInput["placeholder"] ?>"
                class="<?= $configInput["class"] ?>"
                id="<?= $configInput["placeholder"] ?>"
                type="<?= $configInput["type"] ?>"
                <?= $configInput["required"]?"required":"" ?>
         ><br>

    <?php endforeach;?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" value="<?= $config["config"]["reset"] ?>">

</form>