<script>
import Replies from '../components/Replies.vue';
import SubscribeButton from '../components/SubscribeButton.vue';

export default {
    props: ['thread'],
    components: {Replies, SubscribeButton},
    data() {
        return {
            repliesCount: this.thread.replies_count,
            locked: this.thread.locked,
            editing: false,
            form: {
                title: this.thread.title,
                body: this.thread.body
            }
        }

    },

    methods: {
        lock() {
            this.locked = ! this.locked;

                axios.patch(window.location, {locked: this.locked});
            },

        update() {
            axios.patch('/threads/' + this.thread.channel.slug + '/' + this.thread.slug, {
                title: this.form.title,
                body: this.form.body
            }).then(() => {
                this.editing = false;
                this.title = this.form.title;
                this.body = this.form.body;
                flash('Your thread has been updated');
            });

        }
    }
}

</script>
