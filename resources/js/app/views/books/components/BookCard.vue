<template>
    <v-card color="grey lighten-3">
        <v-img :aspect-ratio="9/12" :src="item.thumbnail"></v-img>
        <v-card-text class="d-flex flex-column">
            <div class="text-h6 book-title mb-1" :title="item.title" v-text="item.title"></div>
            <div class="text-overline book-author" v-text="item.author"></div>
            <div class="d-flex align-center">
                <v-icon>mdi-tag</v-icon><span class="ml-2 text-overline">{{ item.category.name }}</span>
            </div>
            <div class="d-flex align-center">
                <v-icon>mdi-calendar</v-icon><span class="ml-2 mr-2 text-overline"> {{ item.publisher_date }}</span>
            </div>
            <div class="d-flex align-center">
                <v-icon>mdi-book-open</v-icon><span class="ml-2 text-overline"> {{ item.pages }}</span>
                <v-spacer></v-spacer>
                Disponibles: <span class="ml-2 text-overline">{{ item.available }}</span>
            </div>
            <div v-if="(permissions.update || permissions.delete) && showActions"
                class="mt-2 mb-2 d-flex justify-space-between">
                <v-btn
                    v-if="permissions.update"
                    rounded
                    dark
                    color="light-blue"
                    @click="showEdit()"
                    >
                    <v-icon >mdi-pencil</v-icon>
                    Editar
                </v-btn>
                <v-btn
                    v-if="permissions.delete"
                    rounded
                    dark
                    color="red"
                    @click="showDelete()"
                    >
                    <v-icon >mdi-delete</v-icon>
                    Eliminar
                </v-btn>
            </div>
            <v-btn
                v-if="item.available"
                rounded
                outlined
                block
                :color="item.show_available ? 'green' : 'red'"
                @click="showRent(true)"
                >
                <v-icon >mdi-cart</v-icon>
                {{ ( item.show_available ) ? 'Alquilar' : 'Devolver' }}
            </v-btn>
            <v-btn
                v-else
                rounded
                :disabled="true"
                block
                color="red"
                >
                Sin stock disponible
            </v-btn>
        </v-card-text>
    </v-card>
</template>
<script>
export default {
    name : 'book-card',
    props : ['item', 'permissions', 'showActions'],
    methods : {
        showRent() {
            this.$store.commit('Books/showRentBookModal' , true );
            this.$store.commit('Books/setRentBook' , this.item );
        },
        showEdit() {
            this.$store.commit('Books/showEditBookModal' , true );
            this.$store.commit('Books/setBook' , this.item );
        },
        showDelete() {
            this.$store.commit('Books/showDeleteBookModal' , true );
            this.$store.commit('Books/setBook' , this.item );
        }
    }
}
</script>
<style lang="scss" scoped>
.book-title {
    line-height: 1.125;
    height: 2.25em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.book-author {
    line-height: 1.125;
    height: 2.25em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

