<?php

namespace App\Providers;
namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.*', function ($view) {
            $view->with('_admin', auth('admin')->user());
        });

        view()->composer('*', function ($view) {
            $categories = Category::active()->addToMenu()->get();
            $view->with('_categories', $categories);
        });

        Schema::defaultStringLength(191);

        \Form::macro('materialText', function ($label, $name, $value, $error, $options = []) {

            ob_start();

            ?>
            <div class="form-line<?php echo $error ? ' error' : '' ?>">
                <?php echo \Form::label($name, $label) ?>
                <?php echo \Form::text($name, $value, array_merge(['class' => 'form-control'], $options)) ?>
            </div>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialPriceText', function ($label, $name, $value, $error, $options = []) {

            ob_start();

            ?>
            <div class="form-line<?php echo $error ? ' error' : '' ?>">
                <?php echo \Form::label($name, $label) ?>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <?php echo \Form::text($name, $value, array_merge(['class' => 'form-control'], $options)) ?>
                </div>
            </div>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialTextArea', function ($label, $name, $value, $error, $options = []) {

            ob_start();

            ?>
            <div class="form-line<?php echo $error ? ' error' : '' ?>">
                <?php echo \Form::label($name, $label) ?>
                <?php echo \Form::textarea($name, $value, array_merge(['class' => 'form-control'], $options)) ?>
            </div>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialSelect', function ($label, $name, $selectOptions, $value, $error, $options = []) {

            ob_start();

            ?>
            <?php echo \Form::label($name, $label) ?>
            <?php echo \Form::select($name, $selectOptions, $value, array_merge(['class' => 'form-control show-tick'], $options)) ?>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });


        \Form::macro('materialCheckbox', function ($label, $name, $optionsValues, $value, $error, $options = []) {

            ob_start();

            foreach ($optionsValues as $key => $option):

                echo \Form::checkbox($name, $key, $key == $value ? true : false, ['id' => $key]);

                echo \Form::label($key, $option);

            endforeach;

            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialRadio', function ($label, $name, $optionsValues, $value, $error, $options = []) {

            ob_start();

            foreach ($optionsValues as $key => $option):

                echo \Form::radio($name, $key, $key == $value ? true : false, ['id' => $key]);

                echo \Form::label($key, $option);

            endforeach;


            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialBoolean', function ($label, $name, $value = TRUE, $error, $options = []) {

            ob_start();

            ?>
            <?php echo \Form::label($name, $label) ?>
            <?php echo \Form::select($name, array('' => '- Please Select -', TRUE => 'Yes', FALSE => 'No'), $value, array_merge(['class' => 'form-control show-tick'], $options)) ?>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });

        \Form::macro('materialFile', function ($label, $name, $error) {

            ob_start();

            ?>
            <?php echo \Form::label($name, $label) ?>
            <?php echo \Form::file($name) ?>

            <?php
            echo !empty($error) ? '<label for="' . $name . '" class="error">' . $error . '</label>' : '';

            return ob_get_clean();
        });


        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Contain at least one uppercase/lowercase letters, one number and one special char
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', (string)$value);
        }, 'Password Contain at least one uppercase/lowercase letters, one number and one special char');

        Validator::extend('max_upload', function ($attribute, $value, $parameters, $validator) {

            $validator->addReplacer('max_upload', function ($message, $attribute, $rule, $parameters) {
                return str_replace([':max'], $parameters[1], $message);
            });

            return (count($value) <= $parameters[1]) ? true : false;

        });


        \Blade::if ('customer', function () {
            return auth('customer')->check();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
