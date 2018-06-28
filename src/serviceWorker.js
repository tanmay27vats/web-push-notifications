self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    if (event.data) {
        const data_json = event.data.json();
        var title = (data_json.title) ? data_json.title : 'Web Notification Title Goes Here!';

        var payload = data_json.payload;
        console.debug(data_json);

        event.waitUntil(
            self.registration.showNotification(title, payload)
        );
    }
});
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    var url = (event.notification.data.url) ? event.notification.data.url : null;
    if(url) {
        clients.openWindow(url);
    }
});