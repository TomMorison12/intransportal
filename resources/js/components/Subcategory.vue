<template>
    <div>
        <add-category level="subcat" :country="country" class="mb-4" :cid="cid" @added="refresh"></add-category>
        <div v-for="city in dataSet">
        <div class="card mt-2">
            <div class="card-header">
                    <h4>
                        <a href="#">{{city.name}}</a>
                    </h4>
                </div>
            </div>
        </div>


        </div>

</template>

<script>
    export default {
        props: ['country', 'cid'],
        data() {
            return {
                dataSet: null
            }
        },
        methods: {
            refresh() {   axios.get('api/category/' + this.country).then(function(response) {
                console.log(response.data)
                this.dataSet = response.data;
            }.bind(this))}
        },
        created() {
          this.refresh();
        }
    }
</script>




