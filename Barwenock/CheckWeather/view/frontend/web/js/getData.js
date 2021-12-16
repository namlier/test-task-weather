define(['ko','jquery','uiComponent'], function(ko,$,Component) {
    return Component.extend({
        weatherList: ko.observableArray([]),
        initialize: function () {
            const self = this;
            this._super();
            $(document).ready(function() {
                const url = '/rest/V1/weather/get/';
                const verb = 'GET';
                $.ajax({
                    url: url,
                    type: verb,
                    showLoader: false,
                    cache: false,
                    success: function (response) {
                        self.weatherList.push(JSON.parse(response));
                    }
                });
            });
        }
    });
});
