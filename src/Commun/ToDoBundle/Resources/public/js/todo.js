$.fn.isBound = function (type, fn) {
    var data = this.data('todos')[type];
    if (data === undefined || data.length === 0) {
        return false;
    }
    return (-1 !== $.inArray(fn, data));
};
$(document).ready(function () {
    function runBind() {

        //remove
        $('.remove').on('click', function (e) {
            var $currentListItem = $(this).closest('li');
            var $currentList = $(this).closest('ul#todo-list');
            var route = $currentList.data('deleteroute');
            var todo = $currentListItem.data('id');
            console.log(" remove -> " + todo + ' sur ' + route);

            $currentListItem = $(this).closest('li');
            $currentListItem.remove();

            // ajax add
            $.ajax({
                data: 'data=' + todo,
                cache: false,
                type: 'POST',
                url: route,
                success: function () {
                    $currentListItem.remove();
                }
            });
            //end ajax

        });

        //edit
        $('.toggle').on('click', function (e) {
            var $currentListItemLabel = $(this).closest('li').find('label');
            var $currentListItem = $(this).closest('li');
            var $currentList = $(this).closest('ul#todo-list');
            var route = $currentList.data('editroute');
            var todo = $currentListItem.data('id');
            console.log(" edit -> " + todo + ' sur ' + route);
            /*
             * Do this or add css and remove JS dynamic css.
             */
            if ($currentListItemLabel.attr('data') == 'done') {
                $currentListItemLabel.attr('data', '');
                $currentListItemLabel.css('text-decoration', 'none');
                var dataJson = '[' + '{"todo":"' + todo + '"},' + '{"done":"1"}' + ']';

                // ajax add
                $.ajax({
                    data: 'data=' + dataJson,
                    cache: false,
                    type: 'POST',
                    url: route,
                    success: function () {
                    }
                });
                //end ajax
            } else {

                $currentListItemLabel.attr('data', 'done');
                $currentListItemLabel.css('text-decoration', 'line-through');
                var dataJson = '[' + '{"todo":"' + todo + '"},' + '{"done":"0"}' + ']';

                // ajax add
                $.ajax({
                    data: 'data=' + dataJson,
                    cache: false,
                    type: 'POST',
                    url: route,
                    success: function () {
                    }
                });
                //end ajax
            }
        });
    }

    $todoList = $('#todo-list');
    $('#new-todo').keypress(function (e) {
        if (e.which === 13) {
            var route = $todoList.data('addroute');
            var todo = $('#new-todo').val();
            $('.remove').off('click');
            $('.toggle').off('click');
            var todos = $todoList.html();

            // ajax add
            $.ajax({
                data: 'data=' + todo,
                cache: false,
                type: 'POST',
                url: route,
                success: function (data) {
                    console.log(" add -> " + todo + ' sur ' + route + " d ->"+data);
                    var obj = eval('(' + data + ')');

                    todos += "" +
                    "<li data-id='" + obj.id + "'>" +
                    "<div class='view'>" +
                    "<input class='toggle' type='checkbox'>" +
                    "<label data=''>" + " " + $('#new-todo').val() + "</label>" +
                    "<a class='remove'></a>" +
                    "</div>" +
                    "</li>";
                    $(this).val('');
                    $todoList.html(todos);
                    runBind();
                    $('#taskslist').show();
                }
            });
            //end ajax
        }
    }); // end if
    $('#add-todo').click(function (e) {
        var route = $todoList.data('addroute');
        var todo = $('#new-todo').val();
        $('.remove').off('click');
        $('.toggle').off('click');
        var todos = $todoList.html();

        // ajax add
        $.ajax({
            data: 'data=' + todo,
            cache: false,
            type: 'POST',
            url: route,
            success: function (data) {
                console.log(" add -> " + todo + ' sur ' + route);
                var obj = eval('(' + data + ')');

                todos += "" +
                "<li data-id='" + obj.id + "'>" +
                "<div class='view'>" +
                "<input class='toggle' type='checkbox'>" +
                "<label data=''>" + " " + $('#new-todo').val() + "</label>" +
                "<a class='remove'></a>" +
                "</div>" +
                "</li>";
                $(this).val('');
                $todoList.html(todos);
                runBind();
                $('#taskslist').show();

            }
        });
        //end ajax

    });
    runBind();
});