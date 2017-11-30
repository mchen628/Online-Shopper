"use strict";
$(document).ready(function(){
    $("#addList").click(function(){
        $.ajax({url: "backEnd.php",
                data : {'item': $("#item").value(),'price': $("#price").value(), 'link':$("#link").value(), 'email':$("#email").text()},
                type: "POST",
            dataType: "string",
                success: function(result){

                }
        });
    });
    $("#addCart").click(function(){
        $.ajax({url: "backEnd.php",
            data : {'item': $("#item").value(),'price': $("#price").value(), 'link':$("#link").value(), 'email':$("#email").text()},
            type: "POST",
            dataType: "string",
            success: function(result){

            }
        });
    });
    $("#genLink").click(function () {
        //generate links in here
    });
});