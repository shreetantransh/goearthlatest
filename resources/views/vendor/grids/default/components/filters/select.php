<?php
/** @var Nayjest\Grids\Components\SelectFilter $component */
?>

<div style="padding-top: 10px">
    <?php if ($component->getLabel()): ?>
        <span><?= $component->getLabel() ?></span>
    <?php endif ?>
    <div style="display: inline-block; width: 100px">
        <?=
        \Form::select(
            $component->getInputName(),
            $component->getVariants(),
            $component->getValue(),
            [
                'class' => 'form-control show-tick'
            ]
        );
        ?>
    </div>
</div>

