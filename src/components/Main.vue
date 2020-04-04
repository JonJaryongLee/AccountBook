<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawerRight" app clipped right>
            <v-list dense>
                <v-list-item @click.stop="right = !right">
                    <v-list-item-action>
                        <v-icon>mdi-exit-to-app</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Open Temporary Drawer</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar app clipped-right color="teal lighten-2">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <!-- 툴바엔 몇 월이 들어갈지 나옴 -->
            <v-toolbar-title class="month">
                4월
            </v-toolbar-title>
            <v-spacer />
            <v-app-bar-nav-icon @click.stop="drawerRight = !drawerRight" />
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
        <v-content>
            <v-container class="fill-height" fluid>
                <v-row justify="center" align="center">
                    <!-- 한가운데 -->
                    한가운데
                </v-row>
                <v-btn class="plus_icon mx-2" fab dark color="indigo">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-container>
        </v-content>
        <v-navigation-drawer v-model="right" fixed right temporary />
        <v-bottom-navigation :value="activeBtn" grow color="teal" app>
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
        drawerRight: null,
        right: false,
        left: false,
    }),
}
</script>
<style>
.month {
    position: relative;
    left: 80px;
}

.plus_icon {
    position: relative;
    left: 270px;
    top: 50px;
}
</style>