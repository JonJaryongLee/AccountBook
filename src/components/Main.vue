<template>
    <v-app id="inspire">
        <v-app-bar height="40%" app clipped-right color="teal lighten-2">
            <v-icon color="white" @click="goChart">{{chartModeIcon}}</v-icon>
            <v-spacer></v-spacer>
            <!-- 툴바엔 몇 월이 들어갈지 나옴 -->
            <v-toolbar-title class="month" v-if="mainScreenShow">
                {{userData.month}}월
            </v-toolbar-title>
            <v-toolbar-title v-else>
                {{spendModeTag}}
            </v-toolbar-title>
            <v-spacer />
            <v-btn icon v-if="tuneIcon">
                <v-icon color="white" @click.stop="drawer = !drawer">mdi-tune</v-icon>
            </v-btn>
            <v-btn icon v-if="plusIcon">
                <v-icon color="white" @click="addSpendCategory">mdi-plus</v-icon>
            </v-btn>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" app right>
            <v-list dense>
                <v-list-item @click="goUserChart">
                    <v-list-item-content>
                        <v-list-item-title>사용자 통계</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click="goUserGoal">
                    <v-list-item-content>
                        <v-list-item-title>목표</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click="goUserSpendType">
                    <v-list-item-content>
                        <v-list-item-title>소비유형</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <div class="mainScreen" v-show="mainScreenShow">
            <div class="moneyState">
                <moneyState :userData="userData"></moneyState>
            </div>
            <div class="calendar">
                <calendar :monthData="monthData" @printMoneyDetail="printMoneyDetail">
                </calendar>
                <!--                 axios로 calendar에서 moneyDetail 받아올 수 있으면 추후 아래로 고칠 것 -->
                <!--                 <calendar 
                    :monthData="monthData" 
                    @printMoneyDetail="printMoneyDetail">        
                </calendar> -->
            </div>
            <div class="moneyDetail">
                <moneyDetail v-if="moneyDetailShow" :moneyDetail="moneyDetail" @addHistory="addHistory">
                </moneyDetail>
            </div>
        </div>
        <spendInput v-if="spendInputShow" @registerSpend="registerSpend"></spendInput>
        <chart v-if="chartShow"></chart>
        <chartUserType v-if="chartUserTypeShow"></chartUserType>
        <goals v-if="goalsShow"></goals>
        <userSpendType v-if="userSpendTypeShow" @goMain="goMain"></userSpendType>
        <setting v-if="settingShow" @goMenuOfOption="goMenuOfOption"></setting>
        <userSet v-if="userSetShow"></userSet>
        <incomeCategorySet v-if="incomeCategorySetShow"></incomeCategorySet>
        <expenseCategorySet v-if="expenseCategorySetShow" @setSpendMode="setSpendMode"></expenseCategorySet>
        <goalSet v-if="goalSetShow"></goalSet>
        <addSpendMode v-if="addSpendModeShow"></addSpendMode>
        <appFooter @goSetting="goSetting" @goMain="goMain"></appFooter>
        <!-- 생활비 초과 알람 -->
        <div>
            <v-dialog v-model="overSpendAlarmDialogShow" width="200">
                <v-card color="grey">
                    <div id="OverSpendAlarmIconContainer">
                        <v-icon size="50" color="red">mdi-alert-outline</v-icon>
                    </div>
                    <div id="OverSpendAlarmText">
                        이번 달 생활비가
                        <br>
                        초과되었습니다!
                    </div>
                    <div id="OverSpendAlarmCloseBtnContainer">
                        <v-btn @click="closeOverSpendAlarmDialog">확인</v-btn>
                    </div>
                </v-card>
            </v-dialog>
        </div>
    </v-app>
</template>
<script>
import axios from "axios"

