<template>
    <div>
        <v-toolbar elevation="0" class="page-toolbar">
            <v-toolbar-title>
                Usuarios
            </v-toolbar-title>
            <v-btn
                class="ml-2 text-button"
                color="primary">
                <v-icon>mdi-plus</v-icon>
                Agregar
            </v-btn>
            <v-spacer></v-spacer>
            <div class="search-box">
                <v-text-field
                    dense
                    rounded
                    :hide-details="true"
                    placeholder="Búscar"
                    v-model="filter.s"
                    prepend-inner-icon="mdi-magnify"
                    @keydown.enter="search()"
                    outlined
                    ></v-text-field>
            </div>
        </v-toolbar>
        <v-container fluid
            v-if="!page.loading">
            <v-data-table
                :headers="$store.state.User.headers"
                :items="$store.state.User.rows.data"
                :loading="filter.process"
                hide-default-footer
                :server-items-length="$store.state.User.rows.total"
                class="elevation-1"
                >

                <template v-slot:item.actions="{ item , key }">
                    <div >
                        <v-btn
                            @click="editItem(item)"
                            icon>
                            <v-icon
                                small
                                >
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn
                            @click="deleteItem(item)"
                            v-if="item._current"
                            icon>
                            <v-icon
                                small

                                >
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>

            <div class="text-center mt-2">
                <v-pagination
                v-model="rows.current_page"
                :length="rows.last_page"
                :total-visible="7"
                circle
                @input="search()"
                ></v-pagination>
            </div>
        </v-container>
    </div>
</template>
<script>
export default {
    data() {
        return {
            page : {
                loading : true,
            },
            filter : {
                s : '',
                page : 1,
                process : false
            },
            headers : [],
            rows : {
                data : [],
                total : 0
            }
        }
    },
    methods : {
        search() {
            this.filter.process = true
            console.log( this.filter.s )
            let params = {
                s : this.filter.s,
                page : this.rows.current_page
            }
            this.$store.dispatch( 'User/getRows' , params )
                .then(
                    ( response ) => {
                        this.rows = response.data.rows
                        this.headers = response.data.headers
                        this.page.loading = false
                        setTimeout( () => {
                            this.filter.process = false
                        } , 250 )
                    }
                )

        }
    },
    mounted() {

        this.$store.dispatch( 'User/getRows' , { } )
            .then(
                ( response ) => {
                    this.rows = response.data.rows
                    this.page.loading = false
                }
            )
    }

}
</script>
<style lang="scss" scoped>
.v-main {
    width: 100%;
    margin: auto;
}
.v-app-bar {
    > .v-toolbar__content {
        padding: 0;
    }
}
</style>
