<style lang="scss" scoped>
    @mixin round($height) {  
        height: $height;
        border-radius: $height / 2;
        padding-left: $height / 2;
        padding-right: $height / 2;

        box-sizing: border-box;
    }
    @mixin absolute_hcenter() {  
        position: absolute;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
    }
    @mixin absolute_vcenter() {  
        position: absolute;
        top: 0;
        bottom: 0;
        margin-top: auto;
        margin-bottom: auto;
    }

    @mixin button_first($width: 60px, $height: 24px, $font_size: 16px) {
        width: $width;
        @include round($height);
        border: unset;
        background-color: cornflowerblue;
        color: white;
        font-size: $font_size;
    }
    @mixin button_second($width: 60px, $height: 24px, $font_size: 16px) {
        width: $width;
        @include round($height);
        line-height: $height;
        border: 1px solid cornflowerblue;
        background-color: white;
        color: cornflowerblue;
        font-size: $font_size;
    }
    // @import "mixins/minxins";

    .container:after {
        content: "";
        display: block;
        padding-bottom: 50px;
    }
    div.common_operate {
        position: relative;
        @include round(60px);
        background: white;

        div.search {
            position: relative;
            margin-top: 10px;
            // @include absolute_vcenter();
            display: inline-block;
            width: 400px;
            height: 40px;

            input[type=text] {
                border: 1px solid #ccc;
                width: 100%;
                @include round(40px);
                font-size: 20px;
            }
            button[type=submit] {
                @include absolute_vcenter();
                right: 3px;
                @include button_first(80px, 34px, 20px);
            }
        }
        select {
            appearance: button;
            background-color: white;
            width: 150px;
            @include round(40px);            
            font-size: 20px;
            text-align-last: center;
            vertical-align: bottom;
        }
        button.create {
            @include absolute_vcenter();
            right: 20px;
            @include button_first(80px, 34px, 20px);
        }
    }
    div.pagination {
        @include round(30px);
        background-color: white;
        padding-top: 3px;

        div.left {

        }
        div.right {
            a, span {
                display: inline-block;
                @include round(24px);
                line-height: 24px;
                background-color: cornflowerblue;
                color: white;
            }
        }
    }
    table.list {
        margin: 10px 0;
        width: 100%;

        tr {
            @include round(40px);
            line-height: 40px;
            background-color: white;

            td {
                padding-left: 5px;
            }
            &:first-child {
                margin-top: 0;
            }
            .title {
                font-size: 20px;
            }
            .description {
                color: #555;
                font-size: 12px;
            }
            .opreate {
                display: inline-block;
                float: right;

                button {
                    @include button_second();
                    margin-top: 8px;
                }
            }

            &.empty {
                height: 200px;
                line-height: 200px;
                text-align: center;
            }
        }
    }
    div.create {
        @include absolute_hcenter();
        top: 76px;
        width: 800px;
        border-radius: 15px;
        box-shadow: 0px 0px 10px #ccc;
        background-color: white;
        padding: 50px;

        .header,.footer {
            position: absolute;
            left: 1px;
            right: 1px;
            @include round(30px);
            background-color: cornflowerblue;
        }
        .header {
            top: 1px;

            div.title {
                margin-left: 18px;
                line-height: 30px;
                color: white;
            }
            i.icon {
                line-height: 30px;
                position: absolute;
            }
        }
        .footer {
            bottom: 1px;
            text-align: right;

            button {
                @include button_first();
                background-color: white;
                color: cornflowerblue;
                line-height: 24px;
                margin-top: 3px;
                font-weight: bold;
            }
        }
        .content {
            input, textarea, select {
                width: 100%;
                margin-bottom: 10px;
                border: 1px solid #ccc;
            }
            input, select {
                padding: 5px 0;
                @include round(30px);
            }
            textarea {
                box-sizing: border-box;
                padding: 2px;
            }
            select {
                appearance: button;
                background-color: white;
            }
        }
    }
