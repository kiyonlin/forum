<template>
    <li class="dropdown" v-show="notifications.length">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-bell"></span>
        </a>

        <ul class="dropdown-menu">
            <li v-for="(notification, index) in notifications">
                <a :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification, index)"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false
            }
        },

        created() {
            window.events.$on('App\\Notifications\\ThreadWasUpdated', notification => this.add(notification));
            window.events.$on('App\\Notifications\\YouWereMentioned', notification => this.add(notification));

            axios.get('/profiles/' + this.userName + '/notifications')
                .then(response => this.notifications = response.data);
        },

        computed: {
            userName() {
                return window.App.user.name;
            }
        },

        methods: {
            markAsRead(notification, index) {
                axios.delete('/profiles/' + this.userName + '/notifications/' + notification.id);

                this.notifications.splice(index, 1);
            },

            add(notification) {
                this.notifications.push({
                    id: notification.id,
                    data: {
                        message: notification.message,
                        link: notification.link
                    }
                });
            }
        }
    }
</script>