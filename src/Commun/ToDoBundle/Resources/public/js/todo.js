$.fn.isBound = function (type, fn) {
    var data = this.data('todos')[type];
    if (data === undefined || data.length === 0) {
        return false;
    }
    return (-1 !== $.inArray(fn, data));
};
$(document).ready(function () {

    $('.toggle').on('click', function (e) {
        var $currentListItemLabel = $(this).closest('li').find('label');
        var route = $(this).data('route');
        var todo = $(this).data('id');

        if ($currentListItemLabel.attr('data') == 'done') {

            var dataJson = '[' + '{"todo":"'+todo+'"},' + '{"done":"1"}' + ']';

            $.ajax({
                data: 'data=' + dataJson,
                cache: false,
                type: 'POST',
                url: route,
                success: function (data) {
                    console.log("ok del " + data);
                    $currentListItemLabel.attr('data', '');
                    $currentListItemLabel.css('text-decoration', 'none');
                }
            });
        } else {
            var dataJson = '[' + '{"todo":"'+todo+'"},' + '{"done":"0"}' + ']';
            $.ajax({
                data: 'data=' + dataJson,
                cache: false,
                type: 'POST',
                url: route,
                success: function (data) {
                    console.log("ok del " + data);
                    $currentListItemLabel.attr('data', 'done');
                    $currentListItemLabel.css('text-decoration', 'line-through');
                }
            });
        }
    });


    $todoList = $('#todo-list');
    $('.remove').click(function (e) {
        var route = $(this).data('route');
        var todo = $(this).data('id');
        $currentListItem = $(this).closest('li');
        // ajax add
        $.ajax({
            data: 'data=' + todo,
            cache: false,
            type: 'POST',
            url: route,
            success: function (data) {
                console.log("ok del");
                $currentListItem.remove();
            }
        });
        //end ajax
    });

    $('#add-todo').click(function (e) {
        var route = $(this).data('route');
        var todo = $("#new-todo").val();
        $('.remove').off('click');
        $('.toggle').off('click');
        var todos = $todoList.html();
        todos += "" +
        "<li>" +
        "<div class='view'>" +
        "<input class='toggle' type='checkbox'>" +
        "<label data=''>" + " " + todo + "</label>" +
        "<a class='remove'></a>" +
        "</div>" +
        "</li>";
        $(this).val('');
        $todoList.html(todos);
        $('#taskslist').show();
        // ajax add
        $.ajax({
            data: 'data=' + todo,
            cache: false,
            type: 'POST',
            url: route,
            success: function (data) {
                console.log("-> " + data);
            }
        });
        //end ajax
    });
});