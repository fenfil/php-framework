$(document).ready(function() {
    console.log('Loaded');

    $.post(
        '/test',
        {id: 10},
        function (result, status) {
            console.log(status);
        }
    );
});