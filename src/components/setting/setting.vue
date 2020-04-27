<template>
    <div>
        <v-card class="mx-auto" max-width="100%" tile>
            <v-list flat>
                <v-list-item-group color="primary">
                    <v-list-item v-for="(item, i) in items" :key="i" @click="goMenu(item.text)">
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-card>
    </div>
</template>
<script>
export default {
    data: () => ({
        items: [
            { text: '수입 카테고리', icon: 'mdi-cash-usd-outline' },
            { text: '지출 카테고리', icon: 'mdi-minus' },
            { text: '목표', icon: 'mdi-flag'}
        ]
    }),
    methods: {
        goMenu(item){
            this.$emit('goMenuOfOption',item);
        }
    }
}
</script>
<style>
</style>