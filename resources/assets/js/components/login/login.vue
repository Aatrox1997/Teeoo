<template>
    <Card class="login" dis-hover>
        <p slot="title">Teeoo</p>
        <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" :label-width="80">
            <FormItem label="邮箱" prop="email">
                <Input type="email" v-model="formValidate.email" placeholder="Enter your mail"></Input>
            </FormItem>
            <FormItem label="密码" prop="password">
                <Input type="password" v-model="formValidate.password" placeholder="Enter your password"></Input>
            </FormItem>
            <FormItem>
                <Button type="primary" @click="handleSubmit('formValidate')">登录</Button>
            </FormItem>
        </Form>
    </Card>
</template>
<script>
    export default {
        data() {
            return {
                formValidate: {
                    password: '',
                    email: '',
                },
                ruleValidate: {
                    password: [
                        {required: true, message: '看起来你密码貌似不符合规则哦', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '你必须输入正确的邮箱', trigger: 'blur'},
                    ]
                }
            }
        },
        methods: {
            handleSubmit(name) {
                this.$Loading.start();
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        // this.$Message.success('Success!');
                        axios.post("login", this.formValidate).then(response => {
                            if (response.data.status_code == 222) {
                                this.$Message.error('看起来你输入的邮箱或密码不对哦!');
                                this.$Loading.finish();
                            }
                        }).catch(function (response) {
                            this.$Loading.error();
                            console.log(response);
                        });
                    } else {
                        this.$Notice.warning({
                            title: '一个小小的提示',
                            desc: '兄弟你把信息输正确会死啊. '
                        });
                        this.$Loading.finish();
                    }
                })
            }
        }
    }
</script>
<style scoped>
    .login {
        position: absolute;
        left: 50%;
        top: 250px;
        width: 360px;
        margin-left: -180px;
    }
</style>