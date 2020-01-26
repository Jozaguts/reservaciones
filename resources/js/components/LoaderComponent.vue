<template>
<div class="loading" v-if="status">
    <div class="dot d1"></div>
    <div class="dot d2"></div>
    <div class="dot d3"></div>
</div>
</template>

<script>
import store from '../store/index.js'
export default {

    props:['status']

}

</script>

<style>
.loading{
    position: absolute;
    width: 70px;
    height: 20px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    top:0;
    bottom: 0;
    left:0;
    right: 0;
    margin: 10px auto;

}

.dot{
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 10px;
    background: skyblue;
    animation-name: scale;
    animation-duration: 1s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes scale{
    0%{
        transform: scale(1);
    }
    50%{
        transform: scale(0.6);
    }
    100%{
        transform: scale(1);
    }

}

.d1{
    animation-delay: 0s;
}
.d2{
    animation-delay: .33s;
}
.d3{
    animation-delay: .66s;
}

</style>
