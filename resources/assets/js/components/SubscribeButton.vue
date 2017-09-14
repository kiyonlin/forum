<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['isSubscribedTo'],

        data() {
            return {
                active: this.isSubscribedTo
            }
        },

        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-default']
            }
        },

        methods: {
            subscribe() {
                let httpMethod = this.active ? 'delete' : 'post';

                axios[httpMethod](location.pathname + '/subscriptions');

                this.active = !this.active;
            }
        }
    }
</script>