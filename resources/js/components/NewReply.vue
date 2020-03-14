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
    import Tribute from "tributejs";
	export default {
	    props: ['endpoint'],
        data() {
            return {
                body: null,


            }
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .catch((error) => {
                        flash(error.response.data, 'danger');
                        console.log(error);


                    }).then(data => {
                    this.body = '';
                    this.$emit("created", data.data);
                    flash("Your reply has been added");


                })
            },

        },
        mounted() {



              axios.get(window.location + 'api/users').then(function(data) {
                  let tribute = new Tribute({
                      values: data.data
                  });


                  tribute.attach(document.getElementById('body'));
              });

        }

	}

</script>



