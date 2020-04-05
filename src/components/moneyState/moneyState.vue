<template>
    <div class="moneyStateBox">
        <div class="incomeAndBalanceBox">
            <div class="incomeBox">
                <div class="incomeTag body-1">
                    수입
                </div>
                <div class="incomeNum subtitle-1">
                    2,000,000원
                </div>
            </div>
            <div class="balanceBox">
                <div class="balanceTag body-1">
                    잔액
                </div>
                <div class="balanceNum subtitle-1">
                    581,300원
                </div>
            </div>
        </div>
        <div class="ExpenseAndTypeOfExpenseBox">
            <div class="expenseBox">
                <div class="expenseTag body-1">
                    지출
                </div>
                <div class="expenseNum subtitle-1">
                    1,418,700원
                </div>
            </div>
            <div class="typeOfExpenseBox caption">
                <div class="expenseTypeCashBox">
                    <div class="expenseTypeCashTag">
                        현금
                    </div>
                    <div class="expenseTypeCashNum">
                        1,418,700
                    </div>
                </div>
                <div class="expenseTypeCardBox">
                    <div class="expenseTypeCardTag">
                        카드
                    </div>
                    <div class="expenseTypeCardNum">
                        0
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
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