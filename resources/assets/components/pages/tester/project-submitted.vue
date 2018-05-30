<template>
    <div class="bg-color">
        <div class="container">
            <div class="row">
                <div class="content-bg welcome-page">
                    <h1 class="text-uppercase">project_submitted Coming Soon</h1>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "project_submitted"
    }
</script>
<style lang="scss" scoped>
@import "../../layouts/css/_customvariables";
.content-bg{
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
    margin: 15px auto;
    border-radius: 20px;
}
@media screen and(max-width:991px) {
    .welcome-page{
        padding-top: 162px;
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
</style>

