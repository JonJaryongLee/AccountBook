<template>
    <v-app>
        <v-content>
            <Main v-if="mainShow" />
            <Login v-if="loginShow" />

            <Test v-if="testShow" />
        </v-content>
    </v-app>
</template>
<script>
import Main from './components/Main.vue';
import Login from './components/login/login.vue';

import Test from './components/login/newUserSet/setUserProperty.vue';

export default {
    name: 'App',

    components: {
        Main, Login, Test
    },
    data: () => ({
        loginShow: false,
        mainShow: false,

        testShow: true
    }),
};
</script>
<style>
</style>