jQuery(function($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     */
    $('button.add_lottery_answer').on('click', function() {

        var key = $('.lotery_answers_wrapper input.lottery_answer:last').data('answer-id');
        if (typeof key == 'undefined') {
            key = 1;
        } else {
            key = parseInt(key) + 1;
        }
        var $wrapper = $('#wc_lotery_answers-tb');
        var $attributes = $wrapper.find('.answers');
        var product_type = $('select#product-type').val();
        var data = {
            action: 'woocommerce_add_lottery_answer',
            security: woocommerce_lottery_pn.add_lottery_answer_nonce,
            key: key,
        };

        $wrapper.block({
            message: null,
            overlayCSS: {
                background: '#fff',
                opacity: 0.6
            }
        });

        $.post(woocommerce_admin_meta_boxes.ajax_url, data, function(response) {
            $attributes.append(response);

            $(document.body).trigger('wc-enhanced-select-init');

            $wrapper.unblock();

            $(document.body).trigger('woocommerce_added_add_lottery_answer');
        });

        return false;
    });


    $('.lotery_answers_wrapper').on('click', '.remove_row', function() {
        if (window.confirm(woocommerce_lottery_pn.remove_wcsbs)) {
            var $parent = $(this).parent().parent();

            $parent.find('select, input').val('');
            $parent.hide();

        }
        return false;
    });
    $('button.add_lottery_instant_winner').on('click', function() {

        var key = $('.woocommerce_instant_winner_data input.lottery_instant_ticket:last').data('instant_winner-id');
        if (typeof key == 'undefined') {
            key = 1;
        } else {
            key = parseInt(key) + 1;
        }
        var $wrapper = $('#wc_lotery_instant-tb');
        var $attributes = $wrapper.find('.instant_winners');
         console.log( $attributes);
        var product_type = $('select#product-type').val();
        var data = {
            action: 'get_lottery_istant_winners_fields',
            security: woocommerce_lottery_pn.add_lottery_answer_nonce,
            key: key,
        };

        $wrapper.block({
            message: null,
            overlayCSS: {
                background: '#fff',
                opacity: 0.6
            }
        });

        $.post(woocommerce_admin_meta_boxes.ajax_url, data, function(response) {
            console.log(response);
            $attributes.append(response);

            $(document.body).trigger('wc-enhanced-select-init');

            $wrapper.unblock();

            $(document.body).trigger('woocommerce_added_add_lottery_instant_ticket');
        });

        return false;
    });


    $('#wc_lotery_instant-tb').on('click', '.remove_row', function(e) {
        e.preventDefault();
        if (window.confirm(woocommerce_lottery_pn.remove_wcsbs_instant)) {
            var $parent = $(this).parent().parent();

            $parent.find('select, input').val('');
            $parent.hide();

        }

        return false;

    });

    var columns = [
        null,
        null, {
            "visible": false
        }, {
            "visible": false
        }, {
            "visible": false
        }, {
            "visible": false
        },{
                "visible": false
            },
        null, {
            "orderable": false
        },
    ];

    if ((typeof $('#Lottery-pn .lottery-table th.answer') !== 'undefined' && $('#Lottery-pn .lottery-table th.answer').length && (typeof $('#Lottery-pn .lottery-table th.numbers') == 'undefined' || $('#Lottery-pn .lottery-table th.numbers').length == 0)) ||
        (typeof $('#Lottery-pn .lottery-table th.numbers') !== 'undefined' && $('#Lottery-pn .lottery-table th.numbers').length && (typeof $('#Lottery-pn .lottery-table th.answer') == 'undefined' || $('#Lottery-pn .lottery-table th.answer').length == 0))
    ) {
        columns = [
            null,
            null, {
                "visible": false
            }, {
                "visible": false
            }, {
                "visible": false
            }, {
                "visible": false
            },{
                "visible": false
            },
            null,
            null, {
                "orderable": false
            },
        ];
    }
    if (typeof $('#Lottery-pn .lottery-table th.answer') !== 'undefined' && $('#Lottery-pn .lottery-table th.answer').length && typeof $('#Lottery-pn .lottery-table th.numbers') !== 'undefined' && $('#Lottery-pn .lottery-table th.numbers').length) {
        columns = [
            null,
            null, {
                "visible": false
            }, {
                "visible": false
            }, {
                "visible": false
            }, {
                "visible": false
            },{
                "visible": false
            },
            null,
            null,
            null, {
                "orderable": false
            },
        ];
    }
    $('#Lottery-pn .lottery-table').DataTable({
        dom: 'lfBrtip',
        "order": [0, 'desc'],
        stateSave: true,
        "pageLength": 20,
        "columns": columns,
        responsive: true,
        buttons: [
            'colvis', {
                extend: 'csv',
                exportOptions: {
                    columns: 'th:not(:last-child)',
                    columns: ':visible'
                }
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: 'th:not(:last-child)',
                    columns: ':visible'
                }
            },

        ],
        "language": {
            "sEmptyTable": woocommerce_lottery_pn.datatable_language.sEmptyTable,
            "sInfo": woocommerce_lottery_pn.datatable_language.sInfo,
            "sInfoEmpty": woocommerce_lottery_pn.datatable_language.sInfoEmpty,
            "sInfoFiltered": woocommerce_lottery_pn.datatable_language.sInfoFiltered,
            "sLengthMenu": woocommerce_lottery_pn.datatable_language.sLengthMenu,
            "sLoadingRecords": woocommerce_lottery_pn.datatable_language.sLoadingRecords,
            "sProcessing": woocommerce_lottery_pn.datatable_language.sProcessing,
            "sSearch": woocommerce_lottery_pn.datatable_language.sSearch,
            "sZeroRecords": woocommerce_lottery_pn.datatable_language.sZeroRecords,
            "oPaginate": {
                "sFirst": woocommerce_lottery_pn.datatable_language.oPaginate.sFirst,
                "sLast": woocommerce_lottery_pn.datatable_language.oPaginate.sLast,
                "sNext": woocommerce_lottery_pn.datatable_language.oPaginate.sNext,
                "sPrevious": woocommerce_lottery_pn.datatable_language.oPaginate.sPrevious
            },
            "oAria": {
                "sSortAscending": woocommerce_lottery_pn.datatable_language.oAria.sSortAscending,
                "sSortDescending": woocommerce_lottery_pn.datatable_language.oAria.sSortDescending,
            }
        }
    });

});

