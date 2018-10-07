<div style="display: inline-block; width: 100px; padding-top: 3px; vertical-align: top">
    <?php
    /** @var Nayjest\Grids\Components\RecordsPerPage $component */
    echo \Form::select(
        $component->getInputName(),
        $component->getVariants(),
        $component->getValue(),
        [
            'class' => "form-control show-tick grids-control-records-per-page",
            'style' => ''
        ]
    );
    ?>
</div>
