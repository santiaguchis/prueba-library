<template>
    <v-dialog
        v-model="showDeleteBookModal"
        max-width="360"
        persistent
        >
        <v-card v-if="book">
            <v-toolbar dense>
                <v-toolbar-title>Eliminar libro:</v-toolbar-title>
            </v-toolbar>
            <v-card-text class="mt-4">
                <h5 class="text-h6 pa-3 text-center">
                {{ book.title }}
                </h5>
                <v-img :aspect-ratio="9/12"
                    :src="book.thumbnail"></v-img>
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
                    color="red">
                    Eliminar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { mapGetters, mapState } from 'vuex';
export default {
    name: 'book-delete-modal',
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
            showDeleteBookModal:  state => state.Books.showDeleteBookModal
        })
    },
    methods: {
        submit() {
            this.loading = true

            this.$store.dispatch( 'Books/deleteBook' , this.book )
                .then(
                    ( response ) => {
                        if( response.status ) {
                            this.$emit('on-refresh');
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
            this.$store.commit( 'Books/showDeleteBookModal' , false );
            this.$store.commit( 'Books/setBook' , null );
        }
    }
}
</script>
