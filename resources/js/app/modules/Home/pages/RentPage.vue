<template>
    <div>
        <v-toolbar >
            <v-toolbar-title>Disponibles para alquilar</v-toolbar-title>
            
            <div class="search-box ml-2">
                <v-text-field
                    dense
                    rounded
                    :hide-details="true"
                    placeholder="Búscar"
                    v-model="filter.s"
                    prepend-inner-icon="mdi-magnify"
                    @keydown.enter="search()"
                    outlined
                    ></v-text-field>
            </div>
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
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="4" lg="3"
                    v-for="( row , index ) in books.data"
                    :key="index">
                    <book-card :data="row"></book-card>
                </v-col>
            </v-row>
        </v-container>
        <rent-book></rent-book>
    </div>
</template>
<script>
import BookCard from '../components/bookCard/BookCard';
import RentBook from '../components/rentBook/RentBook';
export default {
    components: {
        BookCard,
        RentBook
    },
    data() {
        return {
            books: {
                total: 0,
                data: []
            },
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
            axios.get( 'books' ,  { params : this.filter } )
                .then( response=> {
                    this.books = response.data.data.rows
                    this.$store.commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                })
                .catch( failure => {
                    this.$store.commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
                })
        }
    },
    mounted() {
        this.$store.commit( 'Shared/SHOW_LOADING_PAGE' ,  true )

        axios.get( 'books' , {} )
            .then( response=> {
                this.books = response.data.data.rows
                this.categories = response.data.data.categories
                this.$store.commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
            })
            .catch( failure => {
                this.$store.commit( 'Shared/HIDE_LOADING_PAGE' , null, { root : true } )
            })
            
    }
}
</script>
