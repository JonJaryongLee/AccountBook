<template>
    <div>
        <div id="chartContainerInChart" v-if="chartShow">
            <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource="dataSource" ref="fc" @dataPlotClick="onSliceClick"></fusioncharts>
        </div>
        <div v-if="detailShow">
            <div class="chartListInChart" v-for="(expenseList, index) in expenseLists" :key="index">
                <div class="dateInChartListInChart">{{expenseList[0]}}</div>
                <div class="contentInChartListInChart">{{expenseList[1]}}</div>
                <div class="moneyInChartListInChart">{{expenseList[2]}}</div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    props: ['thisMonth'],
    data: () => ({
        chartShow: false,
        detailShow: false,
        type: 'pie2d',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
            chart: {
                "caption": "생활비",
                "plottooltext": "$label <b>$value</b>원",
                "showLegend": "0",
                "showPercentValues": "1",
                "useDataPlotColorForLabels": "1",
                "enableMultiSlicing": "0",
                "theme": "fusion",
            },
            data: []
        }
    }),
    created() {
        axios.post('/php/getSpendChartData.php', {
                'month': this.thisMonth,
                'tag': '생활비'
            }).then(response => {
                this.dataSource.data = response.data;
                this.chartShow = true;
            })
            .catch(error => {
                if (error)
                    console.log("실패!");
            });
    },
    methods: {
        onSliceClick(e) {
            this.detailShow = false;
            let label = e.data.categoryLabel;
            axios.post('/php/getSpendChartDataDetail.php', {
                    'month': this.thisMonth,
                    'tag': "생활비",
                    'minorTag': label
                }).then(response => {
                    this.expenseLists = response.data.expenseLists;
                    this.detailShow = true;
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                });
        }
    }
}
</script>
<style>
#chartContainerInChart {
    border-bottom: 2px solid gray;
}

.chartListInChart {
    border-bottom: 1px solid grey;
    text-align: center;
}

.dateInChartListInChart,
.contentInChartListInChart,
.moneyInChartListInChart {
    display: inline-block;
    vertical-align: top;
    width: 33.33%;
    font-size: 1.2rem;
}
</style>