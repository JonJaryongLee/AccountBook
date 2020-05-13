<template>
    <div>
        <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
        <div>
            <div id="firstLineInSetUserSpendIntro" class="title">
                {{userName}}님의 남은 자산은
            </div>
            <div id="secondLineInSetUserSpendIntro">
                <div id="moneyBoxInSetUserSpendIntro" class="title">
                    {{property}}원
                </div>
                <div id="secondLineWordInSetUserSpendIntro" class="title">
                    입니다!
                </div>
            </div>
            <div id="thirdLineInSetUserSpendIntro">
                남은 금액으로 한달 생활비를 정하세요!
            </div>
            <br>
            <div id="fourthLineInSetUserSpendIntro">
                추천하는 생활비 비율은
            </div>
            <div id="fifthLineInSetUserSpendIntro">
                남은 금액에서 60%입니다.
            </div>
            <div id="firstPageBtnContainerInSetUserSpendIntro">
                <v-btn color="teal lighten-2" @click="nextPage">다음</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['property'],
    data: () => ({
        userName: "이자룡" // 추후 상위컴포넌트에서 받아올 것
    }),
    created() {
        // 고정수입과 고정지출을 상위컴포넌트에서 받아와 남은 자산 계산
        // 그것을 property에 넣음
        console.log("Don't forget the calculating!")
        this.property = this.numberWithCommas(this.property);
    },
    methods: {
        nextPage() {
            this.$emit('nextPageInSetUserSpendIntro');
        },

        //정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
}
</script>
<style>
#firstLineInSetUserSpendIntro {
    display: block;
    text-align: center;
    padding-top: 10%;
}

#secondLineInSetUserSpendIntro,
#fourthLineInSetUserSpendIntro,
#fifthLineInSetUserSpendIntro {
    text-align: center;
}

#moneyBoxInSetUserSpendIntro {
    display: inline;
    border: 2px solid grey;
    padding-left: 5%;
    border-radius: 5px;
}

#secondLineWordInSetUserSpendIntro {
    display: inline;
}

#thirdLineInSetUserSpendIntro,
#firstPageBtnContainerInSetUserSpendIntro {
    padding-top: 10%;
    text-align: center;
}
</style>