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
                    <v-col cols="12" v-for="index in label.length" :key="index">
                        <v-text-field :label="label[index-1]" v-model="spendMoney[index-1]" type="number"></v-text-field>
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
            <setUserSpendIntro @nextPageInSetUserSpendIntro="nextPageInSetUserSpendIntro"></setUserSpendIntro>
        </div>
        <div v-if="setUserSpendShow">
            <setUserSpend @goSetGoals = "goSetGoals"></setUserSpend>
        </div>
        <div v-if="setGoalsShow">
            <setGoals></setGoals>
        </div>
    </div>
</template>
<script>
import setUserSpendIntro from './setUserSpendIntro.vue'
import setUserSpend from './setUserSpend.vue'
import setGoals from './setGoals.vue'
export default {
    components: {
        setUserSpendIntro, setUserSpend, setGoals
    },
    data: () => ({
        label: ['월세', '통신비', '공과금', '적금'],
        spendMoney: [null, null, null, null],
        userTotalProperty: null,
        incomeMonthly: null,
        addListShow: false,
        setUserPropertyShow: true,
        setUserSpendIntroShow: false,
        setUserSpendShow: false,
        setGoalsShow : false,
        newList: ""
    }),
    methods: {
        addDialogShow() {
            this.addListShow = true;
        },
        removeList(index) {
            this.label.splice(index, 1);
            this.spendMoney.splice(index, 1);
        },
        addList() {
            this.addListShow = false;
            this.label.push(this.newList);
            this.spendMoney.push(null);
            this.newList = "";
            console.log(this.label);
            console.log(this.spendMoney);
        },
        next() {
            this.setUserPropertyShow = false;
            this.setUserSpendIntroShow = true;
        },
        nextPageInSetUserSpendIntro(){
            this.setUserSpendIntroShow = false;
            this.setUserSpendShow = true;
        },
        goSetGoals(){
            this.setUserSpendShow = false;
            this.setGoalsShow = true;
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