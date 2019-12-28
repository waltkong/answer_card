<template>

    <view class="container">

        <view class="navbar">
            <view class="navbar_item navbar_item_first">

                <view class="uni-form-item search_text">
                    <input class="uni-input" placeholder="搜你想搜的" />
                    <view class="search_text_clear"> × </view>
                </view>

                <view class="search_btn">
                    <button type="primary">搜索</button>
                </view>

            </view>

            <view class="navbar_item navbar_item_second">

                <view class="navbar_item_one " v-if="show_subject">
                    学科:PHP
                </view>

                <view class="navbar_item_one " v-if="show_tag">
                    {{show_tag_name}}
                </view>

                <view class="navbar_item_one" @tap="changeSortby('like') ">
                    热门 <text class="sort_by " :class="sort_by_like"
                             v-if="params.sort_by === 'asc' "> ↑ </text>
                    <text class="sort_by" v-if="params.sort_by === 'desc' "> ↓ </text>
                </view>

                <view class="navbar_item_one" @tap="changeSortby('time')">
                    时间 <text class="sort_by" :class="sort_by_time"
                             v-if="params.sort_by === 'asc' "> ↑ </text>
                    <text class="sort_by" v-if="params.sort_by === 'desc' "> ↓ </text>
                </view>

            </view>

        </view>

        <view class="data_list_container">
            <view class="data_list_box scroll-Y" v-for="(item, index) in data_list" :key="index">
                <view @tap="goExamIndexPage(item.id)" class="scroll-view-item data_list_item">

                    <view class="exam_body ">

                        <view class="exam_img_box">
                            <image class="exam_img" :mode="img_mode" :src="item.img">
                            </image>
                        </view>

                        <view class="exam_content_box">
                            <view class="exam_title">
                                <text>{{index + 1}}:{{item.name}}</text>
                            </view>
                            <view class="example_content_foot">
                                <view class="example_school">
                                    <text>{{item.school}}</text>
                                </view>
                                <view class="example_time">
                                    <text>{{item.time}}</text>
                                </view>
                            </view>
                        </view>

                    </view>

                    <view class="exam_foot">
                        <view class="author_box">
                            <text>发布：{{item.author}}</text>
                        </view>
                        <view class="click_count_box">
                            <text>点击：{{item.click_count}}</text>
                        </view>
                    </view>

                </view>
            </view>

            <view class="reach_bottom_text_box" v-show="is_reach_bottom">
                <text class="reach_bottom_text">加载更多..</text>
            </view>

        </view>
    </view>

</template>

<script>

    export default {
        name:'SubjectList',
        computed: {},
        components: {},
        onLoad(params) {
            this.params.id = params.id;
            this.params.tag = params.tag;
            if(! this.isEmpty(this.params.id) ){
                this.show_subject = true
            }
            if(! this.isEmpty(this.params.tag ) ){
                this.show_tag = true;
                this.show_tag_name = this.params.show_tag_name;
            }
            this.getList()
        },
        data(){
            return {
                params:{
                    id:null,
                    tag:null,
                    sort_by:'createtime',
                    sort_way:'desc'
                },
                data_list:[
                    {
                        id:1,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:2,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:3,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:4,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:5,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:6,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:7,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:8,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                    {
                        id:9,
                        name:'软件工程2019年期末真题',
                        time:'2019/12/12',
                        school:'北京大学',
                        img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                        click_count:100,
                        author:'马云',
                    },
                ],
                img_mode:"aspectFit",
                is_reach_bottom:false,
                show_subject:false,
                show_tag:false,
                show_tag_name: '',
                sort_by_like: '',
                sort_by_time: 'navbar_item_one_highlight',
            };
        },
        methods: {
            changeSortby(str){
                if(str == 'like'){
                    this.params.sort_by = 'click_count'
                    this.params.sort_way = this.params.sort_way==='asc'?'desc':'asc'
                }else if(str == 'time'){
                    this.params.sort_by = 'createtime'
                    this.params.sort_way = this.params.sort_way==='asc'?'desc':'asc'
                }
            },
            isEmpty(str){
                if(str ==null || str === '' || str === 0 || str === undefined){
                    return true
                }
                return false
            },
            imageError: function(e) {
                console.error('image发生error事件，携带值为' + e.detail.errMsg)
            },
            goExamIndexPage(id){
                uni.navigateTo({
                    url: '/pages/exam/exam_index?exam_id='+id,
                });
            },
            getList(){

            }
        },
        onPullDownRefresh(){  //下拉刷新
            console.log('refresh');
            setTimeout(function () {
                uni.stopPullDownRefresh()
            }, 1000);
        },
        onReachBottom(){
            console.log('reach bottom');
            this.is_reach_bottom = true;
            let _this = this;
            setTimeout(function () {
                _this.data_list.push({
                    id: Math.random(),
                    name:'软件工程2019年期末真题',
                    time:'2019/12/12',
                    school:'北京大学',
                    img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg",
                    click_count:100,
                    author:'马云',
                });

                this.is_reach_bottom = false

            }, 1000);
        }
    }
</script>

<style>

    .navbar{
        position: fixed;
        left: 0;
        width: 100%;

        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.6);
        z-index: 10;

        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .navbar_item{
        height: 30px;
        margin-top: 3px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .navbar_item_first{
        border-bottom: #007aff 1px solid;
    }

    .search_text{
        width: 220px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:flex-end;
        align-items: center;
    }

    .search_text_clear{
        width: 10px;
    }

    .search_btn button{
        margin-left: 12px;
        width: 70px;

        text-align: center;
        font-size: small;
    }

    .navbar_item_one{
        margin-left: 10px;
        background-color: #cccccc;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .navbar_item_one_highlight{
        background-color: #0faeff;
    }

    .data_list_container{
        margin-top: 60px;
    }

    .data_list_box{
        margin-top: 10px;

        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .data_list_item{
        margin-top: 5px;
        width: 300px;
        height: 130px;

        display: flex;
        flex-direction:column;
        flex-wrap: nowrap;
        justify-content:flex-start;
        align-items: center;

    }

    .data_list_item .exam_body{
        width: 100%;
        height: 110px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .exam_img_box .exam_img{
        width: 100px;
        max-height: 80px;
    }

    .exam_content_box{
        width: 190px;
        height: 80px;

        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .exam_title{
        font-size: medium;
        height: 50px;
    }

    .example_content_foot{
        height: 30px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .example_school{
        width: 110px;
        font-size: small;
    }

    .example_time{
        width: 70px;
        font-size: small;
    }

    .exam_foot{
        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .author_box{
        width: 140px;
        font-size: medium;
    }
    .click_count_box{
        width: 140px;
        font-size: medium;
    }



</style>
