/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$(document).ready(function () {
    //alert("custom")
    $(function () {
      //  alert("here");
        //Dashboard menu active status script

        var path = window.location.href;

        $('#left-panel nav li a').each(function () {
            if ($(this).attr('href') === path) {
              //  alert(path)
                $("#left-panel nav li").removeClass("active");
                $("#left-panel nav li").removeClass("open");
                //$("#left-panel ul").css("display","none");
                $(this).parent().addClass("active");
                $(this).parent().parent().css("display", "block");
                $(this).parent().parent().parent().addClass("open");
                $(this).parent().parent().parent().addClass("active");
            }

        });
   // });




});
