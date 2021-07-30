/* Validate Page3 */
$(document).ready(function(e) {
    $("[name=family]").on('click', function() {
        if ($('input[name="family"]:checked').val() == '既婚') {
            document.getElementById('children').removeAttribute("disabled");
        } else {
            document.getElementById('children').setAttribute('disabled', true);
        }
    });
});

/* Validate Page4 */
jQuery(function($) {
    if (document.forms[0].id == 'frm04') {
        (function() {
            const form = document.querySelector(".checkbox_group_social");
            const checkboxes = form.querySelectorAll('input[type=checkbox]');
            const checkboxLength = checkboxes.length;
            const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

            function init() {
                if (firstCheckbox) {
                    for (let i = 0; i < checkboxLength; i++) {
                        checkboxes[i].addEventListener('change', checkValidity);
                    }
                    checkValidity();
                }
            }

            function isChecked() {
                for (let i = 0; i < checkboxLength; i++) {
                    if (checkboxes[i].checked) return true;
                }
                return false;
            }

            function checkValidity() {
                const errorMessage = !isChecked() ? 'At least one checkbox must be selected !' : '';
                firstCheckbox.setCustomValidity(errorMessage);
            }
            init();

            $("#check_social_type").on('change', function() {
                if (this.checked) {
                    document.getElementById('other_social_type').setAttribute('required', 'required');
                } else {
                    document.getElementById('other_social_type').removeAttribute("required");
                }
            });

        })();
    }


    $('.check-js .active-social ').change(function() {  
        if ($(this).is(':checked')) {
           $('.checkbox_group_social').show();
        } 
    });

    $('.check-js .no-social').change(function() {  
        if ($(this).is(':checked')) {
            $('.checkbox_group_social').hide();   
        } 
    });



    $('.check-js .active-radio ').change(function() {  
        if ($(this).is(':checked')) {
           $('.box-ratio').show();
        } 
    });
    $('.check-js .no-radio').change(function() {  
        if ($(this).is(':checked')) {
            $('.box-ratio').hide();   
        } 
    });



});




/* Validate Page5 */
jQuery(function($) {
    if (document.forms[0].id == 'frm05') {
        (function() {
            const form = document.querySelector(".checkbox_reason_change_job");
            const checkboxes = form.querySelectorAll('input[type=checkbox]');
            const checkboxLength = checkboxes.length;
            const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

            function init() {
                if (firstCheckbox) {
                    for (let i = 0; i < checkboxLength; i++) {
                        checkboxes[i].addEventListener('change', checkValidity);
                    }
                    checkValidity();
                }
            }

            function isChecked() {
                for (let i = 0; i < checkboxLength; i++) {
                    if (checkboxes[i].checked) return true;
                }
                return false;
            }

            function checkValidity() {
                const errorMessage = !isChecked() ? 'At least one checkbox must be selected !' : '';
                firstCheckbox.setCustomValidity(errorMessage);
            }
            init();

            $("#check_social_type").on('change', function() {
                if (this.checked) {
                    document.getElementById('other_social_type').setAttribute('required', 'required');
                } else {
                    document.getElementById('other_social_type').removeAttribute("required");
                }
            });

        })();

        (function() {
            const form = document.querySelector(".checkbox_think_job");
            const checkboxes = form.querySelectorAll('input[type=checkbox]');
            const checkboxLength = checkboxes.length;
            const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

            function init() {
                if (firstCheckbox) {
                    for (let i = 0; i < checkboxLength; i++) {
                        checkboxes[i].addEventListener('change', checkValidity);
                    }
                    checkValidity();
                }
            }

            function isChecked() {
                for (let i = 0; i < checkboxLength; i++) {
                    if (checkboxes[i].checked) return true;
                }
                return false;
            }

            function checkValidity() {
                const errorMessage = !isChecked() ? 'At least one checkbox must be selected !' : '';
                firstCheckbox.setCustomValidity(errorMessage);
            }
            init();
        })();

        (function() {
            const form = document.querySelector(".checkbox_how_to_change_job");
            const checkboxes = form.querySelectorAll('input[type=checkbox]');
            const checkboxLength = checkboxes.length;
            const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

            function init() {
                if (firstCheckbox) {
                    for (let i = 0; i < checkboxLength; i++) {
                        checkboxes[i].addEventListener('change', checkValidity);
                    }
                    checkValidity();
                }
            }

            function isChecked() {
                for (let i = 0; i < checkboxLength; i++) {
                    if (checkboxes[i].checked) return true;
                }
                return false;
            }

            function checkValidity() {
                const errorMessage = !isChecked() ? 'At least one checkbox must be selected !' : '';
                firstCheckbox.setCustomValidity(errorMessage);
            }
            init();
        })();

    }
});

$(document).ready(function(e) {
    $(function() {
        let arry_number = [4, 1, 3, 2];
        $("[name='priority_job[]']").on('change', function() { // always use change event
            let minNumber = arry_number.sort();
            let setNumber = minNumber[0];
            console.log(minNumber);
            console.log(setNumber);
            if (this.checked) { // if checked
                let attrNumber = $(this).next();
                console.log(attrNumber);
                attrNumber.attr("data-number", setNumber);
                var valInput = $(this).val(),
                    getVal = setNumber + " " + valInput;
                $(this).val(getVal);

                //attrValue.attr("value", setNumber);

                arry_number.shift();
            }

            if (this.checked === "false") {
                arry_number.push(setNumber);
            }
            if (arry_number.length < 1) {
                arry_number = [4, 1, 3, 2];
            }
        });

        var order = [];
        $("[name='priority_job[]']").on('change', function() { // always use change event
            var idx = order.indexOf(this);

            if (idx !== -1) { // if already in array
                order.splice(idx, 1); // make sure we remove it
            }

            if (this.checked) { // if checked
                order.push(this); // add to end of array
            }

            // <------------------------------------For demonstration
            $('#result').html(JSON.stringify($.map(order, function(elem) {
                return $(elem).closest('label').text().trim();
            })));
        });
        /*
                $(window).bind("load", function() {
                    $(".link").attr("disabled", "disabled");
                });
        */

        $("[name=check-test]").on('change', function() {
            if (this.checked) {
                $(".link").removeAttr("disabled");
                $(".link").addClass("disabled")
            } else {
                $(".link").attr("disabled", "disabled");
                $(".link").removeClass("disabled");
            }

        });
    });
});

/* Validate Page6 */
jQuery(function($) {
    if (document.forms[0].id == 'frm06') {
        (function() {
            const form = document.querySelector(".checkbox_faq");
            const checkboxes = form.querySelectorAll('input[type=checkbox]');
            const checkboxLength = checkboxes.length;
            const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

            function init() {
                if (firstCheckbox) {
                    for (let i = 0; i < checkboxLength; i++) {
                        checkboxes[i].addEventListener('change', checkValidity);
                    }
                    checkValidity();
                }
            }

            function isChecked() {
                for (let i = 0; i < checkboxLength; i++) {
                    if (checkboxes[i].checked) return true;
                }
                return false;
            }

            function checkValidity() {
                const errorMessage = !isChecked() ? 'At least one checkbox must be selected !' : '';
                firstCheckbox.setCustomValidity(errorMessage);
            }
            init();
        })();
    }
});

/* Validate Page7 */
function validateEmail(email, confirm_email) {
    if (email.value != confirm_email.value || email.value == '' || confirm_email.value == '') {
        confirm_email.setCustomValidity('Email does not matches');
    } else {
        confirm_email.setCustomValidity('');
    }

}