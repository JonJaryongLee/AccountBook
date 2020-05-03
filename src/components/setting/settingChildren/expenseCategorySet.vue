<template>
    <div>
        <v-card class="mx-auto" max-width="100%" tile>
            <v-list flat>
                <v-list-item-group color="primary">
                    <v-list-item v-for="(item, i) in items" :key="i" @click="setSpendMode(item.text)">
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
            { text: '생활비'},
            { text: '경조사비'},
            { text: '비상금'}
        ]
    }),
    methods: {
        setSpendMode(spendTag){
            this.$emit('setSpendMode', spendTag);
        }
    }
}
</script>
<style>
</style>