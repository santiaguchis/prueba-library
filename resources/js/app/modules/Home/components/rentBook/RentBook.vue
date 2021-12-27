<template>
    <v-dialog
        v-model="rentBook"
        max-width="360"
        persistent
        >
        <v-card dark v-if="rentBook">
            <v-card-title class="text-center">
                <v-spacer></v-spacer>
                <span class="text-uppercase">Alquilar libro</span>
                <v-spacer></v-spacer>

            </v-card-title>
            <v-card-title class="text-center">
               {{ rentBook.title }}
            </v-card-title>
            <v-avatar
                class="ma-3"
                size="125"
                tile
            >
                <v-img :src="rentBook.thumbnail"></v-img>
            </v-avatar> 
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
                    color="green">
                    Si, alquilar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { mapState } from 'vuex';
export default {
    data () {
        return {
            loading : false
        }
    },
    computed : {
        ...mapState({
            rentBook : state => state.Home.rentBook
        })
    },
    methods: {
        submit() {
            this.loading = true

            this.$store.dispatch( 'Home/rentBook' , { book_id : this.rentBook.id } )
                .then(
                    ( response ) => {

                        setTimeout( () => {
                            this.hide()
                            this.loading = false

                        }, 1500 )
                    }
                );
        },
        hide() {
            this.$store.commit( 'Home/setRentBook' , null );
        }
    }
}
</script>
