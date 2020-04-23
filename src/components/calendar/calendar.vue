<template>
    <div>
        <div class="calendarContainer">
            <div class="calendarColumn" ref="calendarColumn" v-for="column in 7" :key="column">
                <div class="calendarTag">{{daysTag[column-1]}}</div>
                <div 
                    class="calendarItem" 
                    ref="calendarItem" 
                    v-for="row in rows" 
                    :key="row" 
                    @click="printMoneyDetail(row,column)">
                    <div class="dateNum" v-if="dateOfThisMonth[row-1][column-1]">
                        {{dateOfThisMonth[row-1][column-1]}}
                    </div>
                    <div class="dateIncomeDetail">
                        {{dateIncomeDetailNumArray[dateOfThisMonth[row-1][column-1]-1]}}
                    </div>
                    <div class="dateExpenseDetail">
                        {{dateExpenseDetailNumArray[dateOfThisMonth[row-1][column-1]-1]}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import calendar from 'calendar'
export default {
    props: ['monthData'],
    data: () => ({
        daysTag: ["일", "월", "화", "수", "목", "금", "토"],
        rows: 6,
        dateOfThisMonth: [],
        dateIncomeDetailNumArray: [
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null, null
        ],
        dateExpenseDetailNumArray: [
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null,
            null, null, null, null, null, null
        ],
        sepndContentWithComma: {}
    }),
    created() {

        // 캘린더에 날짜 집어넣기
        let cal, m, index;
        cal = new calendar.Calendar();
        m = cal.monthDays(this.monthData.thisYear, this.monthData.thisMonth - 1, function(d) { return (d.getDate()) });
        for (let i = 0; i < m.length; i++) {
            this.dateOfThisMonth.push(m[i]);
        }
        this.rows = this.dateOfThisMonth.length;

        //정수형으로 들어온 돈에 콤마 붙이기
        this.sepndContentWithComma = this.monthData.spendContent;
        for(let i=0;i<Object.keys(this.sepndContentWithComma).length; i++) {
            index = Object.keys(this.sepndContentWithComma)[i];
            this.sepndContentWithComma[index][0] = this.numberWithCommas(this.sepndContentWithComma[index][0]);
        }

        //spendContent 나누기
        for (let i = 0; i < Object.keys(this.sepndContentWithComma).length; i++) {
            index = Object.keys(this.sepndContentWithComma)[i];
            if (this.sepndContentWithComma[index][1] == "+") {
                this.dateIncomeDetailNumArray[index - 1] = this.sepndContentWithComma[index][0];
            } else
                this.dateExpenseDetailNumArray[index - 1] = this.sepndContentWithComma[index][0];
        }
    },
    mounted(){
        //일요일 빨간색, 토요일 파란색
        this.$refs.calendarColumn[0].style.color="red";
        this.$refs.calendarColumn[6].style.color="blue";
    },
    methods:{
        printMoneyDetail(row,column){
            let date = this.dateOfThisMonth[row-1][column-1];
            if(date==0)
                return;
            else{
                //axios통신으로 this.monthDate.thisYear, this.monthDate.thisMonth, date 넘겨주고
                //해당 날짜의 moneyDetail정보를 받아옴
                //그걸 Main으로 넘겨줌
                //this.$emit('printMoneyDetail',moneyDetail);
                this.$emit('daySelect',date);
            }
        },
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
}
</script>
<style>
.calendarContainer {
    border-bottom: 1px solid grey;
}

.calendarColumn {
    display: inline-block;
    vertical-align: top;
    width: 14.285%;
}

.calendarTag {
    border-bottom: 1px solid grey;
    font-size: 0.5rem;
    color: grey;
    text-align: center;
}

.calendarItem {
    text-align: center;
    height: 40px;
    padding-bottom: 50px;
}

.dateNum {
    font-size: 0.8rem;
    font-weight: bold;
}

.dateIncomeDetail,
.dateExpenseDetail {
    font-size: 0.5rem;
    height: 10px;
}

.dateIncomeDetail {
    color: #4CAF50;
}

.dateExpenseDetail {
    color: #F44336;
}

.calendarItem:hover {
    background-color:#F8BBD0;
    color:white;
}
</style>