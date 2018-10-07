module.exports = {
    show: () => {
        $('#loader').css('display', 'flex');
    },
    hide: () => {
        $('#loader').css('display', 'none');
    }
};