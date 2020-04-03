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
                dd
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
            </v-container>
        </v-content>
        <v-navigation-drawer v-model="right" fixed right temporary />
        <v-footer app>
            <span>footer</span>
        </v-footer>
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

.footer {
    border: 1px solid black;
}
</style>