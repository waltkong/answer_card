<template>
    <view class="container">

        <view class="question_index_card scroll-view-item">

            <view class="question_index_card_item" v-for="(item, index) in questionIndexes" :key="index">
                <text>  {{item}}</text>
            </view>

        </view>



    </view>
</template>

<script>
    export default {
        name:"ExamQuestionIndex",
        computed: {},
        components: {},
        onLoad(params) {
            this.params = params
        },
        data(){
            return {
                questionIndexes:[
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                    1,2,3,4,5,6,7,8,9,10,11,12,12,13,14,15,16,17,18,
                ],
            }
        },
        methods:{

        }
    }
</script>

<style>
    .question_index_card{
        background-color: white;
        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .question_index_card_item{
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #8f8f94;

        font-size: large;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }
</style>
