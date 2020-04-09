<template>
    <v-app id="inspire">
        <v-app-bar height="40%" app clipped-right color="teal lighten-2">
            <v-app-bar-nav-icon color="white" @click.stop="drawer = !drawer" />
            <v-spacer></v-spacer>
            <!-- 툴바엔 몇 월이 들어갈지 나옴 -->
            <v-toolbar-title class="month">
                {{userData.month}}월
            </v-toolbar-title>
            <v-spacer />
            <v-btn icon>
                <v-icon color="white">mdi-magnify</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="white">mdi-tune</v-icon>
            </v-btn>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" app>
            <v-list dense>
                <v-list-item @click.stop="left = !left">
                    <v-list-item-action>
                        <v-icon>mdi-exit-to-app</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Open Temporary Drawer</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-navigation-drawer v-model="left" fixed temporary />
        <div class="mainScreen">
            <div class="moneyState">
                <moneyState :userData="userData"></moneyState>
            </div>
            <div class="calendar">
                <calendar 
                    :monthData="monthData" 
                >        
                </calendar>
<!--                 axios로 calendar에서 moneyDetail 받아올 수 있으면 추후 아래로 고칠 것 -->
<!--                 <calendar 
                    :monthData="monthData" 
                    @printMoneyDetail="printMoneyDetail">        
                </calendar> -->
            </div>
            <div class="moneyDetail">
                <moneyDetail
                    :moneyDetail="moneyDetail"
                >        
                </moneyDetail>
            </div>
        </div>
        <v-bottom-navigation grow color="blue" app>
            <v-btn>
                <span>전체</span>
                <v-icon>mdi-calendar-month-outline</v-icon>
            </v-btn>
            <v-btn>
                <span>수입</span>
                <v-icon>mdi-purse-outline</v-icon>
            </v-btn>
            <v-btn>
                <span>지출</span>
                <v-icon>mdi-credit-card-outline</v-icon>
            </v-btn>
            <v-btn>
                <span>설정</span>
                <v-icon>mdi-cog-outline</v-icon>
            </v-btn>
        </v-bottom-navigation>
    </v-app>
</template>
<script>
import calendar from "./calendar/calendar.vue"
import moneyDetail from "./moneyDetail/moneyDetail.vue"
import moneyState from "./moneyState/moneyState.vue"
export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
        left: false,
        userData: {
            month: 4,
            income: 2000000,
            balance: 581300,
            expense: 1418700,
            expenseTypeCash: 1418700,
            expenseTypeCard: 0
        },
        monthData: {
            thisYear: 2020,
            thisMonth: 4,
            spendContent: {
                1: ["+", "2,000,000"],
                3: ["-", "7,900"],
                5: ["-", "400,000"],
                7: ["-", "56,800"],
                8: ["-", "6,000"],
                9: ["-", "25,000"],
                10: ["-", "500,000"],
                12: ["-", "36,700"],
                13: ["-", "259,200"],
                14: ["-", "10,500"],
                15: ["-", "53,600"],
                16: ["-", "10,200"],
                17: ["-", "5,000"],
                20: ["-", "12,800"],
                21: ["-", "35,000"]
            }
        },
        moneyDetail: {
            moneyDetailsNum: 4,
            moneyDetailTagData: ["경조사","카페","교통비","기타"],
            moneyDetailTagIcon: ["mdi-account-group","mdi-coffee","mdi-bus","mdi-minus"],
            iconColor: ["#FFEB3B","#00838F","#E57373","#F44336"],
            moneyDetailContentData: ["생일", "스타벅스", "택시", "에어팟"],
            moneyDetailMoneyData: ["80,000원","4,500원","4,700원","170,000원"]
        }
    }),
    components: {
        'calendar': calendar,
        'moneyDetail': moneyDetail,
        'moneyState': moneyState
    },
    methods: {
        // axios로 calendar에서 moneyDetail 받아올 수 있으면 추후 아래로 고칠 것
        // printMoneyDetail(moneyDetail){
        //     this.moneyDetail = moneyDetail;
        // }
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
</style>