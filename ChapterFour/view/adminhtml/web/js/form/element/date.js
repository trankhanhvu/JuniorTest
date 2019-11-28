define([
    'Magento_Ui/js/form/element/date',
    'jquery',
    "mage/calendar"
], function(Date,$) {
    'use strict';

    return Date.extend({
        defaults: {
            options: {
                beforeShowDay: function(d) {
                    var day = d.getDate();
                    return [(day >= 8 && day < 12)];
                }
            },
        },
    });

});