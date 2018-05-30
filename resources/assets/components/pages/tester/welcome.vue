<template>
    <div class="bg-color">
        <div class="container-fluid">
            <div class="row">
                <div class="content-bg welcome-page">
                    <h1 class="text-uppercase">Welcome to the Beta Plan</h1>
                    <p>To become a tester, you need to <span class="text-green">complete 3 steps.</span></p>
                    <router-link class="btn text-uppercase text-center green-btn" :to="{ name: 'tester.step1'}">step 1 - Fill Profile</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "welcome"
    }
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.content-bg{
    // url("../../images/content-bg.png")
    background-image: url('~img/content-bg.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;
    min-height: 524px;
}
.welcome-page{
    text-align: center;
    padding: 210px 0px 0px;
    width: 100%;
    h1{
        color: #363e48;
        font-size: 40px;
        font-family: $font-family-UniNeue-bold;
    }
    p{
        color:#606368;
        font-size: 18px;
        span.text-green{
            color: #2cac3d;
            font-family: $font-family-brandon-bold;
        }
    }
}
.green-btn{
    width: 260px;
    padding: 7px 10px;
    color: #fff;
    margin: 15px auto;
    border-radius: 20px;
    &:hover{
        background: #158f25;
    }
}
@media screen and(max-width:1200px) {
    .welcome-page{
        padding-top: 165px;
    }
}

@media screen and(max-width:991px) {
    .welcome-page {
        h1{
            font-size: 34px;
        }
        p{
            font-size: 16px;
        }
    }
}
@media screen and(max-width:768px) {
    .welcome-page {
        .green-btn{
            width: 190px;
        }
        h1{
            font-size: 30px;
        }
    }
}
@media screen and(max-width:576px) {
    .welcome-page {
        h1{
            font-size: 28px;
        }
        p{
            font-size: 14px;
        }
    }
}
@media screen and(max-width:360px) {
    .welcome-page {
        h1{
            font-size: 22px;
        }
        .green-btn{
            margin: 0;
            width: 175px;
            font-size: 14px;
        }
    }
}
</style>

