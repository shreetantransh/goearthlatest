<?php
/** @var Nayjest\Grids\Filter $filter */
?>

<div class="form-group" style="margin-bottom: 0">
    <div class="form-line">
        <input
                placeholder="Search for <?= $filter->getConfig()->getColumn()->getLabel() ?>"
                class="form-control"
                name="<?= $filter->getInputName() ?>"
                value="<?= $filter->getValue() ?>"
        />

    </div>
</div>
<?php if ($label): ?>
    <span><?= $label ?></span>
<?php endif ?>