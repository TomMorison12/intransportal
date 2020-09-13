<template>
    <div>
        <div v-if="level === 'cat'">
            <div class="card">
                <div class="card-header">
                    <h4><a href="#addcat" data-toggle="collapse">Add New Category (Country)</a></h4>
                </div>

                    <div id="addcat" class="card-body">
                        <div class="form-group">
                            <input v-model="name" class="form-control input-m" placeholder="Category (country) name" required/>
                            <button type="button" name="submit" class="btn btn-primary" @click="add">Add category
                            </button>
                        </div>
                </div>
            </div>
        </div>
        <div v-else-if="level === 'subcat'">
            <div class="card">
                <div class="card-header">
                    <h4><a href="#addsubcat" data-toggle="collapse">Add New Category ({{country}})</a></h4>
                </div>

                <div id="addsubcat" class="card-body collapse">
                    <div class="form-group">
                        <input v-model="name" class="form-control input-m" placeholder="Category (city) name" required/>
                        <button type="button" name="submit" class="btn btn-primary" @click="add">Add category
                        </button>
                    </div>
                </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
        }
    },
    props: ['level', 'country', 'cid'],

    methods: {
        add() {
            if (this.level === 'cat') {
                axios.post('/api/category/add', {name: this.name})
                    .catch((err) => {
                        flash(err.response.data, 'danger')
                        console.log(err)
                    }).then(data => {
                    this.$emit('added', data);
                    flash("The category has been created");
                });

            } else {
                axios.post('/api/subcategory/add', {name: this.name, category_id: this.cid})
                    .catch((err) => {
                        flash(err.response.data, 'danger')
                        console.log(err)
                    }).then(data => {
                    this.$emit('added');
                    flash("The subcategory has been created");
                });

            }

        }
    }




}
</script>
