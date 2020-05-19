<template>
    <div id="calendarIncome">
        <div class="day" ref="day" v-for="(day,index) in days" :key="`A-${index}`">{{day}}</div>
        <v-divider></v-divider>
        <div class="number" ref="number" v-for="(number,index) in dateOfThisMonth" :key="`B-${index}`" @click="selectDay(number)">
            <div>{{number}}</div>
            <div class="moneyPart">{{dateIncomeMoneyDetailNumArray[number-1]}}</div>
            <div class="timePart">{{dateIncomeTimeDetailNumArray[number-1]}}</div>
        </div>
        <v-divider></v-divider>
        <div class="totalInfo headline">
            {{monthData.thisMonth}}월 수입 <div class="moneyBox">{{totalIncome}}</div> 원
        </div>
        <div>
            <v-dialog v-model="dialogShow">
                <v-card>
                    <v-card-title>수입 추가</v-card-title>
                    <v-card-text>
                        <div class="radioBox">
                            <v-radio-group v-model="radio">
                                <v-radio label="일급" @click="radioClick(0)"></v-radio>
                                <v-radio label="시급" @click="radioClick(1)"></v-radio>
                            </v-radio-group>
                        </div>
                        <div class="inputBoxContainer">
                            <div class="inputBox">
                                <input class="input" v-model="userInputMoney" type='number' :disabled="numberDisable">
                            </div>
                            <div class="inputBox">
                                <input class="input" v-model="userInputTime" type="number" :disabled="timeDisable">
                            </div>
                        </div>
                        <div class="tagContainer">
                            <div>원</div>
                            <div class="timeTag">시간</div>
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <div class="btnContainer">
                        <v-btn class="addBtn" color="primary">추가</v-btn>
                        <v-btn color="error" @click="close">취소</v-btn>
                    </div>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>
<script>
import calendar from 'calendar'
export default {
    data: () => ({
        days: ['일', '월', '화', '수', '목', '금', '토'],
        dateOfThisMonth: [],
        monthData: {
            thisYear: 2020,
            thisMonth: 5
        },
        dateIncomeMoneyDetailNumArray: [
            20000, null, null, 80000, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, 13000, null,
            null, null, null, null, null,
            null, null, null, null, null, 70000
        ],
        dateIncomeTimeDetailNumArray: [
            1, null, null, 3, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, 2.5, null,
            null, null, null, null, null,
            null, null, null, null, null, 1
        ],
        totalIncome: 3000000,
        dialogShow: false,
        selectedNumber: -1,
        radio: 0,
        userInputTime: null,
        userInputMoney: null,
        numberDisable: false,
        timeDisable: true
    }),
    methods: {
        selectDay(number) {
            if (number == null)
                return;
            this.selectedNumber = number;
            this.dialogShow = true;
        },
        radioClick(v) {
            this.radio = v;
            if(v == 0){
                this.timeDisable=true;
                this.numberDisable=false;
                this.userInputTime = null;
            }
            else{
                this.timeDisable=false;
                this.numberDisable=true;
                this.userInputMoney = null;
            }
        },
        close() {
            this.dialogShow = false;
            this.radio = 0;
        },
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    },
    created() {
        // 캘린더에 날짜 집어넣기
        let cal, m;
        cal = new calendar.Calendar();
        m = cal.monthDays(this.monthData.thisYear, this.monthData.thisMonth - 1, function(d) { return (d.getDate()) });
        for (let i = 0; i < m.length; i++) {
            for (let j = 0; j < m[i].length; j++) {
                this.dateOfThisMonth.push(m[i][j]);
            }
        }
        for (let i = this.dateOfThisMonth.length - 1; i >= 0; i--) {
            if (this.dateOfThisMonth[i] == 0)
                this.dateOfThisMonth[i] = null
        }
        this.totalIncome = this.numberWithCommas(this.totalIncome);
        for (let i = this.dateIncomeMoneyDetailNumArray.length - 1; i >= 0; i--) {
            if(this.dateIncomeMoneyDetailNumArray[i])
            this.dateIncomeMoneyDetailNumArray[i] = this.numberWithCommas(this.dateIncomeMoneyDetailNumArray[i]);
        }
        for (let i = this.dateIncomeTimeDetailNumArray.length - 1; i >= 0; i--) {
            if(this.dateIncomeTimeDetailNumArray[i]!=null)
                this.dateIncomeTimeDetailNumArray[i]= this.dateIncomeTimeDetailNumArray[i].toString()+"시간";
        }
    },
    mounted(){
        this.$refs.day[0].style.color="red";
        this.$refs.day[6].style.color="blue";

        this.$refs.number[0].style.color="red";
        this.$refs.number[7].style.color="red";
        this.$refs.number[14].style.color="red";
        this.$refs.number[21].style.color="red";
        if(this.$refs.number[28])
            this.$refs.number[28].style.color="red";
        if(this.$refs.number[35])
            this.$refs.number[35].style.color="red";

        this.$refs.number[6].style.color="blue";
        this.$refs.number[13].style.color="blue";
        this.$refs.number[20].style.color="blue";
        this.$refs.number[27].style.color="blue";
        if(this.$refs.number[34])
            this.$refs.number[34].style.color="blue";
        if(this.$refs.number[41])
            this.$refs.number[41].style.color="blue";
    }
}
</script>
<style scoped>
.day {
    display: inline-block;
    vertical-align: top;
    width: 14.28%;
    text-align: left;
    color: black;
}

.number {
    display: inline-block;
    vertical-align: top;
    width: 14.28%;
    height: 80px;
}

.number:hover {
    background-color: #C5CAE9;
    color: white;
}

.moneyPart {
    height: 20px;
    color: #673AB7;
}

.timePart {
    height: 20px;
    font-size: 0.5rem;
    color: #607D8B;
}

.totalInfo {
    text-align: center;
    padding: 20px;
}

.moneyBox {
    display: inline;
    padding-right: 10px;
    padding-left: 10px;
    border: 1px solid gray;
    border-radius: 5px;
}

.btnContainer {
    padding: 10px;
    text-align: right;
}

.addBtn {
    margin-right: 10px;
}

.radioBox{
    display: inline-block;
    vertical-align: top;
}

.inputBoxContainer{
    display: inline-block;
    vertical-align: top;
    width:65%;
}

.inputBox{
    border:1px solid grey;
    border-radius: 5px;
    margin: 10px;
    position: relative;
    top:8px;

}

.tagContainer{
    position: relative;
    display: inline-block;
    vertical-align: top;
    top: 20px;
}

.timeTag{
    position: relative;
    top:10px;
}

.input{
    text-align: right;
    width: 95%;
}
</style>