jQuery(document).ready(function($) {
    if (typeof $('#_lottery_use_answers') !== 'undefined' && $('#_lottery_use_answers').is(':checked')) {
        $('#wc_lotery_answers-tb').show();
        $('.form-field._lottery_only_true_answers_field').show();
        $("#_lottery_question").prop('required', true);
    }
    if (typeof $('#_lottery_use_pick_numbers') !== 'undefined' && $('#_lottery_use_pick_numbers').length) {
        if ($('#_lottery_use_pick_numbers').is(':checked')) {
            document.getElementById("_lottery_pick_numbers_random").disabled = false;
            document.getElementById("_lottery_instant_win").disabled = false;
        } else {
            document.getElementById("_lottery_pick_numbers_random").disabled = true;
            document.getElementById("_lottery_instant_win").disabled = true;
        }
    }
    console.log( document.getElementById("_lottery_instant_win") );
    $("#_lottery_use_pick_numbers").on('change', function() {
        if (this.checked) {
            document.getElementById("_lottery_pick_numbers_random").disabled = false;
            document.getElementById("_lottery_instant_win").disabled = false;
        } else {
            document.getElementById("_lottery_pick_numbers_random").disabled = true;
            document.getElementById("_lottery_instant_win").disabled = true;
            document.getElementById("_lottery_instant_win").disabled = true;
            $('#_lottery_instant_win').prop('checked', false).trigger('change');

        }
    });

    if (typeof $('#_lottery_pick_numbers_random') !== 'undefined' && $('#_lottery_pick_numbers_random').length) {

        if ($('#_lottery_pick_numbers_random').is(':checked')) {
            document.getElementById("_lottery_pick_number_use_tabs").disabled = true;
            document.getElementById("_lottery_pick_number_tab_qty").disabled = true;
            $('._lottery_pick_number_use_tabs_field').hide();
            $('._lottery_pick_number_tab_qty_field ').hide();
        } else {
            document.getElementById("_lottery_pick_number_use_tabs").disabled = false;
            document.getElementById("_lottery_pick_number_tab_qty").disabled = false;
            $('#_lottery_pick_number_use_tabs-tb').show();
            $('._lottery_pick_number_tab_qty_field ').show();
        }
    }
    $("#_lottery_pick_numbers_random").on('change', function() {
        if (this.checked) {
            document.getElementById("_lottery_pick_number_use_tabs").disabled = true;
            document.getElementById("_lottery_pick_number_tab_qty").disabled = true;
            $('._lottery_pick_number_use_tabs_field').hide();
            $('._lottery_pick_number_tab_qty_field ').hide();
        } else {
            document.getElementById("_lottery_pick_number_use_tabs").disabled = false;
            document.getElementById("_lottery_pick_number_tab_qty").disabled = false;
            $('._lottery_pick_number_use_tabs_field').show();
            $('._lottery_pick_number_tab_qty_field ').show();
        }
    });


    $("#_lottery_use_answers").on('change', function() {
        if (this.checked) {
            $('#wc_lotery_answers-tb').slideDown('fast');
            $("#_lottery_question").prop('required', true);
            $('.form-field._lottery_only_true_answers_field').show();
        } else {
            $('#wc_lotery_answers-tb').slideUp('fast');
            $("#_lottery_question").prop('required', false);
            $('.form-field._lottery_only_true_answers_field').hide();
        }
    });

    $("#_lottery_instant_win").on('change', function() {

        if (this.checked) {
            $('.wcl_instant_box').show();
            $('#wc_lotery_instant-tb .toolbar').show();
            $('._lottery_instant_win_main_competition_field ').show();

        } else {
            $('.wcl_instant_box').hide();
            $('#wc_lotery_instant-tb .toolbar').hide();
            $('._lottery_instant_win_main_competition_field ').hide();
        }
    });

    jQuery('.lottery-files-table .action a').on('click',function(event){
        var logid = $(this).data('id');
        var postid = $(this).data('postid');
        var curent = $(this);
        jQuery.ajax({
        type : "post",
        url : ajaxurl,
        data : {action: "delete_lottery_history_csv", logid : logid, postid: postid},
        success: function(response) {
               if (response === 'deleted'){
                       curent.parent().parent().addClass('deleted').fadeOut('slow');
               }
           }
        });
        event.preventDefault();
    });
});