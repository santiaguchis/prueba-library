<template>
    <v-dialog
        v-model="showEditBookModal"
        max-width="360"
        persistent
        >
        <v-card v-if="book">
            <v-toolbar dense>
                <v-toolbar-title>Editar libro:</v-toolbar-title>
            </v-toolbar>
            <v-card-text class="mt-4">
                <v-textarea 
                    label="Titulo"
                    rows="3"
                    v-model="book.title">
                </v-textarea>
                <v-text-field 
                    label="Año"
                    v-model="book.publisher_date">
                </v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    large
                    text
                    :disabled="loading"
                    class="text-button"
                    @click="hide()"
                    >
                    Cancelar
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                    dark
                    expanded
                    large
                    :loading="loading"
                    @click="submit()"
                    class="text-button"
                    color="green">
                    Guardar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { mapGetters, mapState } from 'vuex';
export default {
    name: 'book-edit-modal',
    data () {
        return {
            loading : false
        }
    },
    computed : {
        ...mapGetters({
            book: 'Books/getBook',
        }),
        ...mapState({
            showEditBookModal:  state => state.Books.showEditBookModal
        })
    },
    methods: {
        submit() {
            this.loading = true

            this.$store.dispatch( 'Books/updateBook' , this.book )
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
                        }, 1500 )
                    }
                );
        },
        hide() {
            this.$store.commit( 'Books/showEditBookModal' , false );
            this.$store.commit( 'Books/setBook' , null );
        }
    }
}
</script>
