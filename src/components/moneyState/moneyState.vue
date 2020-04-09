<template>
    <div class="moneyStateBox">
        <div class="incomeAndBalanceBox">
            <div class="incomeBox">
                <div class="incomeTag body-1">
                    수입
                </div>
                <div class="incomeNum subtitle-1">
                    {{incomeWithComma}}원
                </div>
            </div>
            <div class="balanceBox">
                <div class="balanceTag body-1">
                    현금 잔액
                </div>
                <div class="balanceNum subtitle-1">
                    {{balanceWithComma}}원
                </div>
            </div>
        </div>
        <div class="ExpenseAndTypeOfExpenseBox">
            <div class="expenseBox">
                <div class="expenseTag body-1">
                    지출
                </div>
                <div class="expenseNum subtitle-1">
                    {{expenseWithComma}}원
                </div>
            </div>
            <div class="typeOfExpenseBox caption">
                <div class="expenseTypeCashBox">
                    <div class="expenseTypeCashTag">
                        현금
                    </div>
                    <div class="expenseTypeCashNum">
                        {{expenseTypeCashWithComma}}
                    </div>
                </div>
                <div class="expenseTypeCardBox">
                    <div class="expenseTypeCardTag">
                        카드
                    </div>
                    <div class="expenseTypeCardNum">
                        {{expenseTypeCardWithComma}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props: ['userData'],
    data: () => ({
        incomeWithComma: -1,
        balanceWithComma: -1,
        expenseWithComma: -1,
        expenseTypeCashWithComma: -1,
        expenseTypeCardWithComma:-1
    }),
    created(){
        this.incomeWithComma = this.numberWithCommas(this.userData.income);
        this.balanceWithComma = this.numberWithCommas(this.userData.balance);
        this.expenseWithComma = this.numberWithCommas(this.userData.expense);
        this.expenseTypeCashWithComma = this.numberWithCommas(this.userData.expenseTypeCash);
        this.expenseTypeCardWithComma = this.numberWithCommas(this.userData.expenseTypeCard);
    },
    methods:{
        // 정수형으로 들어온 돈에 콤마를 붙여줌
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
}
</script>

<style>
.moneyStateBox {
    display: flex;
    padding-top: 3px;
    height:70px;
}

.incomeAndBalanceBox,
.ExpenseAndTypeOfExpenseBox {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.incomeBox,
.balanceBox,
.expenseBox,
.typeOfExpenseBox,
.expenseTypeCashBox,
.expenseTypeCardBox {
    display: flex;
    flex-grow: 1;
}

.incomeTag,
.incomeNum,
.balanceTag,
.balanceNum,
.expenseTag,
.expenseNum,
.expenseTypeCashTag,
.expenseTypeCashNum,
.expenseTypeCardTag,
.expenseTypeCardNum {
    flex-grow: 1;
}

.incomeNum,
.balanceNum,
.expenseNum,
.expenseTypeCashNum,
.expenseTypeCardNum {
    text-align: right;
}

.balanceNum {
    color: grey;
}

.incomeNum {
    color: #4CAF50;
}

.expenseNum {
    color: #F44336;
}

.typeOfExpenseBox {
    flex-direction: column;
}

.expenseTypeCardNum {
    color: #00BCD4;
}

.incomeTag,
.balanceTag,
.expenseTag {
    padding-left: 10px;
}

.expenseTypeCashTag,
.expenseTypeCardTag {
    padding-left: 30px;
}

.expenseNum,
.expenseTypeCashNum,
.expenseTypeCardNum {
    padding-right: 10px;
}
</style>