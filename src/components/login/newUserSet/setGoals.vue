<template>
    <div>
        <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
        <div id="setGoalContainer">
            <div class="headline">목표를 설정해주세요!</div>
            <br>
            <div id="selectBoxInSetGoals">
                <div v-for="index in goals.length" :key="index">
                    <div id="checkBoxContainerInSetGoals">
                        <v-checkbox v-model="checked[index-1]"></v-checkbox>
                    </div>
                    <div id="goalsListContainerInSetGoals">
                        {{goals[index-1]}}
                    </div>
                </div>
            </div>
            <div>
                <v-btn color="teal lighten-2" @click="goMain">시작하기</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        goals: [
            '일년 적금 들기',
            '100만원 모으기',
            '일주일에 외식 한번',
            '카페 일주일 두번',
            '전세집 자금 마련하기'
        ],
        checked:[false,false,false,false,false]
    }),
    methods: {
        goMain(){
            console.log("goMain")
            console.log(this.checked);
        }
    }
}
</script>
<style>
#setGoalContainer {
    margin-top: 10%;
    text-align: center;
}

#selectBoxInSetGoals {
    border: 2px solid gray;
    border-radius: 5px;
    display: inline-block;
    width: 70%;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
    margin-top: 10%;
    margin-bottom: 10%;
    text-align: left;
}

#checkBoxContainerInSetGoals {
    display: inline-block;
    position: relative;
    top:3px;
}

#goalsListContainerInSetGoals{
    display: inline;
}
</style>