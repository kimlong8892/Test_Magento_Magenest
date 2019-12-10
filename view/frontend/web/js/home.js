define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/modal/modal',
    'ko',
], function ($, alert, modal, ko, Component) {
    'use strict';
    $(document).ready(function () {
        // alert hello world
        $("#btn-1st").click(function () {
            alert({
                title: 'Hello World!',
                modalClass: 'alert',
            });
            $(this).remove();
        });
        // popup login
        var modaloption = {
            type: 'popup',
            modalClass: 'modal-popup',
            responsive: true,
            innerScroll: true,
            clickableOverlay: true,
            title: 'Login Modal'
        };
        $("#btn-2nd").click(function () {
            var callforoption = modal(modaloption, $("#show-2nd"));
            $("#show-2nd").modal('openModal');
            setInterval(function () {
                var arrayColor = ['yellow', 'while', 'blue', 'violet', 'green'];
                var rand = Math.floor(Math.random() * arrayColor.length - 1) + 0;
                $("#show-2nd").css({'background': arrayColor[rand]});
            }, 1000);
        });


    });
});
