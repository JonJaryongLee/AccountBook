<template>
    <div>
        <div id="incomeCategorySetContainer">
            <div id="line1ContainerInIncomeCategorySetContainer">
                <v-text-field label="고정수입" id="line1InputInIncomeCategorySet" type="number" v-model="incomeFixed">400,000</v-text-field>
            </div>
            <div>
                <v-text-field id="line2InputInIncomeCategorySet" label="변동수입 - 시급설정" type="number" v-model="incomeFlexible">8,000</v-text-field>
                <div id="btnInIncomeCategorySet">
                    <v-btn @click="test">확인</v-btn>
                </div>
            </div>
        </div>
        <div id="alertContainerInIncomeCategorySet">
            <v-alert  type="success" v-if="setSuccessAlertShow"> 저장했습니다.</v-alert>
        </div>
    </div>
</template>.;
<script>
export default {
    data: () => ({
        incomeFixed: null,
        incomeFlexible: null,
        setSuccessAlertShow: false
    }),
    methods: {
        test() {
            //axios 송신
            this.setSuccessAlertShow = true;
            setTimeout(() => {
                this.setSuccessAlertShow = false;
            }, 2000);
        }
    }
}
</script>
<style>
#incomeCategorySetContainer {
    text-align: center;
    padding-left: 40px;
    padding-right: 40px;
}

#btnInIncomeCategorySet {
    margin-top: 20px;
    text-align: center;
}

#alertContainerInIncomeCategorySet{
    margin-top: 50px;
}
</style>