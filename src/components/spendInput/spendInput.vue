<template>
    <div>
        <div v-if="btnShow">
            <div id="moneyBoxInSpendInput">
                <input type="number" id="inputInMoneyBoxInSpendInput" v-model="userInputMoney">
            </div>
            <div id="wonLetterInSpendInput">원</div>
            <div id="contentInSpendInput">{{selectedCategoryName}}</div>
            <div id="contentInputBoxInSpendInput">
                <input type="text" id="spendContentInput" v-model="content" @click="contentReset()">
            </div>
            <div id="btnContainerInSpendInput">
                <v-btn @click="dialogOpen" color="green">등록</v-btn>
            </div>
        </div>
        <div id="iconListInSpendInput" v-if="iconShow">
            <div class="iconsInSpendInput" v-for="(iconName,index) in iconNames" :key="index" @click="iconSelect(iconName[0])">
                <v-icon :color="iconName[2]" large>{{iconName[1]}}</v-icon>
                <div>{{iconName[0]}}</div>
            </div>
        </div>
        <v-dialog persistent v-model="dialogShow">
            <v-btn color="green" @click="registerSpend('카드')">카드</v-btn>
            <v-btn color="blue" @click="registerSpend('현금')">현금</v-btn>
        </v-dialog>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data: () => ({
        selectedCategoryName: "내역",
        userInputMoney: null,
        dialogShow: false,
        iconShow: false,
        mode: 'upper',
        btnShow: false,
        content: "상세내역을 입력해주세요"
    }),
    created() {
        axios.post('/php/getCategory.php', {
                'mode': 'upper'
            }).then(response => {
                this.iconNames = response.data.iconNames;
                this.iconShow = true;
            })
            .catch(error => {
                if (error)
                    console.log("실패!");
            });
    },
    methods: {
        iconSelect(name) {
            this.selectedCategoryName = name;
            if (this.mode == "upper") {
                this.mode = 'lower';
                this.iconShow = false;
                this.btnShow = true;
                axios.post('/php/getCategory.php', {
                        'mode': name
                    }).then(response => {
                        this.iconNames = [];
                        this.iconNames = response.data.iconNames;
                        this.iconShow = true;
                    })
                    .catch(error => {
                        if (error)
                            console.log("실패!");
                    });
            }
        },
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        dialogOpen() {
            if (this.content == "")
                return;
            this.dialogShow = true;
        },
        registerSpend(payType) {
            this.dialogShow = false;
            console.log(payType);
            // axios로 해당 날짜에 해당되는 지출내역을 송신
            // 금액, 종류, 카드인지 현금인지
            // 그리고 getMoneyDetail.php에서 받은것처럼 받아 화면에 붙일 것

            // 추후에 받은 데이터를 변수로 추가할 것
            this.$emit('registerSpend', {
                'money': Number(this.userInputMoney),
                'category': this.selectedCategoryName,
                'content': this.content,
                'payType': payType
            });
        },
        contentReset() {
            this.content = "";
        }
    }
}
</script>
<style>
#inputInMoneyBoxInSpendInput {
    height: 100%;
    width: 107%;
    text-align: right;
    font-size: 1.5rem;
    padding-right: 5%;
}

#moneyBoxInSpendInput,
#contentInSpendInput {
    border: 1px solid grey;
    border-radius: 10px;
}

#moneyBoxInSpendInput {
    display: inline-block;
    width: 80%;
    margin-top: 10%;
    margin-left: 10%;
    text-align: right;
    padding-right: 5%;
    height: 40px;
}

#wonLetterInSpendInput {
    display: inline-block;
    vertical-align: top;
    margin-top: 11%;
    margin-left: 1%;
    font-size: 1.5rem;
}

#contentInSpendInput {
    display: inline-block;
    width: 80%;
    margin-top: 5%;
    margin-left: 10%;
    padding-left: 2%;
}

#iconListInSpendInput {
    margin-top: 10%;
    margin-bottom: 5%;
}

.iconsInSpendInput {
    display: inline-block;
    width: 20%;
    height: 100px;
    vertical-align: top;
    text-align: center;
    padding-top: 5%;
}

.iconsInSpendInput:hover {
    background-color: #F8BBD0;
    color: white;
}

#btnContainerInSpendInput {
    text-align: center;
    margin-top: 10px;
}

#contentInputBoxInSpendInput {
    border: 1px solid grey;
    border-radius: 10px;
    display: inline-block;
    width: 80%;
    margin-top: 5%;
    margin-left: 10%;
    padding-left: 2%;
}

#spendContentInput {
    height: 100%;
    width: 107%;
    text-align: left;
    color: grey;
}
</style>