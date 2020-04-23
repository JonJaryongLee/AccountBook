<template>
    <v-app>
        <v-content>
            <Main v-show="mainShow" @addHistory="addHistory"/>
            <Login v-if="loginShow" />
            <SignUpUserSet v-if="signUpUserSetShow" />
            <SpendInput v-if="spendInputShow" />
        </v-content>
    </v-app>
</template>
<script>
import Main from './components/Main.vue';
import Login from './components/login/login.vue';

import SignUpUserSet from './components/login/newUserSet/setUserProperty.vue';

import SpendInput from './components/spendInput/spendInput.vue'

export default {
    name: 'App',

    components: {
        Main, Login, SignUpUserSet, SpendInput
    },
    data: () => ({
        loginShow: false,
        mainShow: true,
        signUpUserSetShow: false,
        spendInputShow: false
    }),
    methods:{
        addHistory(){
            this.mainShow = false;
            this.spendInputShow = true;
        }
    }
};
</script>
<style>
</style>