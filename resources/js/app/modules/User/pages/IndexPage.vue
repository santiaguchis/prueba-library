<template>
	<div>
        <index-component></index-component>
	</div>
</template>

<script>
import IndexComponent from '../components/Index';
export default {
  watch: {
  },
    components : {
        'index-component' : IndexComponent
    },
    data () {
        return {
        }
    },
    methods: {
    },
    mounted() {
        this.$store.dispatch('Shared/setTitleSection', 'Usuarios')
        console.log('Ready Modules User Page')
    }
}
</script>
<style lang="scss" scoped>
</style>
