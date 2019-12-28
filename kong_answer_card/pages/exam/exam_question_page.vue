<template>
    <view class="container">
        <view class="duration_box">
            <text>已作答时间：23分12秒</text>
        </view>
        <view class="question_header_box">
            <view class="question_type_box">
                <text>{{questionTypeMap[data_row.type]}}</text>
            </view>
            <view class="question_card_box" @tap="goToQuestionIndexPage">
                <text>答题卡</text>
            </view>
        </view>

        <view class="question_body_box">
            <view class="question_title_box">
                <text>{{data_row.question}}</text>
            </view>

            <template v-if="data_row.type === 1">
                <radio-group @change="radioChange">
                    <view class="question_choices" v-for="(item, index) in data_row.choices" :key="index">
                        <view class="question_choice">
                           <label class="radio">
                               <radio :value="item.code" :checked="false" />{{item.code}}:{{item.name}}
                           </label>
                        </view>
                    </view>
                </radio-group>
            </template>

            <template v-if="data_row.type === 2">
                <checkbox-group @change="checkboxChange">
                    <view class="question_choices" v-for="(item, index) in data_row.choices" :key="index">
                        <view class="question_choice">
                            <label>
                                <checkbox :value="item.code" :checked=item.checked />{{item.code}}:{{item.name}}
                            </label>
                        </view>
                    </view>
                </checkbox-group>
            </template>

            <template v-if="data_row.type === 3 || data_row.type === 4">
                <view class="uni-textarea">
                    <view class="uni-textarea">
                        <textarea @blur="bindTextAreaBlur" auto-height
                                  placeholder-style="color:rgb(200,200,200)" placeholder="输入答案"/>
                    </view>
                </view>
            </template>

        </view>

        <view class="question_jump_box">
            <view class="question_jump_box_item question_collect_box">
                <text>收藏</text>
            </view>
            <view class="question_jump_box_item question_important_box">
                <text>重要</text>
            </view>
            <view class="question_jump_box_item prev_one_box">
                <text>上一题</text>
            </view>
            <view class="question_jump_box_item next_one_box">
                <text>下一题</text>
            </view>

        </view>

        <view class="notation_box">

            <view class="notation_title_box">
                <text> 解析:</text>
            </view>

            <view class="notation_desc_box">
                <text>简单易懂注释详尽的nvue新手向使用示例,简单易懂注释详尽的n
                    vue新手向使用示例,简单易懂注释详尽的nvue新手向使用示例。</text>
            </view>

            <view class="notation_like_box">
                <view class="notation_like_item notation_like">
                    <text>点赞</text>
                </view>
                <view class="notation_like_item notation_dislike">
                    <text>彩蛋</text>
                </view>
            </view>

            <view class="my_comment">
                <view class="uni-title uni-common-pl">留下您的神文笔..</view>
                <view class="uni-textarea myCommentsContent">
                    <textarea placeholder-style="color:#F76260"
                              @blur="bindMyCommentsBlur"
                              placeholder="写点什么.."/>
                </view>
                <view class="notation_like_item  myCommentsBtn" >
                    <text>评论</text>
                </view>
            </view>



        </view>

        <view class="comments_box">
            <view class="comments_title_box">
                <text> 网友留言:</text>
            </view>

            <view class="comments_body_box">
                <view class="comments_msg_box">

                    <view class="comments_msg_user">
                        <text>马云</text>
                        <text style="margin-left: 20px">2019/12/12</text>
                    </view>

                    <view class="comments_msg_user">
                        <text>单易懂注释详尽的nvue新手向使用示例,简单易懂注释详尽的n
                            vue新手向使用示例,简单易懂注释详尽的nvue新手向使用</text>
                    </view>

                </view>

                <view class="notation_like_box">
                    <view class="notation_like_item notation_like">
                        <text>点赞</text>
                    </view>
                    <view class="notation_like_item notation_dislike">
                        <text>彩蛋</text>
                    </view>
                </view>

            </view>

            <view class="comments_body_box">
                <view class="comments_msg_box">

                    <view class="comments_msg_user">
                        <text>马云</text>
                        <text style="margin-left: 20px">2019/12/12</text>
                    </view>

                    <view class="comments_msg_user">
                        <text>单易懂注释详尽的nvue新手向使用示例,简单易懂注释详尽的n
                            vue新手向使用示例,简单易懂注释详尽的nvue新手向使用</text>
                    </view>

                </view>

                <view class="notation_like_box">
                    <view class="notation_like_item notation_like">
                        <text>点赞</text>
                    </view>
                    <view class="notation_like_item notation_dislike">
                        <text>彩蛋</text>
                    </view>
                </view>

            </view>
            <view class="comments_body_box">
                <view class="comments_msg_box">

                    <view class="comments_msg_user">
                        <text>马云</text>
                        <text style="margin-left: 20px">2019/12/12</text>
                    </view>

                    <view class="comments_msg_user">
                        <text>单易懂注释详尽的nvue新手向使用示例,简单易懂注释详尽的n
                            vue新手向使用示例,简单易懂注释详尽的nvue新手向使用</text>
                    </view>

                </view>

                <view class="notation_like_box">
                    <view class="notation_like_item notation_like">
                        <text>点赞</text>
                    </view>
                    <view class="notation_like_item notation_dislike">
                        <text>彩蛋</text>
                    </view>
                </view>

            </view>
        </view>
    </view>
