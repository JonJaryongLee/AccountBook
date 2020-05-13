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
import axios from 'axios'


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
        data: {
            userData:{
                month: 5,
                income: 0,
                balance: 0,
                expense: 0,
                expenseTypeCash: 0,
                expenseTypeCard: 0,
            },
            monthData: {
                thisYear: 0,
                thisMonth: 0,
                spendContent: {

                }
            }
        },
        signUpSet: {}
    }),
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

            this.signUpSet.spendFlexibleList = data[4];


            for (let i = 0; i < this.signUpSet.spendFlexibleList[1].length; i++) {
                this.signUpSet.spendFlexibleList[1][i] = Number(this.signUpSet.spendFlexibleList[1][i]);
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
            axios.post('/php/signUp.php', this.signUpSet)
            .then(response => {
                if(response.data)
                {
                    const d = new Date();
                    this.data.userData.year = d.getFullYear()
                    this.data.userData.month = d.getMonth() + 1;
                    this.data.userData.balance = this.signUpSet.userTotalProperty
                    this.signUpUserSetShow = false;
                    this.mainShow = true;
                }
            })
            .catch(error => {
                if (error)
                    console.log("실패!");
            })
        },
        saveSpendFixedList(spendFixedList) {

            this.signUpSet.spendFixedList = spendFixedList;
        }
    }
};
</script>
<style>
</style>