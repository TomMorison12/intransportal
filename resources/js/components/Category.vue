<template>
    <div>
         <add-category level="cat" class="mb-3" @added="getData"></add-category>
        <table class="table">
            <tr>
                <th><b>Country</b></th>
                <th><b># of cities</b></th>
            </tr>
            <tr v-for="category in categories">

                <td><a :href="'/' + category.name">{{category.name}}</a></td>
                    <td>6</td>
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
            axios.get('api/category').then(function (data) {
                this.categories = data.data;
                console.log(this.categories);

            }.bind(this));

        }
    }
}
</script>
