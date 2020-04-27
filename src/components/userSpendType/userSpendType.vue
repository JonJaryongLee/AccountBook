<template>
    <div>
        <div id="userSpendTypeContainer">
            <br>
            <div class="title">당신의 소비유형은?</div>
            <br>
            <img height="40%" src="pigIMG.png" alt="pid">
            <br>
            <br>
            <div class="font-weight-bold">저축형</div>
            <div class="caption">불필요한 소비를 줄이고 합리적인 저축!</div>
        </div>
        <div id="btnContainerInUserSpendType">
            <v-btn @click="goMain">뒤로가기</v-btn>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({

    }),
    methods: {
        goMain(){
            this.$emit('goMain');
        }
    }
}
</script>
<style>
#userSpendTypeContainer {
    border: 1px solid black;
    text-align: center;
    margin: 10%;
    height: 300px;
}

#btnContainerInUserSpendType {
    text-align: center;
}

</style>