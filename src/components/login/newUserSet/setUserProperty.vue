<template>
    <div>
        <div v-if="setUserPropertyShow">
            <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
            <div id="setUserProperty">
                <v-row>
                    <v-col cols="12">
                        <v-text-field label="현재 총 자산" required v-model="userTotalProperty" type="number"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field label="고정수입" required v-model="incomeMonthly" type="number"></v-text-field>
                    </v-col>
                    고정지출
                    <v-col cols="12" v-for="index in spendFixedListLabel.length" :key="index">
                        <v-text-field :label="spendFixedListLabel[index-1]" v-model="spendFixedListMoney[index-1]" type="number"></v-text-field>
                        <div id="minusBtnContainerInSetUserProperty">
                            <v-btn dark fab x-small color="red" @click="removeList(index-1)">
                                <v-icon>mdi-minus</v-icon>
                            </v-btn>
                        </div>
                    </v-col>
                </v-row>
                <div id="plusBtnContainerInSetUserProperty">
                    <v-btn fab small dark color="indigo" @click="addDialogShow">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </div>
            </div>
            <div id="nextBtnContainerInSetUserProperty">
                <v-btn color="teal lighten-2" @click="next">next</v-btn>
            </div>
            <v-dialog v-model="addListShow">
                <v-card height="200px">
                    <v-card-title>
                        <span class="headline">지출내역 추가</span>
                    </v-card-title>
                    <v-card-text>
                        <v-text-field v-model="newList"></v-text-field>
                        <div id="addListContainerInSetUserProperty">
                            <v-btn color="teal lighten-2" @click="addList">입력</v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
        <div v-if="setUserSpendIntroShow">
            <setUserSpendIntro @nextPageInSetUserSpendIntro="nextPageInSetUserSpendIntro" :property="property"></setUserSpendIntro>
        </div>
        <div v-if="setUserSpendShow">
            <setUserSpend @goSetGoals="goSetGoals"></setUserSpend>
        </div>
        <div v-if="setGoalsShow">
            <setGoals @goMain="goMain"></setGoals>
        </div>
    </div>
</template>
<script>
import setUserSpendIntro from './setUserSpendIntro.vue'
import setUserSpend from './setUserSpend.vue'
import setGoals from './setGoals.vue'
export default {
    components: {
        setUserSpendIntro,
        setUserSpend,
        setGoals
    },
    data: () => ({
        spendFixedListLabel: ['월세', '통신비', '공과금', '적금'],
        spendFixedListMoney: [null, null, null, null],
        userTotalProperty: null,
        incomeMonthly: null,
        addListShow: false,
        setUserPropertyShow: true,
        setUserSpendIntroShow: false,
        setUserSpendShow: false,
        setGoalsShow: false,
        newList: "",
        property: 0
    }),
    methods: {
        addDialogShow() {
            this.addListShow = true;
        },
        removeList(index) {
            this.spendFixedListLabel.splice(index, 1);
            this.spendFixedListMoney.splice(index, 1);
        },
        addList() {
            this.addListShow = false;
            this.spendFixedListLabel.push(this.newList);
            this.spendFixedListMoney.push(null);
            this.newList = "";
        },
        next() {
            let spendFixedList = [[],[]];
            spendFixedList[0] = this.spendFixedListLabel;
            spendFixedList[1] = this.spendFixedListMoney;
            this.$emit('saveSpendFixedList', spendFixedList);
            this.setUserPropertyShow = false;
            this.setUserSpendIntroShow = true;
        },
        nextPageInSetUserSpendIntro() {
            this.setUserSpendIntroShow = false;
            this.setUserSpendShow = true;
        },
        goSetGoals(data) {
            this.spendFlaxibleList = data;
            this.setUserSpendShow = false;
            this.setGoalsShow = true;
        },
        goMain(goals) {
            this.$emit('goMain',[goals,this.userTotalProperty,this.incomeMonthly,this.spendFixedList,this.spendFlaxibleList]);

        }
    }
}
</script>
<style>
#setUserProperty {
    position: relative;
    left: 10%;
    width: 80%;
}

#plusBtnContainerInSetUserProperty {
    position: relative;
    bottom: 30px;
}

#minusBtnContainerInSetUserProperty {
    float: right;
    position: relative;
    bottom: 60%;
}

#addListContainerInSetUserProperty {
    float: right;
}

#nextBtnContainerInSetUserProperty {
    text-align: center;
    margin-bottom: 40px;
}
</style>