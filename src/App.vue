<template>
    <v-app>
        <v-content>
            <Main v-if="mainShow" :data="data" />
            <Login v-if="loginShow" @login="login" @signUpDataRegInLoginVue="signUpDataRegInLoginVue" @setIDPWUserName="setIDPWUserName" />
            <SignUpUserSet v-if="signUpUserSetShow" @goMain="goMain" @saveSpendFixedList="saveSpendFixedList" @propertySet="propertySet" :userName="userName"/>
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
            userData: {
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
                spendContent: {}
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

        // 하위 컴포넌트에서 data를 넘겨받아 회원가입 준비를 함
        goMain(data) {
            this.signUpSet.userGoals = data[0];                     // 유저의 목표
            this.signUpSet.userTotalProperty = Number(data[1]);     // 유저의 총 자산
            this.signUpSet.incomeMonthly = Number(data[2]);         // 유저의 월 수입

            this.signUpSet.spendFlexibleList = data[4];             // 유저의 변동수입
            for (let i = 0; i < this.signUpSet.spendFlexibleList[1].length; i++) {
                this.signUpSet.spendFlexibleList[1][i] = Number(this.signUpSet.spendFlexibleList[1][i]);  // string형의 유저 변동수입을 int로 바꿈
            }
            for (let i = 0; i < this.signUpSet.spendFixedList[0].length; i++) {
                this.signUpSet.spendFixedList[1][i] = Number(this.signUpSet.spendFixedList[1][i]);        // string 형의 유저 고정수입을 int로 바꿈
            }

            // 사용자 목표는 다섯 개 정해진 목표에 boolean형인 배열. 이것을 String배열로 바꿔줄 작업
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

            // SignUp 기능을 하는 컴포넌트를 끔
            this.signUpUserSetShow = false;

            // 서버에 ajax통신으로 모아진 signUpSet 데이터를 전송함.
            axios.post('/php/signUp.php', this.signUpSet)
                .then(response => {
                    if (response.data) {
                        const d = new Date();
                        this.data.monthData.thisYear = d.getFullYear()      // 올해
                        this.data.userData.month = d.getMonth() + 1;        // 이번달
                        this.data.monthData.thisMonth = d.getMonth() + 1;   //  역시 이번달
                        this.mainShow = true;                               // 메인화면 띄움
                    }
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                });
            this.data.userData.income = this.signUpSet.incomeMonthly;
            let spend = 0;
            for (let i = this.signUpSet.spendFixedList[0].length - 1; i >= 0; i--) {
                spend += this.signUpSet.spendFixedList[1][i];
            }
            for (let i = this.signUpSet.spendFlexibleList[0].length - 1; i >= 0; i--) {
                spend += this.signUpSet.spendFlexibleList[1][i];
            }
            this.data.userData.expense = spend;
            this.data.userData.expenseTypeCash = spend;
        },
        saveSpendFixedList(spendFixedList) {

            this.signUpSet.spendFixedList = spendFixedList;
        },
        propertySet(property) {
            this.data.userData.balance = property;
        }
    }
};
</script>
<style>
</style>