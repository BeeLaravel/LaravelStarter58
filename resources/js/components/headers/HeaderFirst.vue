<template>
    <header>{{title}}</header>
</template>
<style>
    header {
        border-top: 4px solid cornflowerblue;
        box-shadow: rgba(42, 42, 42, 0.1) 0px 1px 11px 2px;
        padding-top: 4px;
        margin-bottom: 20px;
        background-color: white;
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        font-family: founder_thin_jin;
        color: cornflowerblue;
        line-height: 50px;
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
