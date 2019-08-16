<template>
    <b-container class="mt-5">
        <b-col md="8" offset-md="2" class="card p-5">
            <b-alert :show="regist">Berhasil, silahkan <a href="#/login">login disini</a>.</b-alert>
            <h3>Pendaftaran</h3>
            <b-form>
                <b-form-group label="NIK">
                    <b-form-input v-model="nik" type="text" required placeholder="Nomor Induk Kependudukan"></b-form-input>
                </b-form-group>

                <b-form-group label="Nama">
                    <b-form-input v-model="nama" type="text" required placeholder="Nama sesuai KTP"></b-form-input>
                </b-form-group>

                <b-form-group label="Email">
                    <b-form-input v-model="email" type="text" required placeholder="Email"></b-form-input>
                </b-form-group>

                <b-form-group label="Password">
                    <b-form-input v-model="katasandi" type="password" required placeholder="Password"></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary" @click="pendaftaran()">Daftar</b-button>
            </b-form>
        </b-col>
    </b-container>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            regist: false,
            nik: '',
            nama: '',
            email: '',
            katasandi: ''
        }
    },
    methods: {
        pendaftaran(){
            let formData = new FormData();

            formData.append('nik', this.nik)
            formData.append('nama', this.nama)
            formData.append('email', this.email)
            formData.append('katasandi', this.katasandi)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/pendaftaran.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                this.regist = true
            })
            .catch(response => {
                console.log(response)
            })
        }
    }
}
</script>
