<template>
    <v-app id="inspire">
        <v-app-bar height="40%" app clipped-right color="teal lighten-2">
            <v-app-bar-nav-icon color="white" @click.stop="drawer = !drawer" />
            <v-spacer></v-spacer>
            <!-- 툴바엔 몇 월이 들어갈지 나옴 -->
            <v-toolbar-title class="month">
                4월
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
                <moneyState></moneyState>
            </div>
            <div class="calendar">
                <calendar></calendar>
            </div>
            <div class="moneyDetail">
                <moneyDetail></moneyDetail>
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
        left: false
    }),
    components: {
        'calendar': calendar,
        'moneyDetail' : moneyDetail,
        'moneyState': moneyState
    }
}
</script>
<style>
.mainScreen{
    width: 100%;
    height: 85%;
}

.moneyDetail {
    padding-bottom: 2%;
}

</style>