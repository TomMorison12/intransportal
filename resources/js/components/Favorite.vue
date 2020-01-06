<template>
<button type="submit" :class="classes" @click="toggle">
    <span class="glyphicon glyphicon-heart"></span>
    <span v-text="favoritesCount"></span>
</button>
</template>

<script>
    export default {
        props: ['reply'],


        data: function() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavoritecd
            }
        },
        computed: {
            classes() {
                return [
                    'btn',
                    this.isFavorited ? 'btn-primary' : 'btn-default'
                ];
            },
        },

        methods: {
            toggle: function() {
                if (this.isFavorited) {
                    axios.delete('/replies/' + this.reply.id + '/favorite');


                    this.isFavorited = false;
                    this.favoritesCount--

                } else {
                    axios.post('/replies/' + this.reply.id + '/favorite');

                    this.isFavorited = true;
                    this.favoritesCount++

                }
            }
        },
    
    }
</script>
