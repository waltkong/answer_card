<template>
    <view class="container">


        <view class="body_container">

            <view class="body_shortcut_box">
                <view class="body_shortcut_item" @tap="goToSpecifyListPage('like')">
                    <text>我收藏的</text>
                </view>
                <view class="body_shortcut_item" @tap="goToSpecifyListPage('history')">
                    <text>历史记录</text>
                </view>
            </view>

            <view class="body_box" >

                <view class="body_item" v-for="(item,index) in data_list" :key="index" >
                    <view @tap="goToSubjectListPage(item.id)">
                        <view class="body_item_img_box">
                            <image class="body_item_img" :mode="img_mode" :src="item.img"
                                   @error="imageError">
                            </image>
                        </view>

                        <view class="body_item_title">
                            {{item.name}}
                        </view>
                    </view>
                </view>



            </view>

        </view>
    </view>
</template>

<script>
    import {subject_list} from "../../api/data.js";

    export default {
        name:'Index',
        computed: {},
        components: {},
        onLoad() {
            this.getList();
        },
        data(){
           return {
               data_list:[
                //    {id:1, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"PHP",},
                //    {id:2, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"Golang",},
                //    {id:3, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"vue.js",},
                //    {id:4, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"node.js",},
                //    {id:5, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"python",},
                //    {id:6, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"flutter",},
                //    {id:7, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"laravel",},
                //    {id:8, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"thinkphp",},
                //    {id:9, img:"https://img-cdn-qiniu.dcloud.net.cn/uniapp/images/shuijiao.jpg", name:"js",},
               ],
               img_mode:"aspectFit",

           };
        },
        methods: {
            getList(){
                subject_list({}).then(response => {
                    var ret = response[1].data;
                    if (ret.code === 200) {
                        this.data_list = ret.data.data
                    }
                })
            },
            imageError: function(e) {
                console.error('image发生error事件，携带值为' + e.detail.errMsg)
            },
            goToSubjectListPage(id){
                uni.navigateTo({
                    url: '/pages/index/subject_list?subject_id='+id,
                });
            },
            goToSpecifyListPage(tag){
                let url = '/pages/index/subject_list?';
                switch (tag) {
                    case 'like':
                        url += "tag=like&show_tag_name=我收藏的";
                        break;
                    case 'history':
                        url += "tag=history&show_tag_name=我浏览的";
                        break;
                }
                uni.navigateTo({
                    url: url,
                });
            }
        }
    }
</script>

<style>

    .body_shortcut_box{
        padding: 0 3px ;
        margin-top: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }

    .body_shortcut_item{
        width: 80px;
        height: 30px;
        background-color: #cccccc;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;
    }


    .body_box{
        padding: 0 3px ;
        margin-top: 10px;

        display: flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content:flex-start;
        align-items: center;
    }

    .body_item{
        display: flex;
        flex-direction:column;
        flex-wrap: wrap;
        justify-content:space-around;
        align-items: center;

        width: 95px;
        height: 120px;
        margin: 10px;
    }

    .body_item_img{
        width: 80px;
        height: 80px;

    }

    .body_item_title{
        width: 80px;
        height: 30px;
    }

</style>
