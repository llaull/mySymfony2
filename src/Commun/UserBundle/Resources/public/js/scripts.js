// DOM Preload
(function ($) {

    "use strict";
    $(document).ready(function () {

        // Responsive Menu//
        $(".responsive-menu").click(function () {
            $(".responsive-admin-menu #menu").slideToggle();
        });
        $(window).resize(function () {
            $(".responsive-admin-menu #menu").removeAttr("style");
        });

        (function multiLevelAccordion($root) {

            var $accordions = $('.accordion', $root).add($root);
            $accordions.each(function () {

                var $this = $(this);
                var $active = $('> li > a.submenu.active', $this);
                $active.next('ul').css('display', 'block');
                $active.addClass('downarrow');
                var a = $active.attr('data-id') || '';

                var $links = $this.children('li').children('a.submenu');
                $links.click(function (e) {
                    if (a !== "") {
                        $("#" + a).prev("a").removeClass("downarrow");
                        $("#" + a).slideUp("fast");
                    }
                    if (a == $(this).attr("data-id")) {
                        $("#" + $(this).attr("data-id")).slideUp("fast");
                        $(this).removeClass("downarrow");
                        a = "";
                    } else {
                        $("#" + $(this).attr("data-id")).slideDown("fast");
                        a = $(this).attr("data-id");
                        $(this).addClass("downarrow");
                    }
                    e.preventDefault();
                });
            });
        })($('#menu'));


        // Responsive Menu Adding Opened Class//

        $(".responsive-admin-menu #menu li").hover(
            function () {
                $(this).addClass("opened").siblings("li").removeClass("opened");
            },
            function () {
                $(this).removeClass("opened");
            }
        );

    });

    // ========================================================================
    //	Datatables
    // ========================================================================

    //Basic Table
    if ($('#table-0').length) {
        var oTable = $('#table-0').DataTable();
        oTable.fnSort( [ [0,'desc'] ] );
    }

    // ========================================================================
    //	modal - show entity
    // ========================================================================

    $("a.modal-show").click(function () {

        var title = $(this).data('text');
        var editId = $(this).data('id');
        var url = $(this).attr('href');
        var res="";
        var success=false;
        var data=editId;
        $.when(
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                success: function(response){
                    res=response;
                    success=true;
                },
                error:function(){
                    //handle error
                }
            })).then(function(){
                if(success)
                {
                    $('h4#myModalLabel').html(title);
                    $('div.modal-body').html(res);
                    $("#modalShow").modal("show");

                }
            });

        return false;

    });


    // ========================================================================
    //	modal - delete dans les tabledata
    // ========================================================================

    $("a.modal-delete").click(function (e) {
        e.preventDefault();
        var $link = $(this);

        bootbox.confirm({
            title: 'danger - danger - danger',
            message: 'Are you sure you want to delete this. If not, click Cancel. There is no undo!',
            buttons: {
                'cancel': {
                    label: 'Cancel',
                    className: 'btn-default pull-left'
                },
                'confirm': {
                    label: 'Delete',
                    className: 'btn-danger pull-right'
                }
            },
            callback: function (result) {
                if (result) {
                    document.location.assign($link.attr('data-href'));
                }
            }
        });
    });

    // ========================================================================
    //	Togglers
    // ========================================================================

    // toogle sidebar
    $('.left-toggler').click(function (e) {
        $(".responsive-admin-menu").toggleClass("sidebar-toggle");
        $(".content-wrapper").toggleClass("main-content-toggle-left");
        e.preventDefault();
    });

    // We should listen touch elements of touch devices
    $('.smooth-overflow').on('touchstart', function (event) {
    });

    // toogle sidebar
    $('.right-toggler').click(function (e) {
        $(".main-wrap").toggleClass("userbar-toggle");
        e.preventDefault();
    });

    // toogle chatbar
    $('.chat-toggler').click(function (e) {
        $(".chat-users-menu").toggleClass("chatbar-toggle");
        e.preventDefault();
    });

    // Toggle Chevron in Bootstrap Collapsible Panels
    $('.btn-close').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().fadeOut();
    });

    $('.btn-minmax').click(function (e) {
        e.preventDefault();
        var $target = $(this).parent().parent().next('.panel-body');
        if ($target.is(':visible')) $('i', $(this)).removeClass('fa fa-chevron-circle-up').addClass('fa fa-chevron-circle-down');
        else $('i', $(this)).removeClass('fa-chevron-circle-down').addClass('fa fa-chevron-circle-up');
        $target.slideToggle();
    });
    $('.btn-question').click(function (e) {
        e.preventDefault();
        $('#myModal').modal('show');
    });

    if ($('#megamenuCarousel').length) {
        $('#megamenuCarousel').carousel();
    }

    // ========================================================================
    //	Powerwidgets (js\vendors\powerwidgets)
    // ========================================================================

    if ($('#powerwidgets').length) {
        $('#powerwidgets').powerWidgets({
            grid: '.bootstrap-grid',
            widgets: '.powerwidget',

            localStorage: true,
            deleteSettingsKey: '#deletesettingskey-options',
            settingsKeyLabel: 'Reset settings?',
            deletePositionKey: '#deletepositionkey-options',
            positionKeyLabel: 'Reset position?',
            sortable: true,
            buttonsHidden: false,
            toggleButton: true,
            toggleClass: 'fa fa-chevron-circle-up | fa fa-chevron-circle-down',
            toggleSpeed: 200,
            onToggle: function () {
            },
            deleteButton: true,
            deleteClass: 'fa fa-times-circle',
            onDelete: function (widget) {
                $('#delete-widget').modal(); // shows the modal
                $(widget).addClass('deletethiswidget'); // ads an indicator class which we will use to find the widget
            },
            editButton: true,
            editPlaceholder: '.powerwidget-editbox',
            editClass: 'fa fa-cog | fa fa-cog',
            editSpeed: 200,
            onEdit: function () {
            },
            fullscreenButton: true,
            fullscreenClass: 'fa fa-arrows-alt | fa fa-arrows-alt',
            fullscreenDiff: 3,
            onFullscreen: function () {
            },
            buttonOrder: '%refresh% %delete% %edit% %fullscreen% %toggle%',
            opacity: 1.0,
            dragHandle: '> header',
            placeholderClass: 'powerwidget-placeholder',
            indicator: true,
            indicatorTime: 600,
            ajax: true,
            timestampPlaceholder: '.powerwidget-timestamp',
            timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
            refreshButton: true,
            refreshButtonClass: 'fa fa-refresh',
            labelError: 'Sorry but there was a error:',
            labelUpdated: 'Last Update:',
            labelRefresh: 'Refresh',
            labelDelete: 'Delete widget:',
            afterLoad: function () {
            },
            rtl: false,
            onChange: function () {
            },
            onSave: function () {
            }
        });
    }

    // Custom way to delete widgets.
    $('#trigger-deletewidget').click(function (e) {
        $('.deletethiswidget').remove(); // delete widget
        $('#delete-widget').modal('hide'); // close the modal
    });
    $('#trigger-deletewidget-reset').click(function (e) {
        $('body').find('.deletethiswidget').removeClass('deletethiswidget'); // cancel so remove indicator class
    });


    // Empty all local storage. (demo not needed)
    $('.empty-local-storage').click(function (e) {
        var $m = $('#confirm_replacer');
        if ($m.length && typeof $.fn.modal === 'function') {
            $('#bootconfirm_confirm', $m).off(clickEvent).on(clickEvent, function (e) {
                localStorage.clear();
                location.reload();
                $m.modal().hide();
            });
            $('.modal-title', $m).text("Clear all localStorage");
            $m.modal();
        } else {
            var cls = confirm("Clear all localStorage?");
            if (cls && localStorage) {
                localStorage.clear();
                location.reload();
            }
        }
        e.preventDefault();
    });

    // ========================================================================
    //	Full screen Toggle
    // ========================================================================

    $('#toggle-fullscreen').click(function () {
        screenfull.request();
    });

    // ========================================================================
    //	Lock Modal
    // ========================================================================

    $(".lockme").click(function (e) {
        e.preventDefault();
        $('#lockscreen').modal();
        $('#yesilock').click(function () {
            window.open('admin-lock.html', '_self');
            $('#lockscreen').modal('hide');
        });

    });
    // ========================================================================
    //	Scroll To Top
    // ========================================================================

    $('.smooth-overflow').on('scroll', function () {

        if ($(this).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });

    $('.scroll-top-wrapper').on('click', scrollToTop);

    function scrollToTop() {
        var verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
        var element = $('body');
        var offset = element.offset();
        var offsetTop = offset.top;
        $('.smooth-overflow').animate({
            scrollTop: offsetTop
        }, 400, 'linear');
    }

    //----------------------------------------------------------------------
    // ========================================================================
    //	Horisontal Menu (js\vendors\horisontal)
    // ========================================================================

    var menu = new cbpHorizontalSlideOutMenu(document.getElementById('cbp-hsmenu-wrapper'));


    // ========================================================================
    //	Sparklines (js\vendors\sparkline)
    // ========================================================================


    //Sparklines at Horisontal Menu//
    $('.inlinebar2').sparkline('html', {
        type: 'bar',
        barWidth: '10px',
        height: '40px',
        enableTagOptions: 'true',
        barColor: '#de5546'
    });

    $('.inlinebar').sparkline('html', {
        type: 'bar',
        barWidth: '7px',
        height: '40px',
        enableTagOptions: 'true',
        barColor: '#969fa1'
    });

    $('.stackedbar').sparkline('html', {
        type: 'bar',
        barWidth: '7px',
        height: '40px',
        enableTagOptions: 'true',
        stackedBarColor: ['#fff', '#c4c5c5'],
    });

    $('.piechart').sparkline('html', {
        type: 'pie',
        width: '40',
        height: '40',
        sliceColors: ['#fff', '#82b964', '#f87aa0', '#109618', '#a4b7bf', '#506066', '#667880', '#8ca0a8']
    });

    $('.linechart').sparkline('html', {
        type: 'line',
        width: '100',
        height: '40',
        lineColor: '#fff',
        fillColor: '#81c1d9',
        lineWidth: 3,
        spotColor: '#ffffff',
        minSpotColor: '#33383d',
        maxSpotColor: '#33383d',
        highlightSpotColor: '#a6c172',
        spotRadius: 3,
        drawNormalOnTop: false
    });


    $('.simpleline').sparkline('html', {
        type: 'line',
        width: '100',
        height: '40',
        lineColor: '#82b964',
        fillColor: false,
        lineWidth: 3,
        spotColor: '#ffffff',
        minSpotColor: '#52646c',
        maxSpotColor: '#fff',
        highlightSpotColor: '#a6c172',
        spotRadius: 3,
        drawNormalOnTop: false
    });


    //Sparklines at Tables //
    $('.table-sparkline-pie').sparkline('html', {
        type: 'pie',
        width: '30',
        height: '30',
        sliceColors: ['#f4b66d', '#993838', '#fff', '#82b964', '#66aa00', '#dd4477', '#0099c6', '#990099 ']
    });

    $('.table-sparkline-pie2').sparkline('html', {
        type: 'pie',
        width: '30',
        height: '30',
        sliceColors: ['#5bc0de', '#f0ad4e', '#f87aa0', '#58b868', '#454b52', '#dd4477', '#0099c6', '#990099 ']
    });


    $(".table-sparkline-lines").sparkline('html', {
        type: 'line',
        lineColor: '#858689',
        width: '100',
        height: '30',
        fillColor: '#8b8c8d',
        lineWidth: 3,
        spotRadius: 3,
        spotColor: '#f4b66d',
        minSpotColor: '#fff',
        maxSpotColor: '#fff',
        highlightSpotColor: '#a6c172'
    });


    //Sparklines at Search //
    $('.piechart-search').sparkline('html', {
        type: 'pie',
        width: '60',
        height: '60',
        sliceColors: ['#f87aa0', '#5bc0de', '#82b964', '#f4cc13', '#454b52', '#d24d33', '#f0ad4e']
    });


    //Sparklines at Portlet

    $('#portlet-compositeline').sparkline('html', {
        fillColor: 'rgba(167,96,154,.5)',
        spotRadius: '3',
        width: '310',
        height: '100',
        lineColor: '#a7609a',
        highlightSpotColor: '#a7609a',
        spotColor: '#a7609a',
        minSpotColor: '#a7609a',
        maxSpotColor: '#a7609a',
        lineWidth: 4,
        highlightLineColor: '#a7609a',
        changeRangeMin: 0,
        chartRangeMax: 10
    });


    // Bar + line composite charts
    $('#portlet-compositebar').sparkline('html', {
        type: 'bar',
        barWidth: '20',
        barSpacing: '5',
        width: '310',
        height: '100',
        barColor: '#5bc0de'
    });


    // Discrete charts
    $('.demo-discrete1').sparkline('html', {
        type: 'discrete',
        lineColor: '#58b868',
        xwidth: 18
    });
    $('#demo-discrete2').sparkline('html', {
        type: 'discrete',
        lineColor: '#58b868',
        thresholdColor: '#d24d33',
        thresholdValue: 4
    });


    // Tri-state charts using inline values
    $('.demo-sparktristatecols').sparkline('html', {
        type: 'tristate',
        colorMap: {
            '-2': '#5bc0de',
            '2': '#d24d33'
        },
        posBarColor: '#5bc0de',
        negBarColor: '#d24d33'
    });


    // Box plots
    $('.demo-sparkboxplot').sparkline('html', {
        type: 'box',
        boxLineColor: '#222',
        boxFillColor: '#c4c5c5',
        whiskerColor: '#222',
        outlierLineColor: '#222',
        medianColor: '#333',
        outlierFillColor: '#888'
    });


    // Box plot with specific field order
    $('.demo-boxfieldorder').sparkline('html', {
        type: 'box',
        boxLineColor: '#222',
        boxFillColor: '#c4c5c5',
        whiskerColor: '#222',
        outlierLineColor: '#222',
        medianColor: '#333',
        outlierFillColor: '#888',
        tooltipFormatFieldlist: ['med', 'lq', 'uq'],
        tooltipFormatFieldlistKey: 'field'
    });

    // Bullet charts
    $('.demo-sparkbullet').sparkline('html', {
        type: 'bullet',
        targetColor: '#d24d33',
        performanceColor: '#969fa1',
        rangeColors: ['#f4cc13', '#8960a7', '#5bc0de', '#82b964']
    });

    // Pie charts
    $('.demo-sparkpie').sparkline('html', {
        type: 'pie',
        height: '14px',
        sliceColors: ['#f87aa0', '#5bc0de', '#82b964']
    });

})(jQuery);