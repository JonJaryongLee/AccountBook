<template>
    <v-app>
        <v-content>
            <Main v-if="mainShow" />
            <Login v-if="loginShow" />
            <SignUpUserSet v-if="signUpUserSetShow" />
        </v-content>
    </v-app>
</template>
<script>
import Main from './components/Main.vue';
import Login from './components/login/login.vue';

import SignUpUserSet from './components/login/newUserSet/setUserProperty.vue';
// import axios from 'axios'


export default {
    name: 'App',

    components: {
        Main,
        Login,
        SignUpUserSet
    },
    data: () => ({
        loginShow: false,
        mainShow: true,
        signUpUserSetShow: false,

        test: {
            id: "gunmo",
            pw: "**uplus1214",
            name: "김건모",
            age: "20대",
            sex: "남자",
            userTotalProperty: 300000,
            incomeMonthly: 100000,
            spendFixedList: [
                ['월세','통신비','적금'],
                [300000,30000,20000]
            ],
            spendFlexibleList: [
                ['생활비','경조사'],
                [100000,100000]
            ],
            userGoals: ["100만원 모으기"]
        }
    }),
    created() {
        // axios.post('/php/signUp.php', this.test)
        //     .then(response => {
        //         console.log(response.data)
        //     })
        //     .catch(error => {
        //         if (error)
        //             console.log("실패!");
        //     })
    },
    methods: {

    }
};
</script>
<style>
</style>