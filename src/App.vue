<template>
    <v-app>
        <v-content>
            <Main />
        </v-content>
    </v-app>
</template>
<script>
import Main from './components/newUserSet/setUserProperty.vue';

export default {
    name: 'App',

    components: {
        Main,
    },
    data: () => ({
        //
    }),
};
</script>
<style>

</style>