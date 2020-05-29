<template>
    <div>
        <div class="calendarContainer">
            <div 
            	class="calendarColumn" 
            	ref="calendarColumn" 
            	v-for="column in 7" 
            	:key="column"
            >
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
        m = cal.monthDays(
        	this.monthData.thisYear, 
        	this.monthData.thisMonth - 1, 
        	function(d) { return (d.getDate()) }
        );
        for (let i = 0; i < m.length; i++) {
            this.dateOfThisMonth.push(m[i]);
        }
        this.rows = this.dateOfThisMonth.length;

        //정수형으로 들어온 돈에 콤마 붙이기
        this.sepndContentWithComma = this.monthData.spendContent;
        for(let i=0;i<Object.keys(this.sepndContentWithComma).length; i++) {
            index = Object.keys(this.sepndContentWithComma)[i];
            this.sepndContentWithComma[index][0] 
            	= this.numberWithCommas(this.sepndContentWithComma[index][0]);
            this.sepndContentWithComma[index][2] 
            	= this.numberWithCommas(this.sepndContentWithComma[index][2]);
        }

        //spendContent 나누기
        for (let i = 0; i < Object.keys(this.sepndContentWithComma).length; i++) {
            index = Object.keys(this.sepndContentWithComma)[i];
            this.dateIncomeDetailNumArray[index - 1] 
            	= this.sepndContentWithComma[index][0];
            if(this.dateIncomeDetailNumArray[index-1]==0)
                this.dateIncomeDetailNumArray[index-1] = null;
            this.dateExpenseDetailNumArray[index - 1] 
            	= this.sepndContentWithComma[index][2];
            if(this.dateExpenseDetailNumArray[index-1]==0)
                this.dateExpenseDetailNumArray[index-1] = null; 
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
                this.$emit('printMoneyDetail',date);
            }
        },
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
}
</script>