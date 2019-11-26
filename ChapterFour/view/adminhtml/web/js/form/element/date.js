define([
    'Magento_Ui/js/form/element/date',
    'jquery',
    "mage/calendar"
], function(Date,$) {
    'use strict';

    return Date.extend({
        initialize: function () {
            this._super();


            var disableddates = ["26-11-2019", "27-11-2019"]; // assign your database dates
            function DisableSpecificDates(date) {
                var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
                return [disableddates.indexOf(string) == -1];
            }

            $("input[name$='magenest[magenst_date]']").datepicker({
                beforeShowDay: function(d) {
                    var day = d.getDate();
                    return [(day >= 8 && day < 12)];
                }
            });

            return this;
        }
    });

});