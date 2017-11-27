<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <p v-if="$parent.locked">
            This thread has been locked. No more replies are allowed.
        </p>

        <new-reply @created="add" v-else></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    import collection from '../mixins/collection'

    export default {

        components: {Reply, NewReply},

        mixins: [collection],

        data() {
            return {
                dataSet: false,
                items: [],
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            url(page = 1) {
                if (!page) {
                    // 正则表达式匹配query里的参数
                    let query = location.search.match(/page=(\d+)/);

                    // 有匹配到使用正则表达式括号分组里的值
                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/replies?page=${page}`;
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0, 0);
            }

        }
    }
</script>