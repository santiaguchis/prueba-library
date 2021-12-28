<template>
    <v-dialog
        v-model="showRentBookModal"
        max-width="360"
        persistent
        >
        <v-card v-if="rentBook">
            <v-toolbar dense>
                <v-toolbar-title>Desea {{ rentBook.show_available ? 'alquilar' : 'devolver' }} el siguiente libro:</v-toolbar-title>
            </v-toolbar>
            <h5 class="text-h6 pa-3 text-center">
               {{ rentBook.title }}
            </h5>
            <v-img :aspect-ratio="9/12"
                :src="rentBook.thumbnail"></v-img>
            <v-card-actions>
                <v-btn
                    large
                    text
                    :disabled="loading"
                    class="text-button"
                    @click="hide()"
                    >
                    No
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                    dark
                    expanded
                    large
                    :loading="loading"
                    @click="submit()"
                    class="text-button"
                    :color="rentBook.show_available ? 'green' : 'red'">
                    Si, {{ rentBook.show_available ? 'alquilar' : 'devolver' }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { mapGetters, mapState } from 'vuex';
export default {
    name: 'book-rent-modal',
    data () {
        return {
            loading : false
        }
    },
    computed : {
        ...mapGetters({
            rentBook: 'Books/getRentBook',
        }),
        ...mapState({
            showRentBookModal:  state => state.Books.showRentBookModal
        })
    },
    methods: {
        submit() {
            this.loading = true

            this.$store.dispatch( 'Books/rentBook' , { book_id : this.rentBook.id } )
                .then(
                    ( response ) => {
                        if( response.status ) {
                            this.$toast.success( response.message.description , response.message.title )
                        } else {
                            this.$toast.warning( response.message.description , response.message.title )
                        }
                        setTimeout( () => {
                            this.hide()
                            this.loading = false
                            this.$emit('on-refresh');
                        }, 1500 )
                    }
                );
        },
        hide() {
            this.$store.commit( 'Books/showRentBookModal' , false );
            this.$store.commit( 'Books/setRentBook' , null );
        }
    }
}
</script>
