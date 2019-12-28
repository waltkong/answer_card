<template>

    <view class="container">
        <view class="start_answer" @tap="startAnswer">
            <text>
                开始答题
            </text>
        </view>
    </view>


</template>

<script>
    export default {
        name:"ExamIndex",
        computed: {},
        components: {},
        onLoad(params) {
            this.params = params
        },
        data(){
            return {
                params:{exam_id:'',},
                data_list:[
                ],
                img_mode:"aspectFit",
                is_reach_bottom:false,
            };
        },
        methods:{
            startAnswer(id){
                uni.navigateTo({
                    url: '/pages/exam/exam_question_page?exam_id='+id+"&question_index=1",
                });
            }
        }
    }
</script>

<style>
    .container{
        padding: 20px 50px;

        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .start_answer{
        width: 150px;
        height: 150px;
        background-color: rgb(200,200,200);

        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

</style>
