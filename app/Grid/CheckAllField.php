<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 3/21/2018
 * Time: 1:48 PM
 */

namespace App\Grid;

use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\DataRowInterface;

class CheckAllField extends FieldConfig
{
    protected $selectedOptions;

    public function __construct($selectedOptions = [])
    {
        parent::__construct('id', '<a href="javascript: void(0)" id="selectAll">Select All</a>');

        $this->selectedOptions = $selectedOptions;
    }

    public function getValue(DataRowInterface $row)
    {
        if ($function = $this->getCallback()) {
            return call_user_func($function, $row->getCellValue($this), $row);
        } else {


            $value = $row->getCellValue($this);
            $checked = (in_array($value, $this->selectedOptions) ? 'checked' : '');

            return "<div><input {$checked} name='grid_items[]' type='checkbox' value='{$value}' id='grid_item_{$value}' class='filled-in grid-check-item chk-col-light-blue' />
                                <label for='grid_item_{$value}'></label></div>";
        }
    }
}