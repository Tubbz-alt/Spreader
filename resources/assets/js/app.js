window.jQuery = require('jquery'), window.$ = jQuery;
window.Spreader = {};
require('bootstrap');
require('bootstrap-datepicker');

Spreader = {
    site_url: '',

    init: function (data) {
        this.site_url = data['site_url'];
    }
};
