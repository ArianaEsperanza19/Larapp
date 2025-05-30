// Buscador
"use strict";
var url = "http://larapp";

$(document).ready(function () {
    $("#searcher").submit(function (e) {
        $(this).attr(
            "action",
            url + "/user/index/" + $("#searcher #search").val(),
        );
        $(this).submit();
    });
});
