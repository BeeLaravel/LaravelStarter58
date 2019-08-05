<template>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>NO.</th>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Operater</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in list">
                    <td><input type="checkbox"></td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.slug }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="javascript: void(0);" @click="show_edit(index)">编辑</a>
                        <a href="javascript: void(0);" @click="destroy(index)">删除</a>
                    </td>
                </tr>
            </tbody>
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
        <div class="shadow" v-show="control.show_create"></div>
        <div class="create" v-show="control.show_create">
            <div class="header">
                <div class="title" v-if="control.is_edit == false">添加</div>
                <div class="title" v-if="control.is_edit == true">修改</div>
                <i class="close_second" @click="control.show_create = false"></i>
            </div>
            <div class="create_content">
                <table>
                    <tbody>
                        <tr>
                            <th>标题：</th>
                            <td><input type="text" placeholder="标题" v-model="item.title"></td>
                        </tr>
                        <tr>
                            <th>标识：</th>
                            <td><input type="text" placeholder="标识" v-model="item.slug"></td>
                        </tr>
                        <tr>
                            <th>排序：</th>
                            <td><input type="number" placeholder="排序" v-model="item.sort"></td>
                        </tr>
                        <tr>
                            <th>描述：</th>
                            <td><textarea id="" cols="30" rows="10" v-model="item.description" placeholder="描述"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer">
                <button class="create" @click="save()">保存</button>
                <button class="cancle" @click="control.show_create = false">取消</button>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    $header: #199EDB;
    $odd: #fff;
    $even: #E5F8FD;

    div.content {
        margin: 8px;
        margin-bottom: 36px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        height: -webkit-fill-available;
        padding: 10px;

        >table {
            width: 100%;
            font-size: 12px;

            >thead {
                >tr {
                    background-color: $header;
                    color: #fff;
                }
            }
            >tbody {
                tr {
                    &:nth-child(odd) {
                        background-color: $odd;
                    }
                    &:nth-child(even) {
                        background-color: $even;
                    }

                    td {
                        text-align: center;
                    }
                }
            }
        }
        >.pagination {
            height: 30px;
            font-size: 12px;
            margin-top: 5px;

            span, a {
                border-radius: 4px;
                padding: 0 4px;
            }
            span {
                border: 1px solid #199EDB;
                background-color: #199EDB;
                color: #fff;
            }
            a {
                border: 1px solid #ddd;
                color: #555;
                background-color: #fff;
            }
        }
        >.shadow {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 998;
            background-color: #000;
            opacity: 0.5;
        }
        >.create {
            width: 60%;
            height: 300px;
            position: absolute;
            z-index: 999;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 100px auto;
            border: 1px solid rgb(51, 51, 51);
            background-color: #fff;

            >.header {
                height: 50px;
                line-height: 50px;
                border-bottom: 1px solid #eee;

                >.title {
                    margin-left: 30px;
                    font-size: 16px;
                    font-weight: 700;
                }
                >i.close_second {
                    position: absolute;
                    top: 10px;
                    right: 30px;
                    display: block;
                    width: 30px;
                    height: 30px;
                    font-size: 24px;
                    line-height: 30px;
                    text-align: center;

                    &:hover {
                        background-color: #eee;
                    }
                    &:before {
                        content: "\D7";
                    }
                }
            }
            >.create_content {
                background-color: #fff;
                padding: 15px 30px;

                >table {
                    width: 100%;
                    font-size: 14px;

                    >tbody {
                        >tr {
                            >th {
                                width: 12%;
                            }
                            >td {

                            }
                        }
                    }
                }
                input[type=text], input[type=number], input[type=email], textarea, select {
                    width: 100%;
                    line-height: 24px;
                    padding-left: 12px;
                    box-sizing: border-box;
                }
            }
            >.footer {
                border-top: 1px solid #eee;
                padding: 10px 30px;
                height: 30px;
                text-align: right;
                background-color: #fff;

                >button {
                    width: 100px;
                    height: 30px;
                    border: 1px solid #aaa;

                    &:hover {
                        background-color: #eee;
                    }
                }
            }
        }
    }
</style>
<script>
    export default {
        props: [
        ],
        methods: {
            search: function(page=0) {
                axios.get(this.control.api_url_base, {
                    params: {
                        page: page ? page : this.pagination.page,
                        per_page: this.pagination.per_page,
                        filter: this.control.filter
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
                    title: "",
                    slug: "",
                    description: "",
                    sort: 255,
                };
            },
            show_edit: function(index) {
                this.control.show_create = true;
                this.control.is_edit = true;

                this.item = this.list[index];
            }
        },
        data() {
            return {
                list: [],
                pagination: {},
                item: {},
                control: {
                    api_url_base: '/api/warehouse/products',
                    show_create: false,
                    is_edit: false,
                    filter: "",
                },
            }
        },
        mounted() {
            this.search();
        },
    }
</script>
