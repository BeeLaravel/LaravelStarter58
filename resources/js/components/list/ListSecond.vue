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
            width: 200px;
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
    ul.list {
        margin: 10px 0;

        li {
            @include round(40px);
            line-height: 40px;
            margin-top: 5px;
            background-color: white;

            &:first-child {
                margin-top: 0;
            }
            span.title {
                font-size: 20px;
            }
            span.description {
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
                <input type="text" placeholder="输入 标识/名称/描述 搜索" v-model="control.filter" @blur="search()" @keyup.enter="search()">
                <button type="submit" @click="search()">搜索</button>
            </div>
            <select v-model="control.default_language" @change="search()">
                <option value="">==请选择==</option>
                <option v-for="item in languages" :value="item.id">{{item.title}}</option>
            </select>
            <select v-model="control.default_category" @change="search()">
                <option value="">==请选择==</option>
                <option v-for="item in categories" :value="item.id">{{item.title}}</option>
            </select>
            <button type="button" class="create" @click="show_create()">新增</button>
        </div>
        <ul class="list">
            <li v-for="(item, index) in list">
                <span class="title">{{item.title}}</span>(<span class="slug">{{item.slug}}</span>)
                <a :href="'https://github.com/'+item.slug"><i class="iconfont icongithub"></i></a>
                <a :href="'https://github.com/'+item.slug+'.git'"><i class="iconfont icongit"></i></a>
                <a :href="'https://github.com/'+item.slug"><i class="iconfont icongitlab"></i></a>
                <a :href="'https://github.com/'+item.slug"><i class="iconfont icongitee"></i></a>
                <span class="description">{{item.description}}</span>
                <div class="opreate">
                    <button @click="show_edit(index)">编辑</button>
                    <button @click="destroy(index)">删除</button>
                </div>
            </li>
            <li class="empty" v-if="list == false">没有记录</li>
        </ul>
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
                    <input type="text" placeholder="标题" v-model="item.title">
                </div>
                <div class="input">
                    <input type="text" placeholder="标识" v-model="item.slug">
                </div>
                <div class="input">
                    <input type="number" placeholder="排序" v-model="item.sort">
                </div>
                <div class="input">
                    <select v-model="item.language">
                        <option value="">==请选择==</option>
                        <option v-for="item in languages" :value="item.id">{{item.title}}</option>
                    </select>
                    <select v-model="item.category">
                        <option value="">==请选择==</option>
                        <option v-for="item in categories" :value="item.id">{{item.title}}</option>
                    </select>
                </div>
                <div class="input">
                    <textarea id="" cols="30" rows="10" v-model="item.description" placeholder="描述"></textarea>
                </div>
                <div class="input">
                    <textarea id="" cols="30" rows="10" v-model="item.note" placeholder="笔记"></textarea>
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
                languages: [],
                categories: [],
                list: [],
                pagination: {},
                item: {},
                control: {
                    api_url_base: '/api/applications',
                    category_api_url_base: '/api/structure/category_items',
                    show_create: false,
                    is_edit: false,
                    filter: "",
                    default_language: 159, // Laravel5
                    default_category: 133, // Shop
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
                        language: this.control.language,
                        category: this.control.category,
                    }
                }).then(response => {
                    this.list = response.data.data;
                    this.pagination = response.data.meta.pagination;
                });
            },
            save: function() {
                if ( this.item.id ) {
                    axios.patch(this.control.api_url_base + '/' + this.item.id, this.item)
                        .then(response => {
                            if ( true ) {
                                this.search();
                            } else {

                            }
                        });
                } else {
                    axios.post(this.control.api_url_base, this.item)
                        .then(response => {
                            if ( true ) {
                                this.search();
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
                    title: "",
                    slug: "",
                    language: this.control.default_language,
                    category: this.control.default_category,
                    description: "",
                    sort: 255,
                };
            },
            show_edit: function(index) {
                this.control.show_create = true;
                this.control.is_edit = true;

                this.item = this.list[index];
            },
            // 加载数据
            load_languages: function() {
                axios.get(this.control.category_api_url_base, {
                    params: {
                        per_page: 100,
                        category_id: 7,
                    }
                }).then(response => {
                    this.languages = response.data.data;
                });
            },
            load_categories: function() {
                axios.get(this.control.category_api_url_base, {
                    params: {
                        per_page: 100,
                        category_id: 8,
                    }
                }).then(response => {
                    this.categories = response.data.data;
                });
            }
        },
        mounted() {
            this.load_languages();
            this.load_categories();
            this.search();
        }
    }
</script>
