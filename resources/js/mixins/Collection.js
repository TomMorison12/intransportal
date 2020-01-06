export default {
    data() {
        return {
            items: []
        };
    },
    methods: {
        remove(index) {
            this.$emit('remove');
            this.items.splice(index, 1);
        },
        add(item)
        {
            this.items.push(item);
            this.$emit('added');

        }
    }
}