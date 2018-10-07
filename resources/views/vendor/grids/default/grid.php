<?php if ($data->count() > 0 || request($grid->getConfig()->getName())) : ?>
    <form>
        <?php
        /** @var Nayjest\Grids\DataProvider $data * */
        /** @var Nayjest\Grids\Grid $grid * */
        ?>

        <div class="body table-responsive ">
            <table class="table table-hover" id="<?= $grid->getConfig()->getName() ?>">
                <?= $grid->header() ? $grid->header()->render() : '' ?>

                <?php # ========== TABLE BODY ========== ?>
                <tbody>
                <?php while ($row = $data->getRow()): ?>
                    <?= $grid->getConfig()->getRowComponent()->setDataRow($row)->render() ?>
                <?php endwhile; ?>

                <?php if ($data->count() < 1 && request($grid->getConfig()->getName())) : ?>
                    <tr>
                        <td colspan="40">
                            <div style="margin-bottom: 0" class="alert alert-info">Sorry! No match found.</div>
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
                <?= $grid->footer() ? $grid->footer()->render() : '' ?>
            </table>
        </div>

        <?php # Hidden input for submitting form by pressing enter if there are no other submits ?>
        <input type="submit" style="display: none;"/>

        <script type="text/javascript">

            jQuery(document).ready(function () {

                var toggle = false;

                jQuery('a#selectAll').on('click', function () {

                    toggle = !toggle;

                    var table = $(this).closest('table');

                    table.find('tbody tr').each(function () {
                        $(this).find('.grid-check-item').prop('checked', toggle);
                    });
                });
            });

        </script>
    </form>
<?php else : ?>
    <div class="body">
        <div style="margin-bottom: 0" class="alert alert-info">There are no items available to display in this section.</div>
    </div>
<?php endif ?>

