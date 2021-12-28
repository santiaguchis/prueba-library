<template>
    <div>
        <book-filter-toolbar
            @on-search="onSearch">
        </book-filter-toolbar>
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="4" lg="3" xl="2"
                    v-for="( row , index ) in books.data"
                    :key="index">
                    <book-card :item="row" :permissions="permissions"></book-card>
                </v-col>
            </v-row>
            <div class="text-center mt-2">
                <v-pagination
                v-model="books.current_page"
                :length="books.last_page"
                :total-visible="7"
                circle
                @input="pagination()"
                ></v-pagination>
            </div>
        </v-container>
        <book-rent-modal></book-rent-modal>
    </div>
</template>
<script>
import { mapGetters }   from 'vuex';

import BookCard         from '../components/BookCard';
import BookRentModal    from '../components/BookRentModal';
import BookFilterToolbar from '../components/BookFilterToolbar';

export default {
    name: 'books-page',
    components: {
        BookCard,
        BookRentModal,
        BookFilterToolbar
    },
    data() {
        return { 
            params: {}
        }
    },
    computed: {
        ...mapGetters({
            books: 'Books/getBooks',
            permissions : 'Auth/getPermissions'
        })
    },
    methods: {
        pagination() {
            let page = this.books.current_page;
            this.params.page = page++;
            this.$store.dispatch('Books/getBooks', this.params );
        },
        onSearch( params ) {
            this.params = params
            this.$store.dispatch('Books/getBooks', this.params );
        }
    },
    mounted() {
        this.$store.dispatch('Books/getBooks', {} );
    }
}
</script>
