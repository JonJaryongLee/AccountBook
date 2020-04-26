<template>
    <v-app>
        <v-content>
            <Main v-if="mainShow"/>
            <Login v-if="loginShow" />
            <SignUpUserSet v-if="signUpUserSetShow" />
        </v-content>
    </v-app>
</template>
<script>
import Main from './components/Main.vue';
import Login from './components/login/login.vue';

import SignUpUserSet from './components/login/newUserSet/setUserProperty.vue';

export default {
    name: 'App',

    components: {
        Main, Login, SignUpUserSet
    },
    data: () => ({
        loginShow: false,
        mainShow: true,
        signUpUserSetShow: false
    }),
    methods:{

    }
};
</script>
<style>
</style>