require('./bootstrap');

Vue.component('notification', require('./components/notifications/Notification.vue'));
Vue.component('notification-container', require('./components/notifications/NotificationContainer.vue'));

window.notificationManager = new Vue({
    el: '#notifications',
    data: {
        loading: false,
        notifications: [],
    },
    created() {
        this.loading = true;

        axios.get('/api/notifications').then(response => {
            this.notifications = response.data;
        }).then( () => {
            this.loading = false;
        });

        Echo.private('user.'+window.Laravel.user.id)
        // .listen('UpdatePersonalNotification', (e) => {
        //     console.log('update with ',e);
        // })
            .listen('PersonalNotification', (e) => {

                // @TODO Eww Jquery
                $('#notifications a').addClass('red-text');
                setTimeout(function() {
                    $('#notifications a').removeClass('red-text');
                }, 500);

                this.notifications.unshift(
                    e.notification
                );
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notification = new Notification(e.notification.title, {
                        body: e.notification.message,
                        icon: '/img/notification.jpg',
                        requireInteraction: true,
                    });
                    if(e.notification.link !== null) {
                        notification.onclick = function () {
                            notification.close();
                            window.open(e.notification.link);

                        };
                    }
                    if(e.notification.icon !== null) {
                        notification.icon = e.notification.icon;
                    }

                }
            });
    },
    mounted() {
        $('#notifications .dropdown-menu').click(function(event){
            event.stopPropagation();
        });

    }
});

import EventHub from './events/event-hub';

EventHub.$on('updateNotification', (e) => {
    console.log(e);
    if(typeof e.action !== "undefined" && e.action == 'mark-as-read') {
        var new_notifications = notificationManager.notifications.filter( ( notification ) => {
            return (notification.id !== e.notification.id);
        } );

        notificationManager.notifications = new_notifications;
        axios.post('/api/notifications/read/'+ e.notification.id, {});
    }
});
EventHub.$on('updateNotificationsAllRead', () => {
    notificationManager.notifications = [];
    axios.post('/api/notifications/read/all', {} );
});

/* @TODO fix temporary disable due to SSL requirement */
// request permission on page load
// document.addEventListener('DOMContentLoaded', function () {
//     if (!Notification) {
//         alert('Desktop notifications not available in your browser. Try Chromium.');
//         return;
//     }
//
//     if (Notification.permission !== "granted")
//         Notification.requestPermission();
// });
