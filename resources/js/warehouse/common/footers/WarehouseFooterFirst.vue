<template>
    <div class="footer_first">
        <div class="left">
            <menu>
                <ul>
                    <li>
                        <header>应用</header>
                        <ul>
                            <li><a href="">仓配系统</a></li>
                            <li><a href="">订单系统</a></li>
                            <li><a href="">资金助手</a></li>
                            <li><a href="">协同办公</a></li>
                            <li><a href="">极客选品</a></li>
                            <li><a href="">刊登</a></li>
                            <li><a href="">数据中心</a></li>
                            <li><a href="">轨迹平台</a></li>
                            <li><a href="">海鸥派</a></li>
                            <li><a href="">工单网</a></li>
                        </ul>
                    </li>
                    <li>
                        <header>常用</header>
                        <ul>
                            <li><a href="">供应商</a></li>
                            <li><a href="">产品</a></li>
                            <li><a href="">KPI</a></li>
                        </ul>
                    </li>
                </ul>
            </menu>
        </div>
        <div class="right">
            BeeSoft Warehouse Version 1.0.0
            &copy; <a href="http://www.beesoft.ink">BeeSoft.Ink</a> @ 2019
        </div>
    </div>
</template>
<style lang="scss" scoped>
    .footer_first {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 28px;
        display: flex;
        justify-content: space-between;
        background-color: #e6e6e6;
        font-size: 14px;

        >.left {
            >menu {
                >ul {
                    >li {
                        position: relative;
                        width: 100px;

                        >header {
                            line-height: 28px;
                        }
                        >ul {
                            position: absolute;
                            bottom: 28px;
                            width: 100px;
                        }
                    }
                }
            }
        }
        >.right {
            padding: 0 1em;
            line-height: 28px;
            font-size: 12px;
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
                    color: #eee;
                    border-right: 1px solid #2c3642;

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
                        border-top: 1px solid #ccc;
                    }
                }
            }
        }
    }
</style>
<script>
    export default {
        props: [
            // 'title',
        ],
        mounted() {
        }
    }
</script>
