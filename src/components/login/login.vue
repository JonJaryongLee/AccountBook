<template>
    <div>
        <v-alert type="error" v-if="loginFail">
            로그인 실패!
        </v-alert>
        <v-alert type="error" v-if="signUpFail">
            회원가입 실패!
        </v-alert>
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
                                    <v-col cols="12">
                                        <v-text-field label="ID" required v-model="id"></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field label="Password" type="password" required v-model="pw" @keyup.enter="login"></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="blue darken-1" text @click="joinDialogOpen()">가입하기</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="login()">로그인</v-btn>
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
                                <v-form v-model="valid">
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field label="ID" v-model="id" required :rules="[idRules.required, idRules.min]"></v-text-field>
                                        </v-col>
                                        <v-col cols="11" sm="5">
                                            <v-text-field label="비밀번호" v-model="pw" :type="passwordType" :rules="[pwRules.required, pwRules.min]" required>
                                            </v-text-field>
                                            <div id="passwordShowIcon" @click="showPassword">
                                                <v-icon v-if="passwordIcon">mdi-eye-outline</v-icon>
                                                <v-icon v-else>mdi-eye-off-outline</v-icon>
                                            </div>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field label="이름" required v-model="userName" :rules="[nameRules.required]"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-select :items="['20대', '30대', '기타']" label="나이" required v-model="age"></v-select>
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-select :items="['남자', '여자']" label="성별" required v-model="sex"></v-select>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-container>
                        </v-card-text>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="blue darken-1" text @click="closeDialogForSignUp()">창닫기</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="signUp">회원가입</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data: () => ({
        valid: false,
        dialogForLogin: false,
        dialogForSignUp: false,
        id: "",
        pw: "",
        passwordType: "password",
        passwordIcon: true,
        userName: "",
        age: "20대",
        sex: "남자",
        idRules: {
            required: value => !!value || '아이디가 필요합니다.',
            min: v => v.length >= 3 || '최소 3자 이상이 필요합니다.'
        },
        pwRules: {
            required: value => !!value || '패스워드가 필요합니다.',
            min: v => v.length >= 8 || '최소 8자 이상이 필요합니다.'
        },
        nameRules: {
            required: value => !!value || '이름이 필요합니다.'
        },
        loginFail: false,
        signUpFail: false
    }),
    methods: {
        joinDialogOpen() {
            this.dialogForLogin = false;
            this.dialogForSignUp = true;
            this.id = "";
            this.pw = "";
        },
        login() {
            axios.post('/php/login.php', { "id": this.id, "pw": this.pw })
                .then(response => {
                    if (response.data == false) {
                        this.dialogForLogin = false;
                        this.loginFail = true;
                        setTimeout(() => {
                            this.loginFail = false;
                        }, 3000);
                        return;
                    }
                    this.$emit('login', response.data);
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                })
        },
        showPassword() {
            if (this.passwordType == "password") {
                this.passwordType = "text";
                this.passwordIcon = false;
            } else {
                this.passwordType = "password";
                this.passwordIcon = true;
            }
        },
        closeDialogForSignUp() {
            this.dialogForSignUp = false;
            this.id = "";
            this.pw = "";
            this.userName = "";
            this.age = "20대";
            this.sex = "남자";
        },
        signUp() {
            if (this.id == "" || this.pw == "" || this.userName == "")
                return;
            axios.post('/php/signUpIdCheck.php', { "id": this.id })
                .then(response => {
                    if (response.data == false) {
                        this.signUpFail = true;
                        this.dialogForSignUp = false;
                        setTimeout(() => {
                            this.signUpFail = false;
                        }, 3000);
                        return;
                    } else {
                        this.$emit('setIDPWUserName', {
                            'id': this.id,
                            'pw': this.pw,
                            'userName': this.userName
                        });
                        this.$emit('signUpDataRegInLoginVue', [
                            this.id,
                            this.pw,
                            this.userName,
                            this.age,
                            this.sex
                        ]);
                    }
                })
                .catch(error => {
                    if (error)
                        console.log("실패!");
                })
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

#passwordShowIcon {
    position: absolute;
    left: 80%;
    top: 32%;
}
</style>