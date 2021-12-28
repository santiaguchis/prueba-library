<template>
    <v-toolbar >
        <v-toolbar-title>Biblioteca</v-toolbar-title>
        <v-text-field
            dense
            rounded
            style="max-width: 160px"
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
            :items="orders"
            :hide-details="true"
            dense
            class="ml-2"
            v-model="filter.order"
            style="max-width: 160px"
            outlined
            rounded
            label="Ordenar por título:"
            ></v-select>
        <v-select
            :items="categories"
            :hide-details="true"
            dense
            class="ml-2"
            v-model="filter.category_id"
            item-value="id"
            item-text="name"
            style="max-width: 260px"
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
                category_id: 0
            },
            orders: [
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