"use strict";
$(document).ready(function(){
    $("#addList").click(function(){

        if($("#item").val() != ""){
            if($("#price").val() == "" || ($("#price").val() != "" && $("#price").val() >= 0)){
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

                        let split = data.split(',');
                        let item = "<ul class=\"row\" style='list-style: none; padding: 0; margin: 0;position: relative;'>" +
                            "<li class=\"col-sm-3\">" +

                            "<li class=\"col-sm-5\" id='itemName'>" + split[0] +
                            "</li>" +
                            "<li class=\"col-sm-4\">" +
                            "<span style=\"font-size: .75em; float: left\">$" + split[1] + "</span>" +
                            "<input type=\"image\" src=\"delete.jpg\"  width=\"15\" height=\"15\" id=\"delete\"/>" +
                            "</li>" +

                            "</ul>";
                        document.getElementById("wish").innerHTML += item ;
                    },
                    type: 'POST'
                });
                location.reload();
            }
            else {
                alert("Price cannot be negative.");
            }
        }else{
            alert("Item name cannot be empty.");
        }

    });
    $("#addCart").click(function(){
        if($("#item").val() != ""){
            if($("#price").val() == "" || ($("#price").val() != "" && $("#price").val() >= 0)){
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
                        let item = "<ul class=\"row\" style='list-style: none; padding: 0; margin: 0;position: relative;'>" +
                            "<li class=\"col-sm-3\">" +

                            "<li class=\"col-sm-5\">" + split[0] +
                            "</li>" +
                            "<li class=\"col-sm-4\">" +
                            "<span style=\"font-size: .75em; float: left\">$" + split[1] + "</span>" +
                            "<button style=\"background-image:url('delete.jpg');width:17px; height:17px; background-size: 14px 14px;\"></button>" +
                            "</li>" +

                            "</ul>";
                        document.getElementById("cart").innerHTML += item ;

                    },
                    type: 'POST'
                });
                location.reload();
            }else{
                alert("Price cannot be negative.");
            }
        }else {
            alert("Item name cannot be empty.");
        }


    });
    $("#genLink").click(function () {

        let itemName = $("#item").val();
        if(itemName != ""){
            let link = "";
            document.getElementById("links").innerHTML = "";
            link += "" + "For " + itemName + "<br>" +
                "<a href=\"https://www.amazon.com/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords="
                + itemName + "\"" +"target=\"_blank\">Amazon</a>" + "<br>" +
                "<a href=\"https://www.ebay.com/sch/i.html?_from=R40&_trksid=p2323847.m570.l1313.TR12.TRC2.A0.H0.Xiphone.TRS0&_nkw=" +
                itemName + "&_sacat=0\"" + "target=\"_blank\">eBay</a>" + "<br>" +
                "<a href=\"https://www.etsy.com/search?q=" + itemName + "\"" +"target=\"_blank\">Etsy</a>" + "<br>" +
                "<a href=\"https://www.newegg.com/Product/ProductList.aspx?Submit=ENE&DEPA=0&Order=BESTMATCH&Description=" +
                itemName + "&N=-1&isNodeId=1\"" + "target=\"_blank\">newegg</a>" + "<br>" +
                "<a href=\"https://www.bonanza.com/items/search?q[catalog_id]=&q[country_to_filter]=US&q[filter_category_id]=&q[in_booth_id]=&q[ship_country]=1&q[shipping_in_price]=0&q[sort_by]=relevancy&q[suggestion_found]=&q[translate_term]=true&q[search_term]="
                + itemName + "\"" + "target=\"_blank\">Bonanza</a>" + "<br>" +
                "<a href=\"https://www.ebid.net/us/perl/main.cgi?go=1&mo=search&category=&type=keyword&words=" +
                itemName + "&categoryid=\"" + "target=\"_blank\">eBid</a>" + "<br>" +
                "<a href=\"https://www.rubylane.com/search?q=" + itemName + "\"" +"target=\"_blank\">rubyLane</a>" + "<br>" +
                "<a href=\"https://www.ecrater.com/filter.php?keywords=" + itemName + "\"" +"target=\"_blank\">eCrater</a>" + "<br>" +
                "<a href=\"http://www.alibaba.com/trade/search?fsb=y&IndexArea=product_en&CatId=&SearchText=" + itemName + "\"" +"target=\"_blank\">Alibaba</a>" + "<br>" +
                "";
            document.getElementById("links").innerHTML += link ;
        }
        else{
            alert("Item name cannot be empty");
        }

        //location.reload();
    });

    $("ul").on("click", "input", function(e) {

        e.preventDefault();
        $(this).parent().parent().remove();
        //alert($('this.parent.parent:eq(2)').text());
        let item = $(this).parent().parent().find("li").text();
        let data = item.split('$');

        $.ajax({
            url: 'deleteFromDataBase.php',

            data: {
                item:data[0],price:data[1],email:$("#email").text(),table:"wishlist"
            },
            success: function(data){

            },
            dataType: 'text',
            type: 'POST',
            error: function() {
                alert("an error has occured");
            }
        });


    });
    $("ul").on("click", "input", function(e) {

        e.preventDefault();
        $(this).parent().parent().remove();
        //alert($('this.parent.parent:eq(2)').text());
        let item = $(this).parent().parent().find("li").text();
        let data = item.split('$');

        $.ajax({
            url: 'deleteFromDataBase.php',

            data: {
                item:data[0],price:data[1],email:$("#email").text(),table:"cartlist"
            },
            success: function(data){

            },
            dataType: 'text',
            type: 'POST',
            error: function() {
                alert("an error has occured");
            }
        });

    });
    $('#upload').change(function() {
        //get file object
        let dataForm = new FormData();
        let file = document.getElementById('upload').files[0];
        if (dataForm) {
            dataForm.append("image",file);
            dataForm.append("email",$("#email").text());
            dataForm.append("path", file.url);
            $.ajax({
                url: 'addImageToDataBase.php',
                data: dataForm,
                error: function() {
                    alert("an error has occured");
                },
                success: function(data){

                    $("#profilePic").attr("src", data);
                },
                contentType: false, //must, tell jQuery not to process the data
                processData: false,
                type: 'POST'

            });
        }

    });
});