import calendar from "./calendar/calendar.vue"
import moneyDetail from "./moneyDetail/moneyDetail.vue"
import moneyState from "./moneyState/moneyState.vue"
import appFooter from "./footer/appFooter.vue"
import spendInput from "./spendInput/spendInput.vue"
import chart from "./chart/chart.vue"
import chartUserType from "./chart/chartUserType.vue"
import goals from "./goals/goals.vue"
import userSpendType from "./userSpendType/userSpendType.vue"
import setting from "./setting/setting.vue"
import userSet from "./setting/settingChildren/userSet.vue"
import incomeCategorySet from "./setting/settingChildren/incomeCategorySet.vue"
import expenseCategorySet from "./setting/settingChildren/expenseCategorySet.vue"
import goalSet from "./setting/settingChildren/goalSet.vue"
import addSpendMode from "./setting/settingChildren/addSpendMode.vue"
export default {
    props: ['data'],
    data: () => ({
        drawer: null,
        right: false,
        overSpendAlarmDialogShow: false,
        selectedDay: -1,
        mainScreenShow: true,
        spendInputShow: false,
        chartShow: false,
        chartUserTypeShow: false,
        goalsShow: false,
        userSpendTypeShow: false,
        settingShow: false,
        userSetShow: false,
        incomeCategorySetShow: false,
        expenseCategorySetShow: false,
        goalSetShow: false,
        chartModeIcon: "mdi-timelapse",
        spendModeTag: null,
        tuneIcon: true,
        plusIcon: false,
        addSpendModeShow: false,
        moneyDetailShow: false,
        userData: {},
        monthData: {},
        moneyDetail: {}
    }),
    created() {
        this.userData = this.data.userData;
        this.monthData = this.data.monthData;
    },
    components: {
        'calendar': calendar,
        'moneyDetail': moneyDetail,
        'moneyState': moneyState,
        'appFooter': appFooter,
        'spendInput': spendInput,
        'chart': chart,
        'chartUserType': chartUserType,
        'goals': goals,
        'userSpendType': userSpendType,
        'setting': setting,
        'userSet': userSet,
        'incomeCategorySet': incomeCategorySet,
        'expenseCategorySet': expenseCategorySet,
        'goalSet': goalSet,
        'addSpendMode': addSpendMode
    },
    methods: {
        // axios로 calendar에서 moneyDetail 받아올 수 있으면 추후 아래로 고칠 것
        // printMoneyDetail(moneyDetail){
        //     this.moneyDetail = moneyDetail;
        // }

        // 생활비 경고창
        overSpendAlarm() {
            if (this.userData.monthlyLivingExpenseBudget < this.monthlyLivingExpenseReal)
                this.userData.overSpendAlarmDialogShow = true;
        },
        shutDown() {
            this.chartShow = false;
            this.goalsShow = false;
            this.mainScreenShow = false;
            this.spendInputShow = false;
            this.chartUserTypeShow = false;
            this.overSpendAlarmDialogShow = false;
            this.userSpendTypeShow = false;
            this.settingShow = false;
            this.userSetShow = false;
            this.incomeCategorySetShow = false;
            this.expenseCategorySetShow = false;
            this.goalSetShow = false;
            this.spendModeTag = null;
            this.tuneIcon = true;
            this.plusIcon = false;
            this.addSpendModeShow = false;
        },
        closeOverSpendAlarmDialog() {
            this.overSpendAlarmDialogShow = false;
        },
        printMoneyDetail(date) {
            this.selectedDay = date;
            this.moneyDetailShow = false;
            axios.post('/php/getMoneyDetail.php', {
                    'thisYear': this.monthData.thisYear,
                    'thisMonth': this.monthData.thisMonth,
                    'today': date
                }).then(response => {
                    this.moneyDetail = {};
                    this.moneyDetail = response.data.moneyDetail;
                    this.moneyDetailShow = true;
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                });
        },
        addHistory() {
            this.shutDown();
            this.spendInputShow = true;
            this.chartModeIcon = "mdi-arrow-left";
        },

        //추후 서버에서 받은 변수 추가할 것
        registerSpend() {
            this.shutDown();
            this.mainScreenShow = true;
            this.chartModeIcon = "mdi-timelapse"
        },
        goUserChart() {
            this.drawer = !this.drawer;
            this.shutDown();
            this.chartUserTypeShow = true;
            this.chartModeIcon = "mdi-arrow-left";
        },
        goUserGoal() {
            this.drawer = !this.drawer;
            this.shutDown();
            this.goalsShow = true;
            this.chartModeIcon = "mdi-arrow-left";
        },
        goUserSpendType() {
            this.drawer = !this.drawer;
            this.shutDown();
            this.userSpendTypeShow = true;
            this.chartModeIcon = "mdi-arrow-left";
        },
        goChart() {
            if (this.chartModeIcon == "mdi-timelapse") {
                this.shutDown();
                this.chartShow = true;
                this.chartModeIcon = "mdi-arrow-left"
            } else {
                this.shutDown();
                this.mainScreenShow = true;
                this.chartModeIcon = "mdi-timelapse";
            }
        },
        goMain() {
            this.shutDown();
            this.mainScreenShow = true;
            this.chartModeIcon = "mdi-timelapse";
        },
        goSetting() {
            this.shutDown();
            this.settingShow = true;
            this.chartModeIcon = "mdi-arrow-left"
        },
        goMenuOfOption(item) {
            this.shutDown();
            if (item == "사용자")
                this.userSetShow = true;
            else if (item == "수입 카테고리")
                this.incomeCategorySetShow = true;
            else if (item == "지출 카테고리")
                this.expenseCategorySetShow = true;
            else
                this.goalSetShow = true;
        },
        setSpendMode(spendTag) {
            this.shutDown();
            this.spendModeTag = spendTag;
            this.tuneIcon = false;
            this.plusIcon = true;
            this.addSpendModeShow = true;
        },
        addSpendCategory() {
            console.log("add!");
        }
    }
}
</script>
<style>
.mainScreen {
    width: 100%;
}

.moneyDetail {
    padding-bottom: 2%;
}

#OverSpendAlarmIconContainer {
    padding-left: 10px;
    position: relative;
    top: 5px;
    display: inline;
}

#OverSpendAlarmText {
    display: inline;
    float: right;
    padding: 10px;
}

#OverSpendAlarmCloseBtnContainer {
    display: block;
    text-align: center;
    padding-bottom: 10px;
}
</style>