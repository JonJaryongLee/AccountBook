<template>
    <div>
        <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
        <div id="setUserSpend">
            변동지출을 입력해주세요
            <v-row>
                <v-col cols="12" v-for="index in label.length" :key="index">
                    <v-text-field :label="label[index-1]" v-model="spendMoney[index-1]" type="number"></v-text-field>
                    <div id="minusBtnContainerInSetUserSpend">
                        <v-btn dark fab x-small color="red" @click="removeList(index-1)">
                            <v-icon>mdi-minus</v-icon>
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
            <div id="plusBtnContainerInSetUserSpend">
                <v-btn fab small dark color="indigo" @click="addDialogShow">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </div>
            <div id="nextBtnContainerInSetUserSpend">
                <v-btn color="teal lighten-2" @click="next">next</v-btn>
            </div>
            <v-dialog v-model="addListShow">
                <v-card height="200px">
                    <v-card-title>
                        <span class="headline">지출내역 추가</span>
                    </v-card-title>
                    <v-card-text>
                        <v-text-field v-model="newList"></v-text-field>
                        <div id="addListContainerInSetUserSpend">
                            <v-btn color="teal lighten-2" @click="addList">입력</v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        label: ['생활비', '경조사', '비상금'],
        spendMoney: [null, null, null],
        addListShow: false,
        newList: ""
    }),
    methods: {
        removeList(index) {
            this.label.splice(index, 1);
            this.spendMoney.splice(index, 1);
        },
        addDialogShow() {
            this.addListShow = true;
        },
        next() {
            this.$emit('goSetGoals');
        },
        addList() {
            this.addListShow = false;
            this.label.push(this.newList);
            this.spendMoney.push(null);
            this.newList = "";
        }
    }
}
</script>
<style>
#setUserSpend{
    padding-top: 10%;
    position: relative;
    left: 10%;
    width: 80%;
}

#minusBtnContainerInSetUserSpend {
    float: right;
    position: relative;
    bottom: 60%;
}

#plusBtnContainerInSetUserSpend {
    position: relative;
    bottom: 30px;
}

#nextBtnContainerInSetUserSpend {
    text-align: center;
    margin-bottom: 40px;
}

#addListContainerInSetUserSpend {
    float: right;
}
</style>