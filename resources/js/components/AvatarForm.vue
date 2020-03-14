<template>
    <div>
        <h1 v-text="user.name"></h1>
        <form v-if="canUpdate" method="post" enctype="multipart/form-data">
            <image-upload name="avatar" @loaded="onLoad"></image-upload>


            <button type="submit" class="btn btn-primary">Add Avatar</button>
        </form>

            <img :src="avatar" width="200" height="100" />

</div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';
    export default {
        props: ['user'],
        components: {ImageUpload},
        computed: {
            canUpdate() {
               return this.authorize(user => user.id === this.user.id)
            }
        },

        data() {
            return {
                avatar: '/storage/' + this.user.avatar_path
            }
        },
        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;
                this.persist(avatar.file)
            },

            persist(file) {
                let data = new FormData();
                data.append('avatar', file)
                axios.post("/api/users/" + this.user.id + "/avatar", data)
                    .then(() => flash('Avatar uploaded!'));
            }

        }

    }
</script>
