<template>
    <v-toolbar class="sticky-top" color="secondary" dark elevation="0">
        <v-toolbar-title class="mr-2">
            Library WA
        </v-toolbar-title>
        <v-btn text 

            class="text-button" 
            :exact="true"
            :to="{ name: 'home' }">
            Biblioteca
        </v-btn>
        <v-btn text 

            class="text-button" 
            :to="{ name: 'mybooks' }">
            Mis libros
        </v-btn>
        <v-btn text 
            class="text-button" 
            :to="{ name: 'users' }">
            Usuarios
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn text plain
            @click="logout()">
            <v-icon class="mr-2">mdi-logout-variant</v-icon>
            Cerrar sesión
        </v-btn>
    </v-toolbar>
</template>
<script>
import { mapState } from 'vuex'
export default {
	data() {
		return {
			selected : null,
		}
	},
    methods: {
        logout() {
            this.$store.dispatch( 'Shared/showLogout')
        }
    },
}
</script>
<style lang="scss" scoped>
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 9;
}
</style>