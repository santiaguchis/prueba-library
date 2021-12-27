<template>
    <v-card color="primary" tile
        dark>
        <v-card-text>
            <h2 class="text-h6" v-text="data.title"></h2>
            <h4 class="text-overline" v-text="data.author"></h4>
        </v-card-text>
        <div class="d-flex flex-no-wrap justify-space-between">
            <div>
                
                <v-card-text>
                    <p>Pag. {{ data.pages }}</p>
                    <p>total disponibles {{ data.avalaible }}</p>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        class="ml-2 mt-2"
                        outlined
                        rounded
                        small
                        @click="showRent()"
                        >
                        Alquilar
                    </v-btn>
                </v-card-actions>
            </div>
            <div>
                <v-avatar
                    class="ma-3"
                    size="125"
                    tile
                >
                    <v-img :src="data.thumbnail"></v-img>
                </v-avatar> 
            </div>
        </div>
    </v-card>
</template>
<script>
export default {
    name : 'widget-card',
    props : ['data'],
    methods : {
        showRent() {
            console.log( this.data )
            this.$store.commit('Home/setRentBook' , this.data );
        }
    },
    mounted() {
    }
}
</script>
<style lang="scss" scoped>
.text-h6 {
    overflow: hidden;
    line-height: 1.25;
    height: 3em;
}
</style>

