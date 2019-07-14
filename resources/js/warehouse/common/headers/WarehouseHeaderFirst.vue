<template>
    <div class="header_first">
        <div class="left">
            <div class="logo">BeeSoft 仓配</div>
            <menu class="main">
                <ul>
                    <li>
                        <header>供应商</header>
                        <ul>
                            <li><router-link to="/suppliers">供应商</router-link></li>
                            <li><router-link to="/products">产品</router-link></li>
                            <li><a href="">KPI</a></li>
                        </ul>
                    </li>
                    <li>
                        <header>产品</header>
                        <ul>
                            <li><router-link to="/products">产品</router-link></li>
                            <li>产品开发</li>
                            <li>产品询价</li>
                            <li>产品品类</li>
                            <li>产品属性</li>
                        </ul>
                    </li>
                    <li>
                        <header>采购</header>
                        <ul>
                            <li><router-link to="/purchases">采购</router-link></li>
                            <li>补货策略</li>
                            <li>申购管理</li>
                            <li>采购异常</li>
                            <li>采购建议</li>
                        </ul>
                    </li>
                    <li>
                        <header>入库</header>
                        <ul>
                            <li>预检</li>
                            <li>收货</li>
                            <li>质检</li>
                            <li>上架</li>
                        </ul>
                    </li>
                    <li>
                        <header>头程</header>
                        <ul>
                            <li>发货计划</li>
                            <li>下架</li>
                            <li>装箱</li>
                            <li>出货</li>
                        </ul>
                    </li>
                    <li>
                        <header>仓库</header>
                        <ul>
                            <li><router-link to="/warehouses">仓库</router-link></li>
                            <li><router-link to="/areas">分区</router-link></li>
                            <li><router-link to="/locations">库位</router-link></li>
                            <li><router-link to="/inventories">库存</router-link></li>
                            <li><router-link to="/batch_inventories">批次库存</router-link></li>
                            <li><router-link to="/">调拨</router-link></li>
                            <li><router-link to="/outbound">出库</router-link></li>
                        </ul>
                    </li>
                    <li>
                        <header>订单</header>
                        <ul>
                            <li>订单</li>
                            <li>拦截</li>
                        </ul>
                    </li>
                    <li>
                        <header>出货</header>
                        <ul>
                            <li>下架</li>
                            <li>打包</li>
                            <li>出货</li>
                            <li>装袋</li>
                            <li>出库</li>
                        </ul>
                    </li>
                    <li>
                        <header>配送</header>
                        <ul>
                            <li>服务商</li>
                            <li>运输方式</li>
                            <li>地址</li>
                            <li>计费</li>
                        </ul>
                    </li>
                    <li>
                        <header>报表</header>
                        <ul>
                            <li>销售</li>
                            <li>采购</li>
                            <li>库存</li>
                            <li>员工</li>
                        </ul>
                    </li>
                    <li>
                        <header>基础信息</header>
                        <ul>
                            <li>国家</li>
                            <li>区域</li>
                            <li>语言</li>
                            <li>货币</li>
                        </ul>
                    </li>
                    <li>
                        <header>系统</header>
                        <ul>
                            <li>配置</li>
                            <li>权限</li>
                            <li>角色</li>
                            <li>架构</li>
                            <li>员工</li>
                        </ul>
                    </li>
                </ul>
            </menu>
        </div>
        <div class="right">
            <menu class="self">
                <ul>
                    <li>
                        <header>语言</header>
                        <ul>
                            <li>汉语</li>
                            <li>English</li>
                            <li>漢語</li>
                            <li>藏語</li>
                            <li>蒙古語</li>
                            <li>维吾尔語</li>
                            <li>哈萨克语</li>
                            <li>壮語</li>
                            <li>日语</li>
                            <li>韩语</li>
                            <li>西班牙语</li>
                            <li>法语</li>
                            <li>俄语</li>
                            <li>阿拉伯语</li>
                        </ul>
                    </li>
                    <li>
                        <header>布局</header>
                        <ul>
                            <li>布局一</li>
                            <li>布局二</li>
                            <li>布局三</li>
                        </ul>
                    </li>
                    <li>
                        <header>主题</header>
                        <ul>
                            <li>浅色</li>
                            <li>深色</li>
                            <li>红色</li>
                        </ul>
                    </li>
                    <li>
                        <header>超级管理员</header>
                        <ul>
                            <li>界面配置</li>
                            <li>通知配置</li>
                            <li>修改密码</li>
                            <li>退出</li>
                        </ul>
                    </li>
                </ul>
            </menu>
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .header_first {
        display: flex;
        justify-content: space-between;
        height: 32px;
        background-color: #364050;

        >.left {
            display: flex;

            >.logo {
                width: 150px;
                background-color: #234a7b;
                color: #eee;
                text-align: center;
                line-height: 32px;
            }
            >menu.main {
                ul {
                    li {
                        header {
                            border-right: 1px solid #2c3642;
                        }
                    }
                }
            }
        }
        >.right {
            display: flex;
            >menu.self {
                ul {
                    li {
                        header {
                            border-left: 1px solid #2c3642;
                        }
                    }
                }
            }
        }
    }
    menu {
        background-color: #364050;
        text-align: center;
        font-size: 14px;

        >ul {
            display: flex;

            >li {
                width: 100px;

                &.active {
                    header {
                        background-color: #234a7b;

                        &:hover {
                            background-color: #234a7b;
                        }
                    }
                }
                &:hover {
                    ul {
                        display: block;
                    }
                }
                >header {
                    line-height: 32px;
                    color: #eee;
                    // border-right: 1px solid #2c3642;

                    &:hover {
                        background-color: #2c3642;
                    }
                }
                >ul {
                    display: none;
                    background-color: #fff;
                    border-left: 1px solid #ccc;
                    border-right: 1px solid #ccc;

                    >li {
                        line-height: 24px;
                        border-bottom: 1px solid #ccc;
                    }
                }
            }
        }
    }
</style>
<script>
    export default {
        props: [
            'title',
        ],
        mounted() {
        }
    }
</script>
