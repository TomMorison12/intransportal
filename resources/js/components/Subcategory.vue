<template>
    <div>
        <div v-if="signedIn">
        <add-category level="subcat" :country="country" class="mb-4" :cid="cid" @added="refresh"></add-category>
    </div>
        <div v-for="city in dataSet">
        <div class="card mt-3">
            <div class="card-header">
                <div class="level">
                    <h4 class="mr-a">
                        <a href="#">{{city.name}}</a>
                    </h4>
                    <a :href="'#' + city.name + '-modal'">Add a transit line</a>

                </div>
            </div>


            <div class="card-body">
                This is where the photos would go
            </div>
        </div>
        </div>
    </div>





</template>

<script>
    export default {
        props: ['country', 'cid', 'slug'],
        data() {
            return {
                dataSet: null,
                photos: []
            }
        },
        methods: {
            refresh() {
                axios.get('api/cities/' + this.slug).then(function(response) {
                this.dataSet = response.data;
            }.bind(this))}
        },
        created() {
          this.refresh();
        }
    }
</script>




