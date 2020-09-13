<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>
        <p v-if="$parent.locked">This thread has been locked. No new replies accepted.</p>
        <new-reply  @created="add" v-if="! $parent.locked"></new-reply>
        <paginator :data="dataSet" @updated="fetch"></paginator>
    </div>




</template>

<script>
    import  Reply  from './Reply.vue';
    import  NewReply  from './NewReply.vue';
    import Collection from '../mixins/Collection.js'
    export default {

        components: {Reply, NewReply},
        mixins: [Collection],
        data() {
            return {
                dataSet: false,
            }
        },
        created() {
            this.fetch();
        },
        methods: {

            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },
            url(page) {
                if (!page) {
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }
                return location.pathname + '/replies?page=' + page;
            },
            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                //Click event to scroll to top
                $('html, body').animate({scrollTop: 0}, 800);


            }
        }
    }
</script>
