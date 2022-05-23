(function($) {
    'use strict';
    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practice to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practicing this, we should strive to set a better example in our own work.
     */

    $(document).ready(function() {

        $("#CeDiD").mask("****-****-****");

        $(".cevalidate").click(function() {
            // Calculate validation date/time to display
            var now = new Date();
            var dateToPrint = now.toUTCString();

            // Retrieve parameters from page to call API
            var ceDiD = $("#CeDiD").val();

            // Call Validation API
            $.ajax({
                url: cevalidationsr.ajax_url,
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
                dataType: "json",
                data: {
                    'ceDiD': ceDiD,
                    'action': 'public_validate_function'
                },
                success: function(result) {
                    if (result.result_table.length === 0) {
                        $('#result_table').html('');
                        $('#scholarrecord_result').html('');
                        $('#successfail_result').html(neutralReponse);
                    } else {
                        $('#result_table').html(result.result_table);
                        $('#scholarrecord_result').html(result.scholarrecord_result);
                        $('#successfail_result').html(result.successfail_result + dateToPrint);
                    }
                },
                error: function() {
                    $('#result_table').html('');
                    $('#scholarrecord_result').html('');
                    $('#successfail_result').html(neutralReponse());
                }
            });
        })
    });

    function neutralReponse() {
        return '<div class="well"><ul>' +
            '<li>We cannot validate the Credential at this time.</li>' +
            '<li>The information provided does not match the information on record, or there was a connection error.</li>' +
            '<li>Please contact your institution for assistance. Please provide the student name and CeDiD.</li>' +
            '</ul></div>';
    }

})(jQuery);