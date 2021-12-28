<template>
    <v-toolbar >
        <v-toolbar-title>Biblioteca</v-toolbar-title>
        <v-text-field
            dense
            rounded
            style="max-width: 180px"
            class="ml-2"
            :hide-details="true"
            placeholder="Búscar"
            v-model="filter.s"
            :clearable="true"
            prepend-inner-icon="mdi-magnify"
            @keydown.enter="search()"
            outlined
            ></v-text-field>
        <v-select
            :items="order"
            :hide-details="true"
            dense
            class="ml-2"
            v-model="filter.order"
            :clearable="true"
            style="max-width: 200px"
            outlined
            rounded
            label="Orden por título:"
            ></v-select>
        <v-select
            :items="orderYear"
            :hide-details="true"
            dense
            class="ml-2"
            v-model="filter.year"
            :clearable="true"
            style="max-width: 200px"
            outlined
            rounded
            label="Orden por año:"
            ></v-select>
        <v-select
            :items="categories"
            :hide-details="true"
            dense
            class="ml-2"
            v-model="filter.category_id"
            item-value="id"
            item-text="name"
            style="max-width: 240px"
            outlined
            rounded
            :clearable="true"
            label="Categoría"
            ></v-select>
        <v-btn 
            color="secondary"
            class="ml-2"
            rounded
            @click="search()">Filtrar</v-btn>
    </v-toolbar>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    name: 'books-filter-toolbar',
    computed: {
        ...mapGetters({
            categories: 'Books/getCategories'
        })
    },
    data() {
        return { 
            filter: {
                s : '',
                order: 'Asc',
                year: 'Asc',
                category_id: 0
            },
            order: [
                'Asc' , 'Desc'
            ],
            orderYear: [
                'Asc' , 'Desc'
            ]
        }
    },
    methods: {
        search() {
            this.$emit('on-search', this.filter)
        }
    }
}
</script>