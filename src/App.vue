<template>
    <v-app>
        <v-content>
            <Main v-if="mainShow" :data="data" />
            <Login v-if="loginShow" @login="login" @signUpDataRegInLoginVue="signUpDataRegInLoginVue" @setIDPWUserName="setIDPWUserName" />
            <SignUpUserSet v-if="signUpUserSetShow" @goMain="goMain" @saveSpendFixedList="saveSpendFixedList" />
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
        loginShow: true,
        mainShow: false,
        signUpUserSetShow: false,
        id: "",
        pw: "",
        userName: "",

        data: {},
        // data: {
        //     id: "gunmo",
        //     pw: "**uplus1214",
        //     name: "김건모",
        //     age: "20대",
        //     sex: "남자",
        //     userTotalProperty: 300000,
        //     incomeMonthly: 100000,
        //     spendFixedList: [
        //         ['월세','통신비','적금'],
        //         [300000,30000,20000]
        //     ],
        //     spendFlexibleList: [
        //         ['생활비','경조사'],
        //         [100000,100000]
        //     ],
        //     userGoals: ["100만원 모으기"]
        // }
        signUpSet: {}
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
        login(data) {
            this.loginShow = false;
            this.mainShow = true;
            this.data = data;
        },
        signUpDataRegInLoginVue(data) {
            this.signUpSet.id = data[0];
            this.signUpSet.pw = data[1];
            this.signUpSet.name = data[2];
            this.signUpSet.age = data[3];
            this.signUpSet.sex = data[4];
            this.loginShow = false;
            this.signUpUserSetShow = true;
        },
        setIDPWUserName(data) {
            this.id = data.id;
            this.pw = data.pw;
            this.userName = data.userName;
        },
        goMain(data) {
            this.signUpSet.userGoals = data[0];
            this.signUpSet.userTotalProperty = Number(data[1]);
            this.signUpSet.incomeMonthly = Number(data[2]);

            this.signUpSet.spendFiexibleList = data[4];


            for (let i = 0; i < this.signUpSet.spendFiexibleList[1].length; i++) {
                this.signUpSet.spendFiexibleList[1][i] = Number(this.signUpSet.spendFiexibleList[1][i]);
            }
            for (let i = 0; i < this.signUpSet.spendFixedList[0].length; i++) {
                this.signUpSet.spendFixedList[1][i] = Number(this.signUpSet.spendFixedList[1][i]);
            }

            let a = [];
            for (let i = data[0].length - 1; i >= 0; i--) {
                if (data[0][i]) {
                    if (i == 0)
                        a.unshift('일년 적금 들기');
                    else if (i == 1)
                        a.unshift('100만원 모으기');
                    else if (i == 2)
                        a.unshift('일주일에 외식 한 번');
                    else if (i == 3)
                        a.unshift('카페 일주일 두 번');
                    else
                        a.unshift('전셋집 자금 마련하기');
                }
            }
            this.signUpSet.userGoals = a;

            console.log(this.signUpSet);
        },
        saveSpendFixedList(spendFixedList) {

            this.signUpSet.spendFixedList = spendFixedList;
        }
    }
};
</script>
<style>
</style>