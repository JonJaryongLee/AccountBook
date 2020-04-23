<template>
    <div id="moneyDetail">
        <div class="moneyDetailItemContainer" v-for="moneyDetailIndex in moneyDetail.moneyDetailsNum" :key="moneyDetailIndex">
            <div class="iconContainerInMoneyDetailItemContainer" ref="iconContainerInMoneyDetailItemContainer">
                <v-icon class="iconInMoneyDetail" ref="iconInMoneyDetail" color="white">{{moneyDetail.moneyDetailTagIcon[moneyDetailIndex-1]}}</v-icon>
            </div>
            <div class="moneyDetailTag caption">    
                {{moneyDetail.moneyDetailTagData[moneyDetailIndex-1]}}
            </div>
            <div class="moneyDetailContent body-2">{{moneyDetail.moneyDetailContentData[moneyDetailIndex-1]}}</div>
            <div class="moneyDetailMoney subtitle-1" ref="moneyDetailMoney">{{moneyDetailMoneyDataComma[moneyDetailIndex-1][0]}}원</div>
        </div>
        <div class="plusBtnContainer">
            <v-btn class="plus_icon mx-2" fab dark color="indigo" @click="addHistory">
                <v-icon dark>mdi-plus</v-icon>
            </v-btn>
        </div>
    </div>
</template>
<script>
export default {
    props: ['moneyDetail'],
    data: () => ({
        moneyDetailMoneyDataComma: []
    }),
    created(){
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        this.moneyDetailMoneyDataComma = this.moneyDetail.moneyDetailMoneyData;
        for(let i=0;i<this.moneyDetailMoneyDataComma.length;i++){
            this.moneyDetailMoneyDataComma[i][0] = this.numberWithCommas(this.moneyDetailMoneyDataComma[i][0]);
        }
    },
    mounted(){
        for(let i=0;i<this.moneyDetail.moneyDetailsNum;i++){
            this.$refs.iconContainerInMoneyDetailItemContainer[i].style.backgroundColor = this.moneyDetail.iconColor[i];
        }

        // 만약 수입이라면 파란색으로
        for(let i=0;i<this.moneyDetailMoneyDataComma.length;i++){
            if(this.moneyDetailMoneyDataComma[i][1]=="+"){
                this.$refs.moneyDetailMoney[i].style.color = "blue";
            }
        }
    },
    methods:{
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        addHistory(){
            this.$emit('addHistory')
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
    padding-top:2%;
}

.moneyDetailTag {
    padding-left: 2%;
    width:15%;
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

.iconContainerInMoneyDetailItemContainer{
    margin-left: 1%;
    position: relative;
    left: 1%;
    top: 15%;
    display: inline-block;
    vertical-align: top;
    background-color: #00838F;
    width:30px;
    height:30px;
    border-radius:30px;
}

.iconInMoneyDetail{
    top:10%;
    left:10%;
}
</style>