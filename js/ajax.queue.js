(function ($) {
    var ajaxQueue = $({});
    $.ajaxQueue = function (ajaxOpts) {
        var jqXHR;
        var dfd = $.Deferred();
        var promise = dfd.promise();
        ajaxQueue.queue(doRequest);
        promise.abort = function (statusText) {
            if (jqXHR) {
                return jqXHR.abort(statusText);
            }
            var queue = ajaxQueue.queue();
            var index = $.inArray(doRequest, queue);
            if (index > -1) {
                queue.splice(index, 1);
            }
            dfd.rejectWith(ajaxOpts.context || ajaxOpts, [promise, statusText, ""]);
            return promise;
        };

        function doRequest(next) {
            jqXHR = $.ajax(ajaxOpts).then(next, next).done(dfd.resolve).fail(dfd.reject);
        }

        return promise;
    };
})(jQuery);