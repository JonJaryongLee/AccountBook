<template>
    <div id="moneyDetail">
        <div class="moneyDetailItemComtainer" v-for="moneyDetailIndex in moneyDetailsNum" :key="moneyDetailIndex">
            <div class="moneyDetailTag caption">{{moneyDetailTagData[moneyDetailIndex-1]}}</div>
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
        moneyDetailContentData: ["생일", "스타벅스", "택시", "에어팟"],
        moneyDetailMoneyData: ["80,000원","4,500원","4,700원","170,000원"]
    })
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
    width: 25%;
}

.moneyDetailContent {
    width: 45%;
}

.moneyDetailMoney {
    width: 30%;
    color: #F06292;
}

.plusBtnContainer {
    position: fixed;
    top: 75%;
    left: 78%;
}

.moneyDetailItemComtainer {
    height: 40px;
    border-bottom: 1px solid #DCDCDC;
}
</style>