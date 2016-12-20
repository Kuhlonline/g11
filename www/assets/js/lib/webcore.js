var webCore = function(uri) {

    var self            = this;

    this.endpoint       = '';
    this.token          = '';

    this.init           = function(api_uri) {
        this.endpoint   = api_uri;
        return this;
    };

    this.post           = function(payload, callback, errorCallback) {

        $.post(this.endpoint, payload, function(response) {

            if (!response || response == false) {
                if (errorCallback) errorCallback(response);
                return this.raiseError(500, 'Invalid Response from Server');
            }

            if (!callback) return;

            return callback(response);
        });

        return this;
    };

    this.invoke         = function(targetName, functionName, parameters, callback) {

        var payload     = {
            'api_token':    this.token,
            'target':       targetName,
            'function':     functionName,
            'param':        parameters
        };

        return this.post(payload, callback);
    };


    this.raiseError     = function(errNo, errStr) {

        console.error("Error [" + errNo + "]: " + errStr);

        return this;
    };

    return this.init(uri);
};