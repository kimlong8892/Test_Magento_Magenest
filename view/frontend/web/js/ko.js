define([
    'uiComponent',
    'ko',
    'jquery',
], function (Component, ko, $) {
    return Component.extend({
        initialize: function () {
            'use strict';
            this._super();
            this.sayhello = "Hello World Of Knockout Js";
            // time
            this.time = Date();
            this.observe(['time']);
            setInterval(this.flush.bind(this), 1000);

            function CustomerReservation(id, initialCustomer) {
                this.id = id;
                this.meal = ko.observable(initialCustomer);
            }

            // add list
            this.customers = [
                {first_name: 'Nguyen', last_name: 'Long', email: '1@1gmail.com', address: 'HN'},
                {first_name: 'Kim', last_name: 'Long', email: '1@2gmail.com', address: 'ST'},
                {first_name: 'Tran', last_name: 'Kim', email: '1@3gmail.com', address: 'QN'},
                {first_name: 'Huynh', last_name: 'Hao', email: '1@4gmail.com', address: 'DN'},
                {first_name: 'Phan', last_name: 'Cong', email: '1@5gmail.com', address: 'DN'}
            ];
            var arrayCustomer = [];
            var id = 0;
            this.customers.forEach(function (customer) {
                arrayCustomer.push(new CustomerReservation(++id, customer));
            });
            this.list_customer = ko.observableArray(arrayCustomer);


        },
        flush: function () {
            this.time(Date());
        }
    });
});