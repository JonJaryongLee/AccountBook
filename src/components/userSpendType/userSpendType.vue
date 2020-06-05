<template>
    <div>
        <div v-if="show">
            <div id="userSpendTypeContainer">
                <br>
                <div class="title">당신의 소비유형은?</div>
                <br>
                <img height="40%" :src="image" alt="pid">
                <br>
                <br>
                <div class="font-weight-bold">{{type}}</div>
                <div class="caption">{{describe}}</div>
            </div>
            <div id="btnContainerInUserSpendType">
                <v-btn @click="goMain">뒤로가기</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data: () => ({
        show: false
    }),
    methods: {
        goMain() {
            this.$emit('goMain');
        }
    },
    created(){
        axios.get('/php/getUserType.php')
                .then(response => {
                    this.describe = response.data.describe;
                    this.type = response.data.type;
                    this.image = response.data.image;
                    this.show = true;
                })
                .catch(error => {
                    if (error)
                        console.log(error);
                });
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