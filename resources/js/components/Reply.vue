<template>
    <div :id="'reply-'+id" class="card mt-2">

    <div class="card-header" :class="isBest ? 'bg-success' : 'bg-light'">
        <div class="level">
            <h5 class="flex">
        <a :href="'/profiles'+data.owner.name" v-text="data.owner.name"></a> said <span v-text="ago"></span>
            </h5>
    <div v-if="signedIn">
    <favorite :reply="data"></favorite>
    </div>
    </div>

</div>

<div class="card-body">
    <div v-if="editing">
       <div class="form-group">
           <form action="" @submit="update">
           <textarea class="form-control" v-model="body" required></textarea>
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
        <button class="btn btn-sm btn-link" @click="editing = false" type="button">Cancel</button>
    </form>
       </div>
       </div>

    <div v-else v-html="body">

    </div>
</div>

    <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">>
        <div v-if="authorize('owns', data)">
      <button class="btn btn-primary btn-sm" style="margin-right: 1em" @click="editing = true">Edit</button>
         <button class="btn btn-danger btn-sm" style="margin-right: 1em" @click="destroy">Delete</button>
    </div>
        <button class="btn btn-default btn-sm" style="margin-left: auto" @click="markBestReply" v-if="authorize('updateThread', this.data.thread)">Best reply?</button>



    </div>
</div>


</template>
<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';
    export default {

        props: ['data'],
        components: { Favorite },
        computed: {
            ago() {
                return moment(this.data.created_at).fromNow();
            },

        },
        created() {
          window.events.$on('best-reply-selected', id => {
              this.isBest = (id === this.id);
            });
        },

        data() {
            return {
                editing: false,
                body: this.data.body,
                id: this.data.id,
                isBest: this.data.isBest,
                reply: this.data


            };
        },
        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });
                this.editing = false;
                flash('Updated!')

            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
                flash('The reply has been deleted');

                // $(this.$el).fadeOut(300, function() {
                // flash('Your reply has been deleted');
                // });


            },

            markBestReply() {
                axios.post('/replies/' + this.data.id + '/best');

                window.events.$emit('best-reply-selected', this.data.id);
            }
        }
    }
</script>
