<?php
/** @var Nayjest\Grids\Components\Filter $component */
?>
<?php if ($component->getLabel()): ?>
    <span><?= $component->getLabel() ?></span>
<?php endif ?>

<div class="form-group">
    <div class="form-line">
        <input
                class="form-control"
                type="text"
                name="<?= $component->getInputName() ?>"
                value="<?= $component->getValue() ?>"
        >
    </div>

</div>

