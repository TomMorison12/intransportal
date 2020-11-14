<template>
    <div>
        <div v-if="signedIn">
         <add-category level="cat" class="mb-3" @added="getData"></add-category>
        </div>
        <table class="table">
            <tr>
                <th><b>Country</b></th>
                <th><b># of cities</b></th>
            </tr>
            <tr v-for="category in categories">

                <td><a :href="'/' + category.slug">{{category.name}}</a></td>
                    <td>{{category.cities_count}}</td>
            </tr>
        </table>
    </div>

</template>

<script>
import AddCategory from "./AddCategory";

export default {
    components: {AddCategory},
    data() {
        return {
            categories: null
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('api/categories').then(function (data) {
                this.categories = data.data;

            }.bind(this));

        }
    }
}
</script>
