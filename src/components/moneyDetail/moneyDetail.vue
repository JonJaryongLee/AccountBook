<template>
    <div id="moneyDetail">
        <div class="moneyDetailItemContainer" v-for="moneyDetailIndex in moneyDetail.moneyDetailsNum" :key="moneyDetailIndex" @click="openDialog(moneyDetailIndex-1)">
            <div class="iconContainerInMoneyDetailItemContainer" ref="iconContainerInMoneyDetailItemContainer">
                <v-icon class="iconInMoneyDetail" ref="iconInMoneyDetail" color="white">{{moneyDetail.moneyDetailTagIcon[moneyDetailIndex-1]}}</v-icon>
            </div>
            <div class="moneyDetailTag caption">
                {{moneyDetail.moneyDetailTagData[moneyDetailIndex-1]}}
            </div>
            <div class="moneyDetailContent body-2">{{moneyDetail.moneyDetailContentData[moneyDetailIndex-1]}}</div>
            <div class="moneyDetailMoney subtitle-1" ref="moneyDetailMoney">{{moneyDetailMoneyDataComma[moneyDetailIndex-1][0]}}원</div>
        </div>
        <div class="plusBtnContainer" v-if="mode=='전체'">
            <v-speed-dial v-model="fab" :direction="direction" :open-on-hover="hover" :transition="transition">
                <template v-slot:activator>
                    <v-btn class="plus_icon mx-2" v-model="fab" dark color="indigo" fab>
                        <v-icon v-if="fab" dark>mdi-close</v-icon>
                        <v-icon v-else>mdi-plus</v-icon>
                    </v-btn>
                </template>
                <v-btn fab dark small color="red" @click="addHistory('expense')">
                    <v-icon>mdi-minus</v-icon>
                </v-btn>
                <v-btn fab dark small color="green" @click="addHistory('income')">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </v-speed-dial>
        </div>
        <div>
            <v-dialog v-model="dialogShow">
                <v-card>
                    <v-card-title>
                        {{monthData.thisYear}}년 {{monthData.thisMonth}}월 {{selectedDay}}일
                    </v-card-title>
                    <v-card-text>
                        <div>
                            카테고리: {{moneyDetail.moneyDetailTagData[index]}}
                        </div>
                        <div>
                            내역: {{moneyDetail.moneyDetailContentData[index]}}
                        </div>
                        <div v-if="dialogShow">
                            금액: {{moneyDetail.moneyDetailMoneyData[index][0]}}원
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                        <div id="deleteBtnInMoneyDetail">
                            <v-btn color="error" @click="deleteDetail">삭제</v-btn>
                        </div>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>
<script>
export default {
    props: ['moneyDetail', 'monthData', 'selectedDay', 'mode'],
    data: () => ({
        moneyDetailMoneyDataComma: [],
        direction: 'top',
        fab: false,
        fling: false,
        hover: false,
        tabs: null,
        transition: 'slide-y-reverse-transition',
        dialogShow: false
    }),
    created() {
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        this.moneyDetailMoneyDataComma = this.moneyDetail.moneyDetailMoneyData;
        for (let i = 0; i < this.moneyDetailMoneyDataComma.length; i++) {
            this.moneyDetailMoneyDataComma[i][0] = this.numberWithCommas(this.moneyDetailMoneyDataComma[i][0]);
        }
    },
    mounted() {
        for (let i = 0; i < this.moneyDetail.moneyDetailsNum; i++) {
            this.$refs.iconContainerInMoneyDetailItemContainer[i].style.backgroundColor = this.moneyDetail.iconColor[i];
        }

        // 만약 수입이라면 파란색으로
        for (let i = 0; i < this.moneyDetailMoneyDataComma.length; i++) {
            if (this.moneyDetailMoneyDataComma[i][1] == "+") {
                this.$refs.moneyDetailMoney[i].style.color = "blue";
            }
        }
    },
    methods: {
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        addHistory(flag) {
            this.$emit('addHistory', flag);
        },
        openDialog(index) {
            if(this.mode!="전체")
                return;
            this.index = index;
            this.dialogShow = true;
        },
        dialogClose() {
            this.dialogShow = false;
        },
        deleteDetail(){
            this.$emit('deleteDetail', {
                'thisYear': this.monthData.thisYear,
                'thisMonth': this.monthData.thisMonth,
                'today': this.selectedDay,
                'index': this.index
            }),
            this.dialogShow = false;
        }
    }
}
</script>
<style>
.moneyDetailTag,
.moneyDetailContent,
.moneyDetailMoney {
    display: inline-block;
    height: 100%;
    padding-top: 2%;
}

.moneyDetailTag {
    padding-left: 2%;
    width: 15%;
}

.moneyDetailContent {
    width: 50%;
}

.moneyDetailMoney {
    color: #F06292;
}

.plusBtnContainer {
    position: fixed;
    top: 75%;
    left: 78%;
}

.moneyDetailItemContainer {
    height: 40px;
    border-bottom: 1px solid #DCDCDC;
}

.iconContainerInMoneyDetailItemContainer {
    margin-left: 1%;
    position: relative;
    left: 1%;
    top: 15%;
    display: inline-block;
    vertical-align: top;
    background-color: #00838F;
    width: 30px;
    height: 30px;
    border-radius: 30px;
}

.iconInMoneyDetail {
    top: 10%;
    left: 10%;
}

#deleteBtnInMoneyDetail {
    text-align: right;
    padding: 5px;
}
</style>