<template>
    <div>
        <div class="calendarContainer">
            <div class="calendarColumn" v-for="column in 7" :key="column">
                <div class="calendarTag">title</div>
                <div class="calendarRow">2</div>
                <div class="calendarRow">3</div>
                <div class="calendarRow">4</div>
                <div class="calendarRow">5</div>
                <div class="calendarRow">6</div>
                <div class="calendarRow">7</div>
            </div>
        </div>
    </div>
</template>
<style>
.calendarColumn {
    display: inline-block;
    width: 14.285%;
}
.calendarTag{
    border:1px solid black;
    font-size: 0.5rem;
}
.calendarRow{
    border:1px solid black;
    height:40px;
}
</style>