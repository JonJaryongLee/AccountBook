<template>
    <div id="moneyDetail">
        <div class="moneyDetailItemContainer" v-for="moneyDetailIndex in moneyDetailsNum" :key="moneyDetailIndex">
            <div class="iconContainerInMoneyDetailItemContainer" ref="iconContainerInMoneyDetailItemContainer">
                <v-icon class="iconInMoneyDetail" ref="iconInMoneyDetail" color="white">{{moneyDetailTagIcon[moneyDetailIndex-1]}}</v-icon>
            </div>
            <div class="moneyDetailTag caption">    
                {{moneyDetailTagData[moneyDetailIndex-1]}}
            </div>
            <div class="moneyDetailContent body-2">{{moneyDetailContentData[moneyDetailIndex-1]}}</div>
            <div class="moneyDetailMoney subtitle-1">{{moneyDetailMoneyData[moneyDetailIndex-1]}}</div>
        </div>
        <div class="plusBtnContainer">
            <v-btn class="plus_icon mx-2" fab dark color="indigo">
                <v-icon dark>mdi-plus</v-icon>
            </v-btn>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        moneyDetailsNum: 4,
        moneyDetailTagData: ["경조사","카페","교통비","기타"],
        moneyDetailTagIcon: ["mdi-account-group","mdi-coffee","mdi-bus","mdi-minus"],
        iconColor: ["#FFEB3B","#00838F","#E57373","#F44336"],
        moneyDetailContentData: ["생일", "스타벅스", "택시", "에어팟"],
        moneyDetailMoneyData: ["80,000원","4,500원","4,700원","170,000원"]
    }),
    mounted(){
        for(let i=0;i<this.moneyDetailsNum;i++){
            this.$refs.iconContainerInMoneyDetailItemContainer[i].style.backgroundColor = this.iconColor[i];
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