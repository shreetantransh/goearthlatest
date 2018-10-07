import jQuery from 'jquery';

class FormError {

    constructor(form) {
        this.form = form;

        console.log(this.form);
    }

    show = ({message, errors: errorBundle}) => {

        jQuery.map(errorBundle, (errors, input) => {
            this.render(input, errors[0]);
        });
    }

    reset = () => {

        this.form.find('label.error').each(() => {
            jQuery(this).remove();
        });
    }

    getErrorLabel(input, message) {
        return ('<label id="' + input + '-error" class="error" for="' + input + '">' + message + '</label>');
    }

    render = (input, error) => {

        var inputObject = this.form.find(`[name='${input}']`);

        //console.log(this.form);

        //console.log(inputObject);

        if (inputObject.length < 1) return false;

        if(inputObject.attr('type') == 'radio')
        {
            inputObject.last().after(this.getErrorLabel(input, error));
        }else {
            inputObject.after(this.getErrorLabel(input, error));
        }


    }
}

export default FormError;