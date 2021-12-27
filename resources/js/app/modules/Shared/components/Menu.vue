<template>
    <v-toolbar color="secondary" dark elevation="0">
        <v-toolbar-title>
            Library WA
        </v-toolbar-title>
        <v-btn text class="text-button" :to="{ name: 'home' }">
            Biblioteca
        </v-btn>
        <v-btn text class="text-button" :to="{ name: 'mybooks' }">
            Mis libros
        </v-btn>
        <v-btn text class="text-button" :to="{ name: 'rents' }">
            Alquilar
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn icon
            @click="logout()">
            <v-icon>mdi-logout-variant</v-icon>
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
