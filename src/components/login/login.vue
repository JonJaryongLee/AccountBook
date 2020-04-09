<template>
    <div>
        <v-app-bar color="teal lighten-2" height="40%"></v-app-bar>
        <div class="loginLayoutContainer">
            <div class="loginImgContainer">
                <img id="mainIMG" src="pigIMG.png" alt="pig">
            </div>
            <div class="welcomeMessage">
                어서오세요!<br>
                AccountBook과 함께 합리적인<br>
                소비습관을 길러볼까요?
            </div>
            <div class="loginBtnContainer">
                <v-btn color="teal lighten-2">시작하기</v-btn>
            </div>
        </div>
    </div>
</template>
<style>
.loginLayoutContainer {
    display: flex;
    padding-top: 15%;
    height:550px;
    flex-direction: column;
}

.loginImgContainer{
	text-align: center;
}

#mainIMG {
    height: 150px;
}

.welcomeMessage {
	position: relative;
	top:0px;
	padding-top:20%;
    height:40%;
    text-align: center;
}

.loginBtnContainer{
	text-align: center;
}
</style>