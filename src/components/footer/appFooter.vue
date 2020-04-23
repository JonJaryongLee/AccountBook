<template>
    <div>
        <v-menu top :offset-y="offset">
            <template v-slot:activator="{ on }">
                <v-bottom-navigation grow color="blue" app>
                    <v-btn>
                        <span>전체</span>
                        <v-icon>mdi-calendar-month-outline</v-icon>
                    </v-btn>
                    <v-btn>
                        <span>수입</span>
                        <v-icon>mdi-purse-outline</v-icon>
                    </v-btn>
                    <v-btn v-on="on">
                        <span>지출</span>
                        <v-icon>mdi-credit-card-outline</v-icon>
                    </v-btn>
                    <v-btn>
                        <span>설정</span>
                        <v-icon>mdi-cog-outline</v-icon>
                    </v-btn>
                </v-bottom-navigation>
            </template>
            <v-list>
                <v-list-item v-for="(itemOfSpend, index) in itemOfSpends" :key="index" @click="test(itemOfSpend)" >
                    <v-list-item-title>{{ itemOfSpend.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>
<script>
export default {
    data: () => ({
        itemOfSpends: [
            { title: '생활비' },
            { title: '경조사' },
            { title: '비상금' }
        ],
        offset: true,
    }),
    methods: {
        test(item) {
            console.log(item.title);
        }
    }
}
</script>
<style>
</style>