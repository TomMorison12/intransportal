<template>

<!--        <form method="post" action="{{$thread->path() . '/replies'}}">-->
<!--                        {{ csrf_field() }}-->
    <div v-if="signedIn">
                        <div class="form-group mt-2">
                            <textarea rows="5" name="body" id="body" class="form-control" v-model="body" placeholder="Have something to say?"></textarea>
                            <button type="submit" name="submit" class="btn btn-primary" required @click="addReply">Post</button>
                        </div>
    </div>
        <div v-else>
            <p> Please <a href="/login">login</a> to participate in this.</p>
        </div>
    </div>
                  <!--  </form> -->
</template>

<script>
	export default {
	    props: ['endpoint'],
        data() {
            return {
                body: null

            }
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },
        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body}).then(data => {
                    this.body = '';
                    flash("Your reply has been added");
                    this.$emit("created", data.data);
                });
            }
        }
	}
</script>



