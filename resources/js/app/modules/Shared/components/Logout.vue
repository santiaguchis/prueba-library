<template>
    <v-dialog
        v-model="logout"
        max-width="360"
        persistent
        >
        <v-card dark>
            <v-card-title class="text-center">
                <v-spacer></v-spacer>
                <span class="text-uppercase">Cerrar sesión</span>
                <v-spacer></v-spacer>

            </v-card-title>
            <v-card-actions>
                <v-btn
                    large
                    text
                    :disabled="loading"
                    class="text-button"
                    @click="hideLogout()"
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
                    Aceptar
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
            logout : state => state.Shared.page.logout
        })
    },
    methods: {
        submit() {
            this.loading = true

            this.$store.dispatch( 'Auth/logout')
                .then(
                    ( response ) => {

                        setTimeout( () => {
                            this.$store.dispatch( 'Shared/hideLogout');
                            this.loading = false
                            this.$router.push({ name: 'auth.login' })

                        }, 1500 )
                    }
                );
        },
        hideLogout() {
            this.$store.dispatch( 'Shared/hideLogout');
        }
    }
}
</script>
