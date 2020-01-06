<template>
      <ul class="pagination" v-if="shouldPaginate">
    <li v-show="prevUrl" class="page-item"><a class="page-link" rel="prev" href="#" @click.prevent="page--">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li v-show="nextUrl" class="page-item"><a class="page-link" rel="next" href="#" @click.prevent="page++">Next</a></li>
  </ul>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            page: 1,
            prevUrl: false,
            nextUrl: false
        }
    },

    watch: {
        data() {
            this.page = this.data.current_page;
            this.prevUrl = this.data.prev_page_url;
            this.nextUrl = this.data.next_page_url
        },

        page() {
            this.broadcast().updateUrl();
        }
    },

    computed: {
        shouldPaginate() {
            return !! this.prevUrl || !! this.nextUrl
        }
    },
    methods: {
        broadcast() {
            this.$emit('updated', this.page);
            return this;
        },

        updateUrl() {
            history.pushState(null, null, '?page=' + this.page);
        }
    }
}
</script>
