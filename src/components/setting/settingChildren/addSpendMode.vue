<template>
    <div>
        <div id="topLineInAddSpendMode">
            <div id="radioBtnContainerInAddSpendMode">
                <v-switch label="이월" v-model="carryOver"></v-switch>
            </div>
            <div id="inputBoxInAddSpendMode">
                <input type="number" id="inputInAddSpendMode" v-model="userInputMoney">
            </div>
        </div>
        <v-card class="mx-auto" max-width="100%" tile>
            <v-list flat>
                <v-list-item-group color="primary">
                    <v-list-item v-for="(item, i) in items" :key="i">
                        <v-list-item-icon>
                            <v-icon :color="item.color" v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
            <div>추가버튼 동작 안함</div>
            <div>axios통신하기</div>
            <div>리스트 드래그? 가능하면 할 것</div>
            <div>확인버튼 없음</div>
            <div>리스트 삭제버튼 없음</div>
        </v-card>
    </div>
</template>
<script>
export default {
    data: () => ({
        items: [{
                name: '식비',
                icon: 'mdi-silverware',
                color: '#4CAF50'
            },
            {
                name: '카페',
                icon: 'mdi-coffee-outline',
                color: '#3F51B5'
            },
            {
                name: '편의점',
                icon: 'mdi-store-outline',
                color: '#E91E63'
            },
            {
                name: '의류',
                icon: 'mdi-hanger',
                color: '#03A9F4'
            },
            {
                name: '교통비',
                icon: 'mdi-bus',
                color: '#E57373'
            }
        ],
        carryOver: false,
        userInputMoney: null
    }),
    methods: {

    }
}
</script>
<style>
#topLineInAddSpendMode {
    vertical-align: top;
}

#inputInAddSpendMode {
    height: 100%;
    width: 107%;
    font-size: 1.5rem;
    padding-right: 5%;
    text-align: right;
}


#inputBoxInAddSpendMode {
    border: 1px solid grey;
    border-radius: 10px;
    width: 60%;
    padding-right: 5%;
    height: 40px;
}

#tagOfTopLineInAddSpendMode,
#radioBtnContainerInAddSpendMode,
#inputBoxInAddSpendMode {
    vertical-align: top;
    display: inline-block;
}

#tagOfTopLineInAddSpendMode,
#inputBoxInAddSpendMode {
    margin: 10px;
}

#radioBtnContainerInAddSpendMode {
    margin-left: 10px;
}

#inputBoxInAddSpendMode {
    float: right;
}
</style>