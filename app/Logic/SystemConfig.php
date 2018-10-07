<?php
/**
 * Created by PhpStorm.
 * Customer: Kamlesh
 * Date: 11/4/2017
 * Time: 11:33 AM
 */

namespace App\Logic;

use Illuminate\Http\Request;
use App\Models\SystemConfig as SystemConfigModel;

class SystemConfig
{
    /* Option Group Names */
    const OPTION_GROUP_WEB = 'web';
    const OPTION_GROUP_AUCTION = 'auction';

    /* Option Group Fields */
    const OPTION_CONFIG_ADMIN_COMMISSION = 'admin_commission';


    /* Table fields */
    const OPTION_NAME_FIELD = 'option_name';
    const OPTION_VALUE_FILED = 'option_value';

    protected static $configOptionGroup = [
        self::OPTION_GROUP_WEB => [
            self::OPTION_CONFIG_FRONT_PAGE
        ],
        self::OPTION_GROUP_AUCTION => [
            self::OPTION_CONFIG_ADMIN_COMMISSION
        ]
    ];

    public static function getOption($optionName, $default = null)
    {
        if ($value = optional(SystemConfigModel::where(self::OPTION_NAME_FIELD, $optionName)->first())->{self::OPTION_VALUE_FILED}) {
            return $value;
        } else if ($default) {
            return $default;
        } else if ($value = self::getDefaultConfig($optionName)) {
            return $value;
        } else {
            return null;
        }
    }

    public static function getDefaultConfig($optionName)
    {
        return config('config.' . $optionName) ?: null;
    }

    public static function getOptionGroup($optionGroupName)
    {
        $optionSource = SystemConfigModel::whereIn(self::OPTION_NAME_FIELD, self::getOptionGroupFiled($optionGroupName))
            ->pluck(self::OPTION_VALUE_FILED, self::OPTION_NAME_FIELD)->toArray();

        $options = new \stdClass();

        foreach (self::getOptionGroupFiled($optionGroupName) as $optionName) {
            $options->{$optionName} = isset($optionSource[$optionName]) ? $optionSource[$optionName] : self::getDefaultConfig($optionName);
        }

        return $options;
    }


    public static function saveOption($optionName, $optionValue)
    {
        $option = SystemConfigModel::firstOrNew([
            self::OPTION_NAME_FIELD => $optionName
        ]);

        $option->option_value = $optionValue;
        $option->save();

        return $option;
    }

    public static function saveGroupOptions(Request $request, $optionGroupName)
    {
        $optionFields = self::getOptionGroupFiled($optionGroupName);

        \DB::beginTransaction();

        foreach ($optionFields as $field) {
            self::saveOption(
                $field,
                $request->input($field) ?: ''
            );
        }

        \DB::commit();

        return true;
    }

    public static function getOptionGroupFiled($optionGroupName)
    {
        return isset(self::$configOptionGroup[$optionGroupName]) ? self::$configOptionGroup[$optionGroupName] : [];
    }
}