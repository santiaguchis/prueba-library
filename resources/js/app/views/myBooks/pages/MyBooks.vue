<template>
    <div>
    <v-toolbar >
        <v-toolbar-title>
            <v-badge
                bottom
                inline
                overlap
                color="secondary"
                :content="books.length"
                >Mis libros</v-badge>
            </v-toolbar-title>
    </v-toolbar>
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="4" lg="3" xl="2"
                    v-for="( row , index ) in books"
                    :key="index">
                    <book-card :item="row"></book-card>
                </v-col>
            </v-row>
        </v-container>
        <book-rent-modal @on-refresh="onRefresh"></book-rent-modal>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

import BookCard     from '../../books/components/BookCard';
import BookRentModal from '../../books/components/BookRentModal';
export default {
    name: 'my-books-page',
    components: {
        BookCard,
        BookRentModal,
    },
    computed: {
        ...mapGetters({
            books: 'Books/getMyBooks'
        })
    },
    methods: {
        onRefresh() {
            this.$store.dispatch('Books/getMyBooks', {} );
        }
    },
    mounted() {
        this.$store.dispatch('Books/getMyBooks', {} );
    }
}
</script>
