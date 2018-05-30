<template>
    <div class="error_bg">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 col-sm-8 col-xs-10 text-center error_content">
                    <div class="error text-bold">
                        <span>4<img src="~img/404_bug.png" class="img-fluid"/>4</span></div>
                    <div class="error-type text-medium"><span>PAGE NOT FOUND</span></div>
                    <p class="error-msg">This is not the place you are looking for, you may try the below actions. </p>
                    <div>
                        <img class="img-fluid seperator" src="~img/dotted-seprator.png"/>
                    </div>
                    <!-- <router-link to="/" class="grey-btn" @click.prevent.stop="go_back">Go Back</router-link> -->
                    <router-link to="/" class="grey-btn">Go Home</router-link>
                    <router-link :to="{ name: 'login' }" class="green-btn" >Login</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "err404",
    mounted: function() {

    },
    destroyed: function() {

    },
    methods: {
        go_back() {
            this.$router.go(-1)
        }
    }
}
</script>
<style>
html,body{
    height: 100%;
}
</style>

<style lang="scss" scoped>
.error_bg{
    background-image: url("~img/404_bg.png");
    background-size: cover;
    background-position: center;
    background-color: #EEE;
    color: #c8d3dc;
    background-repeat: no-repeat;
    .container,.row {
        min-height: 100vh;
    }
    .error {
        font-size: 150px;
        line-height: 135px;
        color: #ffffff;
        text-shadow: 8px 2px 2px rgba(52, 73, 94, 1); 
         img{
            vertical-align: top;
            margin-left: 0;
            margin-right: -20px;
        }
    }

    .error-type {
        font-size: 35px;
        text-shadow: 8px 2px 2px rgba(52, 73, 94, 1); 
        
    }

    .error-msg {
        font-size: 18px;
        margin: 10px 0;
        text-shadow: 8px 2px 2px rgba(52, 73, 94, 1); 
        
    }
    .seperator {
        margin: 20px 0;
    }
}


.grey-btn{
    border-radius: 6px;
    padding: 9px 17px;
    background-color: #898a8c;
    border: none;
    font-size: 15px;
    margin-right: 20px;
     display: inline-block;
      min-width: 100px;
     display: inline-block;
    
}
.grey-btn:hover{
    background-color: #747577;
    color: #fff;
}
.green-btn{
   border-radius: 6px;
    padding: 9px 17px;
    background-color: #17bd2d;
    border: none;
    font-size: 15px;
    min-width: 100px;
    display: inline-block;
}
.green-btn:hover{
    background-color: #07a91d;
    color: #fff;
}

@media screen and(max-width:767px) {
    .error_bg {
        .error{
            font-size: 100px;
            line-height: 95px;
            img{
                vertical-align: top;
                margin-left: 0;
                margin-right: -15px;
                max-width: 85px;
            }
        }
        .error-type{
            font-size: 30px;
        }
        .error-msg{
            font-size: 16px;
            line-height: 18px;
        }
    }
}
@media screen and(max-width:767px) {
    .error_bg {
        .error{
            font-size: 74px;
            line-height: 70px;
            img{
                vertical-align: top;
                margin-left: 0;
                margin-right: -10px;
                max-width: 65px;
            }
        }
        .error-type{
            font-size: 26px;
        }
        .error-msg{
            font-size: 14px;
            line-height: 20px;
        }
    }
}
</style>
