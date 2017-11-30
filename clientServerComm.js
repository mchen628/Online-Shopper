"use strict";
$(document).ready(function(){
    $("#addList").click(function(){/*
        $.ajax({url: 'backEnd.php',
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
            url: 'backEnd.php',
            data: {
                item: $("#item").val(),price: $("#price").val(), link:$("#link").val(), email:$("#email").text(), table:"wishlist"
            },
            error: function() {
                alert("an error has occured");
            },
            dataType: 'text',
            success: function(data) {
                alert(data);
            },
            type: 'POST'
        });
    });
    $("#addCart").click(function(){
        $.ajax({
            url: 'backEnd.php',
            data: {
                item: $("#item").val(),price: $("#price").val(), link:$("#link").val(), email:$("#email").text(), table:"cartlist"
            },
            error: function() {
                alert("an error has occured");
            },
            dataType: 'text',
            success: function(data) {
                alert(data);
            },
            type: 'POST'
        });
    });
    $("#genLink").click(function () {
        //generate links in here
    });
});