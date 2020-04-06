<template>
    <div>
        <div class="calendarContainer">
            <div class="calendarColumn" ref="calendarColumn" v-for="column in 7" :key="column">
                <div class="calendarTag">{{daysTag[column-1]}}</div>
                <div class="calendarItem" ref="calendarItem" v-for="row in rows" :key="row">
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
    data: () => ({
        daysTag: ["일", "월", "화", "수", "목", "금", "토"],
        rows: 6,
        thisYear: 2020,
        thisMonth: 4,
        dateOfThisMonth: [],
        spendContent: {
            1: ["+", "2,000,000"],
            3: ["-", "7,900"],
            5: ["-", "400,000"],
            7: ["-", "56,800"],
            8: ["-", "6,000"],
            9: ["-", "25,000"],
            10: ["-", "500,000"],
            12: ["-", "36,700"],
            13: ["-", "259,200"],
            14: ["-", "10,500"],
            15: ["-", "53,600"],
            16: ["-", "10,200"],
            17: ["-", "5,000"],
            20: ["-", "12,800"],
            21: ["-", "35,000"]
        },
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
        ]
    }),
    created() {

        // 캘린더에 날짜 집어넣기
        let cal, m;
        cal = new calendar.Calendar();
        m = cal.monthDays(this.thisYear, this.thisMonth - 1, function(d) { return (d.getDate()) });
        for (let i = 0; i < m.length; i++) {
            this.dateOfThisMonth.push(m[i]);
        }
        this.rows = this.dateOfThisMonth.length;

        //spendContent 나누기
        for (let i = 0; i < Object.keys(this.spendContent).length; i++) {
            let index = Object.keys(this.spendContent)[i];
            if (this.spendContent[index][0] == "+") {
                this.dateIncomeDetailNumArray[index - 1] = this.spendContent[index][1];
            } else
                this.dateExpenseDetailNumArray[index - 1] = this.spendContent[index][1];
        }
    },
    mounted(){
        //일요일 빨간색, 토요일 파란색
        this.$refs.calendarColumn[0].style.color="red";
        this.$refs.calendarColumn[6].style.color="blue";
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