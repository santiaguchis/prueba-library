<template>
    <v-app>
        <v-main>
            <menu-component></menu-component>
            <router-view></router-view>
            <v-overlay fixed
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

import MenuComponent    from '../shared/Menu.vue';
import LogoutComponent  from '../shared/Logout.vue';
export default {
    components : {
        MenuComponent,
        LogoutComponent,
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
