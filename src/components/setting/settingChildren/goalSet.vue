<template>
    <div>
        <v-card class="mx-auto" max-width="100%" tile>
            <v-list flat>
                <v-list-item-group color="primary">
                    <v-list-item v-for="(item, i) in items" :key="i">
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
            { text: '일년 적금 들기' },
            { text: '100만원 모으기' },
            { text: '일주일에 외식 한 번' },
            { text: '카페 일주일 두 번'},
            { text: '전세집 자금 마련하기'}
        ]
    }),
    methods: {

    }
}
</script>
<style>
</style>