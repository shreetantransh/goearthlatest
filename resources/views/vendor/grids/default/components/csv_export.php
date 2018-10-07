<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 *
 * @var $grid Nayjest\Grids\Grid
 */
use Nayjest\Grids\Components\CsvExport;
?>
<span>
    <a
        href="<?= $grid
            ->getInputProcessor()
            ->getUrl([CsvExport::INPUT_PARAM => 1])
        ?>"
        class="btn btn-sm btn-default"
        >
        <i class="material-icons">call_made</i>
        <span>CSV Export</span>
    </a>
</span>
