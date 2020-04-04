<template>
    <v-app id="inspire">
        <v-app-bar app clipped-right color="teal lighten-2">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-spacer></v-spacer>
            <!-- 툴바엔 몇 월이 들어갈지 나옴 -->
            <v-toolbar-title class="month">
                4월
            </v-toolbar-title>
            <v-spacer />
            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-tune</v-icon>
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
            <div class="moneyState">moneyState</div>
            <div class="calendar">calendar</div>
            <div class="moneyDetail">moneyDetail</div>
            <v-btn class="plus_icon mx-2" fab dark color="indigo">
                <v-icon dark>mdi-plus</v-icon>
            </v-btn>
        </div>
        <v-bottom-navigation :value="activeBtn" grow color="blue" app>
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
export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
        left: false
    }),
}
</script>
<style>
.mainScreen {
    position: fixed;
    width: 375px;
    height: 555px;
}


.moneyState {
    border: 1px solid grey;
    height: 80px;
}

.calendar {
    border: 1px solid grey;
    height: 280px;
}

.moneyDetail {
    border: 1px solid grey;
    height: 195px;
}

.plus_icon {
    position: relative;
    bottom: 60px;
    left: 300px;
}
</style>