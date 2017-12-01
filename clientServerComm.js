"use strict";
$(document).ready(function(){
    $("#addList").click(function(){/*
        $.ajax({url: 'addToDataBase.php',
                data : {item: $("#item").value(),price: $("#price").value(), link:$("#link").value(), email:$("#email").text()},
                error: function(){
                    alert(textStatus, errorThrown);
                },
                dataType: 'text',
                success: function(result){
                    alert("in here");
                    alert(result);
                },
                type: 'POST'
        });*/
        $.ajax({
            url: 'addToDataBase.php',
            data: {
                item: $("#item").val(),price: $("#price").val(), link:$("#link").val(), email:$("#email").text(), table:"wishlist"
            },
            error: function() {
                alert("an error has occured");
            },
            dataType: 'text',
            success: function(data) {
                alert(data);
                let split = data.split(',');
                let item = "<div class=\"row\">" +
                                "<div class=\"col-sm-3\">" +
                                    "<input type=\"checkbox\">" +
                                "</div>" +
                                "<div class=\"col-sm-5\">" + split[0] + 
                                "</div>" +
                                "<div class=\"col-sm-4\">" +
                                    "<span style=\"font-size: .75em; float: left\">$" + split[1] + "</span>" +
                                    "<img src=\"delete.jpg\" width=\"15\" height=\"15\" alt=\"delete\" id=\"delete\">" +
                                "</div>" +
                            "</div>";
                document.getElementById("wish").innerHTML += item ;
            },
            type: 'POST'
        });
    });
    $("#addCart").click(function(){
        $.ajax({
            url: 'addToDataBase.php',
            data: {
                item: $("#item").val(),price: $("#price").val(), link:$("#link").val(), email:$("#email").text(), table:"cartlist"
            },
            error: function() {
                alert("an error has occured");
            },
            dataType: 'text',
            success: function(data) {
                let split = data.split(',');
                let item = "<div class=\"row\">" +
                                "<div class=\"col-sm-3\">" +
                                    "<input type=\"checkbox\">" +
                                "</div>" +
                                "<div class=\"col-sm-5\">" + split[0] + 
                                "</div>" +
                                "<div class=\"col-sm-4\">" +
                                    "<span style=\"font-size: .75em; float: left\">$" + split[1] + "</span>" +
                                    "<img src=\"delete.jpg\" width=\"15\" height=\"15\" alt=\"delete\" id=\"delete\">" +
                                "</div>" +
                            "</div>";
                document.getElementById("cart").innerHTML += item ;
            },
            type: 'POST'
        });
    });
    $("#genLink").click(function () {
        //generate links in here
    });
});