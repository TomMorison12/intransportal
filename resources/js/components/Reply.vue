<template>
    <div :id="'reply-'+id" class="card mt-2">

    <div class="card-header">
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
           <textarea class="form-control" v-model="body"></textarea>
           <button class="btn btn-sm btn-primary" @click="update">Update</button>
           <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
       </div>
    </div>
    <div v-else v-text="body">

    </div>
</div>

    <div class="panel-footer level" v-if="canUpdate">
        <button class="btn btn-sm" style="margin-right: 1em" @click="editing = true">Edit</button>
        <button class="btn btn-danger btn-sm" style="margin-right: 1em" @click="destroy">Delete</button>


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
            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
             return this.authorize(User => this.data.user_id == window.App.user.id)
            }

        },
        data() {
            return {
                editing: false,
                body: this.data.body,
                id: this.data.id

            };
        },
        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });
                this.editing = false;

            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
                flash('The reply has been deleted');

                // $(this.$el).fadeOut(300, function() {
                // flash('Your reply has been deleted');
                // });


            }
        }
    }
</script>
