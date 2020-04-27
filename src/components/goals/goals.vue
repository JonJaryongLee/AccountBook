<template>
    <div id="goalsContainer">
        <div>적금 1년 넣기</div>
        <v-progress-linear v-model="goals1" color="green" height="25" reactive>
            <strong>{{ Math.ceil(goals1) }}%</strong>
        </v-progress-linear>
        <br>
        <div>하루 식비 5,000원</div>
        <v-progress-linear v-model="goals2" color="blue" height="25" reactive>
            <strong>{{ Math.ceil(goals2) }}%</strong>
        </v-progress-linear>
    </div>
</template>
<script>
export default {
    data: () => ({
        goals1: 23,
        goals2: 82,
    }),
    methods: {

    }
}
</script>
<style>
#goalsContainer{
    margin: 5%;
}
</style>