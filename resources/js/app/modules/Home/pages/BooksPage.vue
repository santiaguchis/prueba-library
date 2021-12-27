<template>
    <div>
        <v-toolbar >
            <v-toolbar-title>Mis libros</v-toolbar-title>
        </v-toolbar>
        <v-container fluid>
            <v-row>
                <v-col cols="12" sm="6" md="4" lg="3"
                    v-for="( row , index ) in books"
                    :key="index">
                    <widget-card :data="row"></widget-card>
                </v-col>
            </v-row>
        </v-container>
        <rent-book></rent-book>
    </div>
</template>
<script>
import WidgetCard from '../components/widgetCard/WidgetCard';
import RentBook from '../components/rentBook/RentBook';
export default {
    components: {
        WidgetCard,
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
    mounted() {
        this.$store.commit( 'Shared/SHOW_LOADING_PAGE' ,  true )

        axios.get( 'books/me' , {} )
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