</template>

<script>


    export default {
        name:"ExamQuestionPage",
        computed: {},
        components: {},
        onLoad(params) {
            this.params = params
        },
        data(){
            return {
                params:{
                    exam_id:'',   //试卷号
                    question_index:1, //题号
                },
                data_row:{
                    id:1,
                    exam_id:1,
                    question_index:1,
                    type:1,
                    question:"1+1等于多少？",
                    answer:"A",
                    choices:[
                        {code:"A", name:"2",checked:false},
                        {code:"B", name:"地球人都知道",checked:false},
                        {code:"C", name:"3",checked:false},
                        {code:"D", name:"以上答案都不对，以上答案都不对以上" +
                                "答案都不对以上答案都不对以上答案都不对以上答案都不对",checked:false},
                    ],
                },
                img_mode:"aspectFit",
                is_reach_bottom:false,
                questionTypeMap:{
                    1:"单选题",
                    2:"多选题",
                    3:"填空题",
                    4:"简答题",
                },
                submitData:{
                    answer:[],
                    id:1,
                    exam_id:1,
                },
                answered_show:"",
            };
        },
        methods:{
            radioChange: function(e) {
                this.submitData.answer = e.detail.value;
                this.answered_show = e.detail.value;
            },
            checkboxChange: function (e) {
                this.submitData.answer = e.detail.value;
                this.answered_show = e.detail.value.join(',');
            },
            bindTextAreaBlur: function (e) {
                this.submitData.answer = e.detail.value;
                this.answered_show = e.detail.value;
            },
            goToQuestionIndexPage(){
                uni.navigateTo({
                    url: '/pages/exam/exam_question_index',
                });
            },
            bindMyCommentsBlur(e){
                let mycomments = e.detail.value;
            }
        }
    }

</script>

<style>

    .container{
        padding: 0 5px;
    }

    .duration_box{
        text-align: center;
        height: 30px;
    }

    .question_body_box{
        padding: 5px;
    }
    .question_header_box{
        margin-top: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-between;
        align-items: center;
    }

    .question_type_box{
        height: 30px;
        width: 70px;
    }

    .question_card_box{
        height: 30px;
        width: 70px;
        background-color: rgb(57,181,74);
    }

    .question_title_box{
        margin-top: 10px;
    }

    .question_title_box{
        height: 30px;
    }

    .question_jump_box{
        margin-top: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .question_jump_box_item{
        height: 30px;
        width: 70px;
        margin-left: 10px;
        text-align: center;
        background-color: rgb(233,233,233);

    }

    .notation_like_box{
        margin-top: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:flex-end;
        align-items: center;
    }

    .notation_like_item{
        background-color: rgb(240,240,240);
        width: 50px;
        height: 30px;
        margin: 5px;
    }

    .comments_body_box{
        margin-top: 8px;
    }

    .myCommentsContent{
        margin: 5px;
        height: 60px;
        border: 1px solid gray;
    }


</style>
