var notifyUser = function (data) {
    var shoutout = data.shoutout;

    if (!('Notification' in window)) {
        alert('Web Notification is not supported');

        return;
    }

    Notification.requestPermission(function(permission) {
        var notification = new Notification('@' + shoutout.handle + ' said:', {
            body: shoutout.content,
            icon: document.getElementById('site_image').content
        });
    });
}

var loadPusher = function (){
    Pusher.log = function(message) {
        if (window.console && window.console.log) {
            window.console.log(message);
        }
    };

    //var pusher = new Pusher(document.getElementById('pusher_key').content);
    var pusher = new Pusher('pusher_key');
    var channel = pusher.subscribe('shoutout-added');

    //channel.bind('App\\Events\\ShoutoutAdded', notifyUser);
    channel.bind('App\\Events\\ShoutoutAdded', window.console.log('Ok rebut!!'));
};
