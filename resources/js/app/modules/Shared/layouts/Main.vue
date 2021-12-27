<template>
    <v-app>
        <v-main>
            <menu-component></menu-component>
            <router-view></router-view>
            <v-overlay absolute
                v-if="loading">
                <v-progress-circular
                    indeterminate
                    color="secondary"
                    width="8"
                    size="64"
                    ></v-progress-circular>
            </v-overlay>
            <logout-component></logout-component>
        </v-main>
    </v-app>
</template>
<script>
import { mapState } from 'vuex';

import HeaderComponent from '../components/Header.vue';
import MenuComponent from '../components/Menu.vue';
import LogoutComponent from '../components/Logout.vue';
export default {
    components : {
        'header-component' : HeaderComponent,
        'menu-component' : MenuComponent,
        'logout-component' : LogoutComponent,
    },
    computed: {
        ...mapState({
            loading : state => state.Shared.page.loading
        })
    }
}
</script>
<style lang="scss">
.v-main {
    width: 100%;
    margin: auto;
}
.v-app-bar {
    > .v-toolbar__content {
        padding: 0;
    }
}
.v-footer {
    padding: 0;
}
</style>