</style>
<template>
    <div class="container">
        <div class="common_operate">
            <div class="search">
                <input type="text" placeholder="输入 名称/extension/mimeType" v-model="control.filter" @blur="search()" @keyup.enter="search()">
                <button type="submit" @click="search()">搜索</button>
            </div>
            <button type="button" class="create" @click="show_create()">新增</button>
        </div>
        <table class="list">
            <tr v-for="(item, index) in list">
                <td>{{item.title}}</td>
                <td>{{item.extension}}</td>
                <td>{{item.mime}}</td>
                <td>{{item.size}}</td>
                <td>{{item.category}}</td>
                <td class="opreate">
                    <button @click="show_edit(index)">编辑</button>
                    <button @click="destroy(index)">删除</button>
                </td>
            </tr>
            <tr class="empty" v-if="list == false"><td>没有记录</td></tr>
        </table>
        <div class="pagination">
            <div class="left">
                共 <span>{{pagination.count}}</span> / <span>{{pagination.total}}</span> 条记录，
                第 <span>{{pagination.current_page}}</span> / <span>{{pagination.total_pages}}</span> 页，
                每页展示
                <select v-model="pagination.per_page" @change="search()">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select> 条
            </div>
            <div class="right">
                <a href="javascript: void(0);" v-if="pagination.current_page != 1" @click="search(1)"><<</a>
                <a href="javascript: void(0);" v-if="pagination.current_page > 1" @click="search(pagination.current_page-1)"><</a>
                <a href="javascript: void(0);" v-if="pagination.current_page > 2" @click="search(pagination.current_page-2)">{{pagination.current_page-2}}</a>
                <a href="javascript: void(0);" v-if="pagination.current_page > 1" @click="search(pagination.current_page-1)">{{pagination.current_page-1}}</a>
                <span>{{pagination.current_page}}</span>
                <a href="javascript: void(0);" v-if="pagination.current_page < pagination.total_pages" @click="search(pagination.current_page+1)">{{pagination.current_page+1}}</a>
                <a href="javascript: void(0);" v-if="pagination.current_page + 1 < pagination.total_pages" @click="search(pagination.current_page+2)">{{pagination.current_page+2}}</a>
                <a href="javascript: void(0);" v-if="pagination.current_page < pagination.total_pages" @click="search(pagination.current_page+1)">></a>
                <a href="javascript: void(0);" v-if="pagination.current_page != pagination.total_pages" @click="search(pagination.total_pages)">>></a>
            </div>
        </div>
        <div class="create" v-show="control.show_create">
            <div class="header">
                <i class="icon iconfont iconadd" v-if="control.is_edit == false"></i>
                <i class="icon iconfont iconedit" v-if="control.is_edit == true"></i>
                <div class="title" v-if="control.is_edit == false">添加</div>
                <div class="title" v-if="control.is_edit == true">修改</div>
                <i class="close" @click="control.show_create = false"></i>
            </div>
            <div class="content">
                <div class="input">
                    <input type="category" placeholder="分类" v-model="item.category">
                </div>
                <div class="input">
                    <input type="file" id="file">
                </div>
            </div>
            <div class="footer">
                <button class="create" @click="save()">保存</button>
                <button class="cancle" @click="control.show_create = false">取消</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                list: [],
                pagination: {},
                item: {},
                control: {
                    api_url_base: '/api/files',
                    show_create: false,
                    is_edit: false,
                    filter: "",
                },
            }
        },
        methods: {
            search: function(page=0) {
                axios.get(this.control.api_url_base, {
                    params: {
                        page: page ? page : this.pagination.page,
                        per_page: this.pagination.per_page,
                        filter: this.control.filter,
                    }
                }).then(response => {
                    this.list = response.data.data;
                    this.pagination = response.data.meta.pagination;
                });
            },
            save: function() {
                var formData = new FormData();
                formData.append('file', document.getElementById('file').files[0]);
                formData.append('category', this.item.category);

                if ( this.item.id ) {
                    formData.append('id', this.item.id);

                    axios.patch(this.control.api_url_base + '/' + this.item.id, formData, {
                        headers: {'Content-Type': 'multipart/form-data'}
                    }).then(response => {
                        if ( true ) {
                            this.search();
                        } else {

                        }
                    });
                } else {
                    axios.post(this.control.api_url_base, formData, {
                        headers: {'Content-Type': 'multipart/form-data'}
                    }).then(response => {
                        if ( true ) {
                            this.search();

                            this.control.show_create = false;
                        } else {

                        }
                    });
                }
            },
            destroy: function(index) {
                var id = this.list[index].id;

                axios.delete(this.control.api_url_base + '/' + id)
                    .then(response => {
                        if ( true ) {
                            this.search();
                        } else {

                        }
                    });
            },
            // 页面控制
            show_create: function() {
                this.control.show_create = true;
                this.control.is_edit = false;

                this.item = { // 置空
                    id: 0,
                    file: [],
                    category: "fonts",
                };
            },
            show_edit: function(index) {
                this.control.show_create = true;
                this.control.is_edit = true;

                this.item = this.list[index];
            },
        },
        mounted() {
            this.search();
        }
    }
</script>
