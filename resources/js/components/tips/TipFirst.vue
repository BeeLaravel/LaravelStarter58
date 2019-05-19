<template>
    <div class="tip_first" v-show="show">
        <div class="message">{{message}}</div>
        <i class="close"></i>
    </div>
</template>
<style lang="scss" scoped>
    .tip_first {
        position: absolute;
        right: 10px;
        top: 70px;
        width: 200px;
        height: 100px;
        background-color: azure;
        
        .message {
            position: absolute;
            top: 0;
            bottom: 0;
            margin-top: auto;
            margin-bottom: auto;
            width: 100%;
            text-align: center;
            height: min-content;
        }
        i.close {
            bottom: unset;
            right: 0;
            background-color: unset;
            color: red;
        }
    }
</style>
<script>
    export default {
        props: [
            'message',
            'show',
        ],
        data() {
            return {
                show: true,
            }
        },
        mounted() {
        }
    }
</script>
