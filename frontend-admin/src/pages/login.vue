<template>
    <b-container class="mt-5">
        <b-col md="8" offset-md="2" class="card p-5">
            <h3>Login</h3>
            <b-form>
                <b-form-group label="Email">
                    <b-form-input v-model="email" type="text" required placeholder="Email"></b-form-input>
                </b-form-group>

                <b-form-group label="Password">
                    <b-form-input v-model="katasandi" type="password" required placeholder="Password"></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary" @click="login()">Masuk</b-button>
            </b-form>
        </b-col>
    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data(){
        return {
            email: '',
            katasandi: ''
        }
    },
    mounted() {
        if (localStorage.getItem('tkn') != null) {
            window.location.assign('/')
        } else {
            window.location.assign('/#/login')
        }
    },
    methods : {
        login(){
            let formData = new FormData();

            formData.append('email', this.email)
            formData.append('katasandi', this.katasandi)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/login-admin.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                localStorage.tkn = response.data[0].id_admin
                if (response.data[0].id_admin) {
                    window.location = "#/"
                }
            })
            .catch(response => {
                console.log(response)
            })
        }
    }
}
</script>
