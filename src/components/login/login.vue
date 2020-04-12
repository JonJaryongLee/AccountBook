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
            <v-dialog v-model="dialogForLogin" persistent max-width="600px">
                <template v-slot:activator="{ on }">
                    <div class="loginBtnContainer">
                        <v-btn color="teal lighten-2" v-on="on">로그인</v-btn>
                    </div>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="headline">로그인</span>
                    </v-card-title>
                    <v-card-text>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field label="ID" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="Password" type="password" required></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="blue darken-1" text @click="joinDialogOpen()">가입하기</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialogForLogin = false">로그인</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogForSignUp" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">회원가입</span>
                    </v-card-title>
                    <v-card-text>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field label="ID" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="비밀번호" type="password" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="비밀번호 확인" type="password" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field label="이름" required></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-select :items="['20대', '30대', '기타']" label="나이" required></v-select>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-select :items="['남자', '여자']" label="성별" required></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="blue darken-1" text @click="dialogForSignUp = false">창닫기</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="dialogForSignUp = false">회원가입</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        dialogForLogin: false,
        dialogForSignUp: false
    }),
    methods: {
        joinDialogOpen(){
            this.dialogForLogin = false;
            this.dialogForSignUp = true;
        }
    }
}
</script>
<style>
.loginLayoutContainer {
    display: flex;
    padding-top: 15%;
    height: 550px;
    flex-direction: column;
}

.loginImgContainer {
    text-align: center;
}

#mainIMG {
    height: 150px;
}

.welcomeMessage {
    position: relative;
    top: 0px;
    padding-top: 20%;
    height: 40%;
    text-align: center;
}

.loginBtnContainer {
    text-align: center;
}
</style>